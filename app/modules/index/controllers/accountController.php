<?php

namespace Application\modules\index\controllers;

use dollmetzer\zzaplib\controller\WebController;
use dollmetzer\zzaplib\data\Form;

class accountController extends WebController
{

    public function loginAction() {

        $fields = [
            'handle' => [
                'type' => 'text',
                'required' => true,
                'maxlength' => 32,

            ],
            'password' => [
                'type' => 'password',
                'required' => true,
                'maxlength' => 32,
            ],
            'submit' => [
                'type' => 'submit',
                'value' => 'login'
            ],
        ];
        $form = new Form();
        $form->setFields($fields);

        if ($form->process()) {

            $values = $form->getValues();
            print_r($values);
            die();

        }

        $this->view->addContent('form', $form->getViewdata());
    }

    public function logoutAction() {
        $this->response->redirect($this->router->buildUrl('/'));
    }

    public function registerAction() {

        $languages = [];
        foreach($this->config->get('languages') as $pos=>$key) {
            $languages[$key] = $this->translator->translate('language_'.$key);
        }

        $fields = [
            'handle' => [
                'type' => 'text',
                'required' => true,
                'pattern' => '/^[a-z0-9_\-]*$/i',
                'minlength' => 6,
                'maxlength' => 32,
                'help' => $this->translator->translate('form_help_registerform_handle')
            ],
            'email' => [
                'type' => 'email',
                'required' => true,
                'maxlength' => 255,
            ],
            'password' => [
                'type' => 'password',
                'required' => true,
                'minlength' => 8,
                'maxlength' => 32,
                'help' => $this->translator->translate('form_help_registerform_password')
            ],
            'password2' => [
                'type' => 'password',
                'required' => true,
                'minlength' => 8,
                'maxlength' => 32,
            ],
            'language' => [
                'type' => 'select',
                'required' => true,
                'options' => $languages,
                'value' => $this->session->get('userLanguage')
            ],
            'register' => [
                'type' => 'submit',
                'value' => 'register',
            ]
        ];
        $form = new Form();
        $form->setFields($fields);

        if ($form->process()) {

            $values = $form->getValues();
            print_r($values);
            die();

        }

        $this->view->addContent('form', $form->getViewdata());
    }

    public function confirmAction() {

    }

    public function resetpasswordAction() {

    }
}