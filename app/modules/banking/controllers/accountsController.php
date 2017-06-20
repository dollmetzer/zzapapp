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

namespace Application\modules\banking\controllers;

/**
 * Class admingroupController
 *
 * @author Dirk Ollmetzer (dirk.ollmetzer@ollmetzer.com)
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL 3.0
 * @copyright 2016-2017 Dirk Ollmetzer (dirk.ollmetzer@ollmetzer.com)
 * @package zzap_app
 * @subpackage banking
 */
class accountsController extends \Application\modules\core\controllers\Controller
{

    /**
     * @var array $accessGroups For every action name is an array of allowed user groups
     */
    public $accessGroups = array(
        'index' => 'banking',
        'details' => 'banking',
        'new' => 'banking',
        'edit' => 'banking',
        'delete' => 'banking',
    );

    /**
     * Show a list of the users bank accounts
     */
    public function indexAction() {

        $accountModel = new \Application\modules\banking\models\accountModel($this->config);

        // set table columns
        $columns = $this->getColumns();
        $table = new \dollmetzer\zzaplib\Table();
        $table->setColumns($columns);

        // calculate pagination
        $page = 0;
        if (sizeof($this->request->params) > 0) {
            $page = (int)$this->request->params[0];
        }
        $table->page = $page;
        $entriesPerPage = 10;
        $table->entriesPerPage = $entriesPerPage;
        $table->calculateMaxPage($accountModel->getUsersAccountEntries());
        $first = $page * $entriesPerPage;
        $table->urlPage = 'banking/accounts/index';
        $table->urlSort = 'banking/accounts/sort';
        $table->urlNew = 'banking/accounts/new';
        $table->urlDetails = 'banking/accounts/details';
        $table->urlEdit = 'banking/accounts/edit';
        $table->urlDelete = 'banking/accounts/delete';

        // sorting
        $sortColumn = $this->session->sortUserCol;
        if (!$sortColumn) {
            $sortColumn = 'handle';
        }
        $table->sortColumn = $sortColumn;
        $sortDirection = $this->session->sortUserDir;
        if (!$sortDirection) {
            $sortDirection = 'asc';
        }
        $table->sortDirection = $sortDirection;

        // get content from db
        $table->setRows($accountModel->getUsersAccounts($this->session->user_id, $first, $entriesPerPage, $sortColumn, $sortDirection));

        $this->view->content['table'] = $table;
        $this->view->content['title'] = $this->lang('title_accounts');

    }

    public function detailsAction() {

    }

    public function newAction() {

    }


    public function editAction() {

        if (sizeof($this->request->params) < 1) {
            $this->forward($this->buildUrl('banking/account'), $this->lang('error_core_parameter_missing'),
                'error');
        }
        $id = (int)$this->request->params[0];
        $accountModel = new \Application\modules\banking\models\accountModel($this->config);
        $account = $accountModel->read($id);
        if (empty($account)) {
            $this->forward($this->buildUrl('banking/account'), $this->lang('error_core_illegal_parameter'),
                'error');
        }
        if($account['user_id'] != $this->session->user_id) {
            $this->forward($this->buildUrl('banking/account'), $this->lang('error_core_illegal_parameter'),
                'error');
        }

        $form = new \dollmetzer\zzaplib\Form($this->request, $this->view);
        $form->name = 'accountform';
        $form->fields = $this->getAccountformFields($account);

        if ($form->process()) {

            $values = $form->getValues();
            if ($form->hasErrors === false) {
                $data = array(
                    'account' => $values['account'],
                    'bank_id' => $values['bank_id'],
                    'iban' => $values['iban'],
                    'bic' => $values['bic'],
                    'first_name' => $values['first_name'],
                    'last_name' => $values['last_name'],
                    'description' => $values['description'],
                );
                $accountModel->update($id, $data);
                $this->forward($this->buildUrl('banking/account/details/' . $id), $this->lang('msg_account_updated'),
                    'message');
            }


print_r($values);
die();


            if ($form->hasErrors === false) {
                $data = array(
                    'handle' => $values['handle'],
                    'email' => $values['email'],
                    'language' => $values['language'],
                    'active' => $values['active']
                );
                $userModel->update($uid, $data);

                if (!empty($values['password'])) {
                    $userModel->setPassword($uid, $values['password']);
                }

                $this->forward($this->buildUrl('users/adminuser/details/' . $uid), $this->lang('msg_user_updated'),
                    'message');

            }

        }

        $this->view->content['title'] = $this->lang('title_edit');
        $this->view->content['form'] = $form->getViewdata();

    }


    public function deleteAction() {

    }


    /**
     * Returns the columns definition array for the user table
     *
     * @return array
     */
    protected function getColumns()
    {

        return array(
            'id' => array(
                'type' => 'hidden',
            ),
            'account' => array(
                'type' => 'integer',
                'sortable' => true,
                'width' => '10%',
            ),
            'bank_id' => array(
                'type' => 'integer',
                'sortable' => true,
                'width' => '10%',
            ),
            'iban' => array(
                'type' => 'text',
                'sortable' => true,
                'width' => '15%',
            ),
            'bic' => array(
                'type' => 'text',
                'sortable' => true,
                'width' => '10%',
            ),
            'first_name' => array(
                'type' => 'text',
                'sortable' => true,
                'width' => '15%',
            ),
            'last_name' => array(
                'type' => 'text',
                'sortable' => true,
                'width' => '15%',
            ),
            'description' => array(
                'type' => 'text',
                'sortable' => true,
                'width' => '10%',
            ),
            'details' => array(
                'type' => 'details',
                'width' => '5%',
            ),
            'edit' => array(
                'type' => 'edit',
                'width' => '5%',
            ),
            'delete' => array(
                'type' => 'delete',
                'width' => '5%',
            ),
        );

    }



    /**
     * Returns a definition array for the account form
     *
     * @param array $_account
     * @return array
     */
    protected function getAccountformFields($_account)
    {

        return array(
            'account' => array(
                'type' => 'text',
                'minlength' => 10,
                'maxlength' => 10,
                'value' => $_account['account'],
            ),
            'bank_id' => array(
                'type' => 'text',
                'minlength' => 8,
                'maxlength' => 8,
                'value' => $_account['bank_id'],
            ),
            'iban' => array(
                'type' => 'text',
                'minlength' => 20,
                'maxlength' => 22,
                'value' => $_account['iban'],
            ),
            'bic' => array(
                'type' => 'text',
                'minlength' => 10,
                'maxlength' => 11,
                'value' => $_account['bic'],
            ),
            'first_name' => array(
                'type' => 'text',
                'minlength' => 2,
                'maxlength' => 64,
                'value' => $_account['first_name'],
            ),
            'last_name' => array(
                'type' => 'text',
                'minlength' => 2,
                'maxlength' => 64,
                'value' => $_account['last_name'],
            ),
            'description' => array(
                'type' => 'text',
                'maxlength' => 128,
                'value' => $_account['description'],
            ),
            'submit' => array(
                'type' => 'submit',
            ),
        );
    }


}