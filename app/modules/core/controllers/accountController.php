<?php
/**
 * z z a p   a p p   e x a m p l e   a p p l i c a t i o n
 * =======================================================
 *
 * This is a base application using the zzaplib web applications mini framework
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 3 of the License, or (at your option) any later
 * version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, see <http://www.gnu.org/licenses/>.
 */

namespace Application\modules\core\controllers;

/**
 * Class accountController
 * Actions around the users account
 *
 * @author Dirk Ollmetzer (dirk.ollmetzer@ollmetzer.com)
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL 3.0
 * @copyright 2016-2017 Dirk Ollmetzer (dirk.ollmetzer@ollmetzer.com)
 * @package zzap_app
 * @subpackage core
 */
class accountController extends Controller
{

    /**
     * Show details of the user account
     */
    public function indexAction() {

    }

    /**
     * Show and process login form
     */
    public function loginAction() {

        $form = new \dollmetzer\zzaplib\Form($this->request, $this->view);
        $form->name = 'loginform';
        $form->fields = array(
            'handle' => array(
                'type' => 'text',
                'required' => true,
                'maxlength' => 32,
            ),
            'password' => array(
                'type' => 'password',
                'required' => true,
                'maxlength' => 32,
            ),
            'submit' => array(
                'type' => 'submit',
                'value' => 'login'
            ),
        );

        if ($form->process()) {

            $values = $form->getValues();

            $userModel = new \Application\modules\core\models\userModel($this->config);
            $user = $userModel->getByLogin($values['handle'], $values['password']);

            if (!empty($user)) {
                if (!empty($user['active'])) {

                    $this->login($user);
                    $this->request->forward($this->buildURL(''), $this->lang('msg_users_loginsuccess'), 'message');

                }
            } else {
                $this->request->forward($this->buildURL('users/account/login'), $this->lang('error_users_loginfailed'),
                    'error');
            }

        }

        $this->view->content['form'] = $form->getViewdata();
        $this->view->content['title'] = $this->lang('title_users_login');

    }

    /**
     * logout and forward to the start page
     */
    public function logoutAction() {

    }




}