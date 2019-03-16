<?php

//============================================================
// Sets of functions and classes to work with email templates
//
// Author: Andrii Biriev
// Author: Andrii Karepin
// Copyright � Brilliant IT corporation, www.it.brilliant.ua
//
// Example of usage:
//  $e=new BEmailTemplate();
//  $e->loadtemplate('users.newuser');
//  $e->email=$user->email;
//  $e->set('username',$user->name);
//  $e->set('confirmlink',$user->confirmlink);
//  $e->send();
//============================================================
core\Application::import_lib('email.general');

//============================================================
// Main class to send emails with templates
//============================================================
class BEmailTemplate {

    public $email = '';
    protected $subject = '';
    protected $tpl_str = '';
    protected $tpl_tmp = '';
    protected $tpl_dir = '';
    protected $bemail = NULL;
    public $vars = [];

    //=======================================================
    // Constructor
    //=======================================================
    function __construct() {
        $this->from_email = Config::$email_project;
        $this->from_name = Config::$hots_name_mail;
        $this->send_type = Config::$type_send_mail;
        $this->params = new stdClass();
    }

    //====================================================
    //
	//====================================================
    protected function rndstr($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    //====================================================
    //
	//====================================================
    public function loadtemplate($alias) {
        $template_mail = HTML_DIR . DS . 'mail' . DS . 'templates' . DS . 'header.php';
        $dir = HTML_DIR . DS . 'mail' . DS . 'views' . DS;
        $fn = $dir . $alias . '.php';
        if (!file_exists($fn)) {
            return false;
        }
        $this->bemail = new BEmail();
        $this->tpl_dir = $dir;
        ob_start();
        include $fn;
        $this->tpl_tmp = ob_get_clean();
        ob_start();
        include $template_mail;
        $this->tpl_str = ob_get_clean();
        return true;
    }

    //====================================================
    //
	//====================================================
    public function insertimg($path) {
        if (empty($this->bemail)) {
            return false;
        }
        $fn = $this->tpl_dir . $path;
        if (!file_exists($fn)) {
            return false;
        }
        $ext = strtolower(pathinfo($fn, PATHINFO_EXTENSION));
        //detecting content type...
        $ctype = '';
        if ($ext == 'png') {
            $ctype = 'image/png';
        } elseif ($ext == 'jpg') {
            $ctype = 'image/jpeg';
        } else {
            return false;
        }
        $cid = $this->rndstr();
        $this->bemail->attachment($ctype, $cid . '.' . $ext, $fn, $cid);
        echo('<img src="cid:' . $cid . '">');
    }

    //====================================================
    //
	//====================================================
    public function set($alias, $value) {
        $this->tpl_str = str_replace('%' . $alias . '%', $value, $this->tpl_str);
        return true;
    }

    //====================================================
    //
	//====================================================
    public function addcalendar($params) {
        if (empty($this->bemail)) {
            return false;
        }
        $this->bemail->addcalendar($params);
    }

    //====================================================
    //
	//====================================================
    public function setSubject($subject) {
        if (empty($this->bemail)) {
            return false;
        }
        $this->subject = $subject;
        return true;
    }

    /**
     * Get rendered email template
     *
     * @return string
     */
    public function getRenderedTemplate() {
        return $this->tpl_str;
    }

    //====================================================
    //
	//====================================================
    public function send() {
        if (empty($this->bemail)) {
            return false;
        }
        $this->bemail->from_email = $this->from_email;
        $this->bemail->from_name = $this->from_name;
        $this->bemail->to_email = $this->email;
        $this->bemail->subject = $this->subject;
        $this->bemail->body('text/html', $this->tpl_str);
        $r = $this->bemail->send();
        return $r;
    }

}
