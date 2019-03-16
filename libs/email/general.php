<?php

//============================================================
// Sets of functions and classes to work with email messages
//
// Author: Andrii Biriev
// Author: Andrii Karepin
// Copyright © Brilliant IT corporation, www.it.brilliant.ua
//============================================================
define('BEMAIL_SEND_NOW', 1);
define('BEMAIL_SEND_QUEUED', 2);
//
define('BEMAIL_SENDMAIL_MAIL', 1);
define('BEMAIL_SENDMAIL_SMTP', 2);
//Statuses
define('BEMAIL_STATUS_DONE', 0);
define('BEMAIL_STATUS_ERROR', 1);

//============================================================
// Main class to send emails
//============================================================
class BEmail {

    public $sendtype = BEMAIL_SEND_NOW;
    public $sendmail = 2;
    public $from_email;
    public $from_name;
    public $to_email;
    public $to_name;
    public $subject;
    public $data_charset = 'UTF-8';
    public $send_charset = 'UTF-8';
    //public $send_charset='windows-1251';
    //Части сообщения - текст и т.п.
    private $EOL;
    private $parts = array();

    //=======================================================
    // Конструктор
    //=======================================================
    function __construct() {
        $this->EOL = CHR(13) . CHR(10);
    }

    //=======================================================
    // Load from object
    //=======================================================
    public function load($obj) {
        //
    }

    //=======================================================
    //Encode headers
    //=======================================================
    function mime_header_encode($str, $data_charset, $send_charset) {
        if ($data_charset != $send_charset) {
            $str = iconv($data_charset, $send_charset . '//IGNORE', $str);
        }
        return ('=?' . $send_charset . '?B?' . base64_encode($str) . '?=');
    }

    //=======================================================
    // Функция, прикрепляющая файл
    //=======================================================
    function attachment($content_type, $name, $fn, $content_id = '') {
        //Read data from the file...
        $fp = fopen($fn, 'rb');
        if (!$fp) {
            return false;
        }
        $str = fread($fp, filesize($fn));
        fclose($fp);
        $msg['path'] = $fn;
        $msg['attachment'] = true;
        $msg['content_type'] = $content_type;
        $msg['content_id'] = $content_id; //Для вставки в тело письма
        $msg['data'] = $str;
        $msg['name'] = $name;
        $msg['send_charset'] = '';
        $msg['transfer_encoding'] = 'base64';
        array_push($this->parts, $msg);
    }

    //=======================================================
    // Функция, прикрепляющая данные строкой
    //=======================================================
    function attachdata($content_type, $name, $str, $content_id = '') {
        $msg['path'] = '';
        $msg['attachment'] = true;
        $msg['content_type'] = $content_type;
        $msg['content_id'] = $content_id; //Для вставки в тело письма
        $msg['data'] = $str;
        $msg['name'] = $name;
        $msg['send_charset'] = '';
        $msg['transfer_encoding'] = 'base64';
        array_push($this->parts, $msg);
    }

    //=======================================================
    // Функция, прикрепляющая событие календаря
    //=======================================================
    function addcalendar($calendar) {
        return $this->attachdata('text/calendar', 'event.ics', $calendar->print_icalendar());
    }

    //=======================================================
    // Функция, добавляющая тело сообщения
    //=======================================================
    function body($content_type, $str) {
        $msg['path'] = '';
        $msg['attachment'] = false;
        $msg['content_type'] = $content_type;
        $msg['content_id'] = '';
        $msg['data'] = $str;
        $msg['name'] = '';
        $msg['send_charset'] = $this->send_charset;
        $msg['transfer_encoding'] = '8bit'; //'quoted-printable';
        array_push($this->parts, $msg);
    }

    //=======================================================
    //Функция для отправки multipart сообщения (с вложениями)
    //=======================================================
    function send_multipart() {
        $dc = $this->data_charset;
        $sc = $this->send_charset;
        $EOL = $this->EOL;
        $boundary = 'a' . sha1(uniqid(time())); //любая строка, которой не будет в потоке данных.
        //Encode some fields
        $enc_to = $this->mime_header_encode($this->to_name, $dc, $sc) . ' <' . $this->to_email . '>';
        $enc_subject = $this->mime_header_encode($this->subject, $dc, $sc);
        if (!empty($this->from_email)) {
            $enc_from = $this->mime_header_encode($this->from_name, $dc, $sc) . ' <' . $this->from_email . '>';
        } else {
            $enc_from = '';
        }
        //Process data...
        $multipart = '';
        for ($i = 0; $i < count($this->parts); $i++) {
            $ctype = $this->parts[$i]['content_type'];
            $cname = $this->parts[$i]['name'];
            $ccharset = $this->parts[$i]['send_charset'];
            $ctenc = $this->parts[$i]['transfer_encoding'];
            $cid = $this->parts[$i]['content_id'];
            //Put file into multipart
            $multipart .= '--' . $boundary . $EOL;
            $multipart .= 'Content-Type: ' . $ctype .
                (empty($ccharset) ? '' : '; charset=' . $ccharset) .
                (empty($cname) ? '' : '; name=' . $cname) . $EOL;
            if (!empty($cid)) {
                $multipart .= 'Content-ID: <' . $cid . '>' . $EOL;
            }
            $multipart .= 'Content-Transfer-Encoding: ' . $ctenc . $EOL;
            //Different encodings
            if ($ctenc == '8bit') {//quoted-printable
                $enc_body = $dc == $ccharset ?
                    $this->parts[$i]['data'] :
                    iconv($dc, $ccharset . '//IGNORE', $this->parts[$i]['data']);
                $multipart .= $EOL . $enc_body . $EOL;
            } else
            if ($ctenc == 'base64') {
                $multipart .= $EOL . chunk_split(base64_encode($this->parts[$i]['data']), 76, $EOL) . $EOL;
            };
        }
        $multipart .= '--' . $boundary . '--' . $EOL;
        //
        $headers = '';
        $headers .= 'Mime-Version: 1.0' . $EOL;
        $headers .= 'Content-type: multipart/mixed; boundary=' . $boundary . $EOL;
        if (!empty($enc_from)) {
            $headers .= 'From: ' . $enc_from . $EOL;
        }
        //Send email
        return $this->process($enc_to, $enc_subject, $multipart, $headers);
    }

    //=======================================================
    // Функция для отправки обычного сообщения
    //=======================================================
    function send_single() {
        //Get some global variables...
        $dc = $this->data_charset;
        $sc = $this->send_charset;
        $EOL = $this->EOL;
        $body = $this->parts[0]['data'];
        $ctype = $this->parts[0]['content_type'];
        $ccharset = $this->parts[0]['send_charset'];
        //Encode some fields
        $enc_to = $this->mime_header_encode($this->to_name, $dc, $sc) . ' <' . $this->to_email . '>';
        $enc_subject = $this->mime_header_encode($this->subject, $dc, $sc);
        if (!empty($this->from_email)) {
            $enc_from = $this->mime_header_encode($this->from_name, $dc, $sc) . ' <' . $this->from_email . '>';
        } else {
            $enc_from = '';
        }
        //Encode Body
        $enc_body = $dc == $ccharset ? $body : iconv($dc, $ccharset . '//IGNORE', $body);
        //Form headers
        $headers = '';
        $headers .= 'Mime-Version: 1.0' . $EOL;
        $headers .= 'Content-type: ' . $ctype . '; charset=' . $ccharset . $EOL;
        if (!empty($enc_from)) {
            $headers .= 'From: ' . $enc_from . $EOL;
        }
        //Send email
        return $this->process($enc_to, $enc_subject, $enc_body, $headers);
    }

    /**
     *
     */
    function send_smtp() {
        try {
            require_once 'phpmailer/PHPMailerAutoload.php';
            //
            $dc = $this->data_charset;
            $sc = $this->send_charset;
            $index_html = -1;
            $index_text = -1;
            foreach ($this->parts as $ind => $part) {
                if ($part['content_type'] == 'text/html') {
                    $index_html = $ind;
                }
                if ($part['content_type'] == 'text/plain') {
                    $index_text = $ind;
                }
            }
            if ($index_html < 0) {
                return false;
            }
            $body = $this->parts[$index_html]['data'];
            $ctype = $this->parts[$index_html]['content_type'];
            $ccharset = $this->parts[$index_html]['send_charset'];
            //
            $mail = new PHPMailer();
            $mail->CharSet = $dc;
            //
            $mail->isSMTP();

            $mail->Host = \Config::$hots_mail;
            $mail->Hostname = \Config::$hots_name_mail;
            $mail->Port = \Config::$port_mail;
            $mail->SMTPSecure = \Config::$SMTPSecure;
            //$mail->Port = 25;
            $mail->SMTPAuth = \Config::$SMTPAuth;
            $mail->Username = \Config::$email_project;
            $mail->Password = \Config::$password_mail;

            //Set who the message is to be sent from
            $mail->setFrom($this->from_email, $this->from_name);
            //Set an alternative reply-to address
            $mail->addReplyTo($this->from_email, $this->from_name);
            //Set who the message is to be sent to
            $mail->addAddress($this->to_email, $this->to_name);
            //Set the subject line
            $mail->Subject = $this->subject;
            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            $mail->msgHTML($body);
            //Replace the plain text body with one created manually
            if ($index_text > 0) {
                $mail->AltBody = $this->parts[$index_text]['data'];
            }
            //$mail->AltBody = 'This is a plain-text message body';
            //Attach an image file
            foreach ($this->parts as $ind => $part) {
                if (($ind != $index_html) && ($ind != $index_text)) {
                    if (empty($part['path'])) {
                        $mail->addStringAttachment(
                            $part['data'], $part['name'], $part['transfer_encoding'], $part['content_type'], empty($part['content_id']) ? 'attachment' : 'inline');
                    } else {
                        $mail->addEmbeddedImage(
                            $part['path'], $part['content_id'], $part['name'], $part['transfer_encoding'], $part['content_type'], empty($part['content_id']) ? 'attachment' : 'inline');
                    }
                }
            }
            //send the message, check for errors
            $r = $mail->send();
            return $r;
        } catch (phpmailerException $e) {
            return false;
            //echo $e->errorMessage(); //error messages from PHPMailer
            //die();
        } catch (Exception $e) {
            return false;
            //echo $e->getMessage();
            //die();
        }
    }

    //=======================================================
    // Detect the message type and send it
    //=======================================================
    function process($email, $subject, $body, $headers) {
        if ($this->sendtype == BEMAIL_SEND_NOW) {
            $result = mail($email, $subject, $body, $headers);
            /* $qr='INSERT INTO `messages_email` (status,sender,destination,email,subject,headers,body,dt_added,dt_sent) VALUES ('.
              ($result?BEMAIL_STATUS_DONE:BEMAIL_STATUS_ERROR).','.
              'NULL,'.
              'NULL,'.
              ')';
              bimport('sql.mysql');
              $db=BMySQL::getInstanceAndConnect();
              if(empty($db)){
              if(DEBUG_MODE){
              bimport('debug.general');
              BDebug::error('[BEmail] process(): Could not connect to the SQL server!');
              }
              return false;
              }
              $q=$db->query($qr);
              if(empty($q)){
              if(DEBUG_MODE){
              bimport('debug.general');
              BDebug::error('[BEmail] process(): query error: '.$db->lasterror());
              }
              return false;
              } */
            return $result;
        } else {
            return false;
        }
        return false;
    }

    //=======================================================
    // Detect the message type and send it
    //=======================================================
    function send() {
        if ($this->sendmail == BEMAIL_SENDMAIL_SMTP) {
            return $this->send_smtp();
        } else {
            if (count($this->parts) == 1) {
                return $this->send_single();
            } else
            if (count($this->parts) > 1) {
                return $this->send_multipart();
            }
        }
        return false;
    }

}
