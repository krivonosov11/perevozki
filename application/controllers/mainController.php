<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace application\controllers;

use application\models\News;
use core\User;

/**
 * Description of authController
 *
 * @author user
 */
class MainController extends \core\mvc\Controller
{

    private $count_page = 0;

    public function __construct($route)
    {
        parent::__construct($route);
        $model = new News();
        $news = $model->getAllNews();
        $count = count($news) / \Config::$count_news_in_page;
        $this->count_page = ($count == intval($count) ? $count : intval($count) + 1);
    }

    public function index()
    {
        $model = new News();
        $news = $model->getAllNews();
        $count_page = $this->count_page;
        $j = 1;
        $this->set(compact('news', 'count_page', 'j'));
    }

    public function page()
    {
        $model = new News();
        $j = \BRequest::getInt('list', 1);
        $news = $model->getAllNews($j);
        $count_page = $this->count_page;
        $this->view = 'index';
        $this->set(compact('news', 'count_page', 'j'));
    }


}
