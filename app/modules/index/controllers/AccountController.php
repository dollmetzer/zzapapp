<?php
/**
 * E x a m p l e   a p p l i c a t i o n   s c a f f o l d
 * ========================================================
 * For the zzaplib 3 mini framework
 *
 * @author Dirk Ollmetzer (dirk.ollmetzer@ollmetzer.com)
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL 3.0
 * @copyright 2019 Dirk Ollmetzer (dirk.ollmetzer@ollmetzer.com)
 */

namespace Application\modules\index\controllers;

use Application\modules\index\models\GroupModel;
use Application\modules\index\models\UserModel;
use dollmetzer\zzaplib\exception\ApplicationException;
use dollmetzer\zzaplib\controller\WebController;
use dollmetzer\zzaplib\data\Form;

class AccountController extends WebController
{

    public $permission = [
        'login' => [6],
        'register' => [6],
        'confirm' => [6],
        'resetpassword' => [6],
        'impersonate' => [2],
    ];

    public function loginAction()
    {

        $fields = [
            'handle' => [
                'label' => 'handle',
                'type' => 'text',
                'required' => true,
                'maxlength' => 32,
            ],
            'password' => [
                'label' => 'password',
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
            $userModel = new UserModel($this->config, $this->logger);
            $user = $userModel->getByLogin($values['handle'], $values['password']);
            if ($user) {
                $this->doLogin($user);
                $url = $this->router->buildURL('/');
                $message = $this->translator->translate('msg_login_success');
                $this->response->redirect($url, $message, 'notice');
            } else {
                $form->setError($this->translator->translate('error_login_failed'));
            }
        }
        $this->view->addContent('form', $form->getViewdata());
    }

    public function logoutAction()
    {
        $this->session->destroy();
        $this->session->init();
        $message = $this->translator->translate('msg_logout_success');
        $this->response->redirect($this->router->buildUrl('/'), $message, 'notice');
    }

    public function registerAction()
    {

        $languages = [];
        foreach ($this->config->get('languages') as $pos => $key) {
            $languages[$key] = $this->translator->translate('language_' . $key);
        }

        $fields = [
            'handle' => [
                'label' => 'handle',
                'type' => 'text',
                'required' => true,
                'pattern' => '/^[a-z0-9_\-]*$/i',
                'minlength' => 6,
                'maxlength' => 32,
                'value' => '',
                'help' => $this->translator->translate('form_help_registerform_handle')
            ],
            'email' => [
                'label' => 'email',
                'type' => 'email',
                'required' => true,
                'maxlength' => 255,
                'value' => '',
            ],
            'password' => [
                'label' => 'password',
                'type' => 'password',
                'required' => true,
                'minlength' => 8,
                'maxlength' => 32,
                'help' => $this->translator->translate('form_help_registerform_password')
            ],
            'password2' => [
                'label' => 'password2',
                'type' => 'password',
                'required' => true,
                'minlength' => 8,
                'maxlength' => 32,
            ],
            'language' => [
                'label' => 'language',
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
            if ($values['password'] != $values['password2']) {
                $form->setError('form_error_passwords_unequal', 'password2');
            }

            if($form->hasErrors() !== false) {
                print_r($values);
                die();

            }
        }

        $this->view->addContent('form', $form->getViewdata());
    }

    public function confirmAction()
    {
        die('no confirmation yet');
    }

    public function resetpasswordAction()
    {
        die('no password reset yet');
    }

    public function impersonateAction()
    {
        die('no impersonation yet');
    }

    /**
     * @param array $user
     * @throws \dollmetzer\zzaplib\exception\ApplicationException
     */
    private function doLogin(array $user)
    {
        $groupModel = new GroupModel($this->config, $this->logger);
        $groupsRaw = $groupModel->getUserGroups($user['id']);

        $groups = [];
        for ($i = 0; $i < sizeof($groupsRaw); $i++) {
            $groups[$groupsRaw[$i]['id']] = $groupsRaw[$i]['name'];
        }

        // The application user
        $this->session->set('userId', $user['id']);
        $this->session->set('userHandle', $user['handle']);
        $this->session->set('userLanguage', $user['language']);
        $this->session->set('userCountry', $user['country']);
        $this->session->set('userEmail', $user['email']);
        $this->session->set('userCreated', $user['created']);
        $this->session->set('userLastlogin', $user['lastlogin']);
        $this->session->set('userGroups', $groups);

        // The authenticated user for use with later impersonation
        $this->session->set('authId', $user['id']);
        $this->session->set('authHandle', $user['handle']);
        $this->session->set('authLanguage', $user['language']);
        $this->session->set('authCountry', $user['country']);
        $this->session->set('authEmail', $user['email']);
        $this->session->set('authCreated', $user['created']);
        $this->session->set('authLastlogin', $user['lastlogin']);
        $this->session->set('authGroups', $groups);
    }
}