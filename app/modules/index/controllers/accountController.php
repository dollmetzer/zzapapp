<?php

namespace Application\modules\index\controllers;

use dollmetzer\zzaplib\controller\WebController;
use dollmetzer\zzaplib\data\Form;

class accountController extends WebController
{
    public function loginAction() {
        $form = new Form();

        $this->view->addContent('form', $form);
    }

    public function logoutAction() {
        $this->response->redirect($this->router->buildUrl('/'));
    }

    public function registerAction() {
        $form = new Form();

        $this->view->addContent('form', $form);
    }

    public function confirmAction() {

    }

    public function resetpasswordAction() {

    }
}