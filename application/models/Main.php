<?php
/**
 * Created by PhpStorm.
 * User: bogda
 * Date: 03.01.2019
 * Time: 18:02
 */

namespace application\models;


use core\Db;
use core\mvc\Model;

class Main extends Model
{
    public function getListAreas()
    {
        $sql = "SELECT * FROM locality WHERE type = 'Область'";
        return Db::getAll($sql);
    }

    public function getListCity($idArea)
    {

        $sql = "SELECT * FROM locality WHERE parent_id = {$idArea}";
        return Db::getAll($sql);
    }


}