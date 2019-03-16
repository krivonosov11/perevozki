<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace application\controllers;

use application\models\Main;

/**
 * Description of authController
 *
 * @author user
 */
class MainController extends \core\mvc\Controller
{


    public function __construct($route)
    {
        parent::__construct($route);

    }

    public function index()
    {
        $model = new Main();
        $areas = $model->getListAreas();
        $city = $model->getListCity($areas[0]['id']);
        $this->set(compact('areas', 'city'));
    }

    public function getListCitys()
    {
        $idArea = \BRequest::getInt('id', 0);
        $model = new Main();
        $result = $model->getListCity($idArea);
        $this->loadResult($result);
    }

}
