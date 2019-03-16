<?php

class Config
{

    // config local DateBase
    // public static $host = '127.0.0.1';
    // public static $dbname = 'starov00_db';
    // public static $user = 'root';
    // public static $password = '';
    // public static $dsn = 'mysql:host=127.0.0.1;dbname=starov00_db;charset=utf8';

    // config production DataBae
   public static $host = '127.0.0.1';
   public static $dbname = 'starov00_db';
   public static $user = 'starov00_db';
   public static $password = 'e7pU2HfZ';
   public static $dsn = 'mysql:host=127.0.0.1;dbname=starov00_db;charset=utf8';

    // config local site
    // public static $url = 'http://starover.local.com';

    // config production site
   public static $url = 'https://starover.com.ua';

    public static $debugQueriesDB = false;
    public static $errorReporting = -1;
    public static $showErrors = false;

    // ssl, tls
    public static $SMTPSecure = '';
    public static $SMTPAuth = true;
    public static $password_mail = 'Jfefoihrgqw';
    public static $type_send_mail = 'HTML';
    public static $ajax_include = true; // include test ajax query

    public static $v_cache_styles_and_js = 48;

    public static $count_news_in_page = 10;
}