<?php
/**
 * Created by PhpStorm.
 * User: dirk
 * Date: 25.12.16
 * Time: 14:34
 */

namespace Application\modules\core\controllers;


class adminController extends \dollmetzer\zzaplib\Controller
{

    public function indexAction() {

        $this->view->theme = 'backend';

    }

}