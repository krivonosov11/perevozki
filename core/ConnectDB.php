<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core;

/**
 * Description of Connect
 *
 * @author user
 */
class ConnectDB {

    protected static $_instance;
    public static $queries_qty;

    private static function connect() {
        self::$queries_qty = 0;
        require_once 'rb.php';
        \R::setup(\Config::$dsn, \Config::$user, \Config::$password, []);
        \R::getDatabaseAdapter()->getDatabase()->isConnected();
        $isConnected = \R::testConnection();
        \R::freeze(true);
        \R::fancyDebug(true);
        \R::debug(true, 3);

        $adapter = \R::getDatabaseAdapter();
        //TODO Почему-то последнее сообщение не вставляется в Дебаг, нужно разобраться. если менять debug (true, 2), то это видно!
        $adapter->addEventListener('sql_exec', new \RedBeanPHP\RBLogger);
        $adapter->addEventListener('after_update', new \RedBeanPHP\RBLogger);
        if (!$isConnected) {
            die('Ошибка соединения с базой данных');
        }
        \R::freeze(true);

        //...поэтому в дебаге не отображается запрос
        self::$_instance = new \R();

        \R::startLogging();
        $myLogger = new \RedBeanPHP\Logger\RDefault;
//        $database->setLogger($myLogger);
//        self::getInstance()->setLogger($myLogger);
    }

    /**
     * @return R
     */
    public static function getInstance() {
        // проверяем актуальность экземпляра
        if (null === self::$_instance) {
            // создаем новый экземпляр
            self::connect();
        }
        // возвращаем созданный или существующий экземпляр
        return self::$_instance;
    }

}
