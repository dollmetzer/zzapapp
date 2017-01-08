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
 * Class adminuserController
 *
 * @author Dirk Ollmetzer (dirk.ollmetzer@ollmetzer.com)
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL 3.0
 * @copyright 2016-2017 Dirk Ollmetzer (dirk.ollmetzer@ollmetzer.com)
 * @package zzap_app
 * @subpackage core
 */
class adminuserController extends Controller
{

    /**
     * @var array $accessGroups For every action name is an array of allowed user groups
     */
    public $accessGroups = array(
        'index' => array('administrator'),
        'details' => array('administrator'),
        'settings' => array('administrator'),
        'search' => array('administrator')
    );


    /**
     * Method is called before any controller action.
     * Overload in the application controller to use
     */
    public function before() {

        $this->view->content['searchurl'] = $this->buildURL('core/adminuser/search');
        $this->view->content['searchtext'] = 'Search for user...';

    }

    /**
     * Show a list of users
     */
    public function indexAction()
    {

        $userModel = new \Application\modules\core\models\userModel($this->config);

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
        $table->calculateMaxPage($userModel->getListEntries());
        $first = $page * $entriesPerPage;
        $table->urlPage = 'core/adminuser/index';
        $table->urlSort = 'core/adminuser/sort';
        $table->urlNew = 'core/adminuser/new';
        $table->urlDetails = 'core/adminuser/details';
        $table->urlEdit = 'core/adminuser/edit';
        $table->urlDelete = 'core/adminuser/delete';

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
        $table->setRows($userModel->getList($first, $entriesPerPage, $sortColumn, $sortDirection));

        $this->view->content['table'] = $table;
        $this->view->content['title'] = $this->lang('title_users');
        $this->view->theme = 'backend';

    }

    /**
     * Show user details
     */
    public function detailsAction() {

        if (sizeof($this->request->params) < 1) {
            $this->forward($this->buildUrl('core/adminuser/index/0'), $this->lang('error_core_parametermissing'),
                'error');
        }
        $uid = (int)$this->request->params[0];
        $userModel = new \Application\modules\core\models\userModel($this->config);
        $user = $userModel->read($uid);
        if (empty($user)) {
            $this->forward($this->buildUrl('core/adminuser/index/0'), $this->lang('error_core_illegalparameter'),
                'error');
        }

        $groupModel = new \Application\modules\core\models\groupModel($this->config);
        $groups = $groupModel->getUserGroups($uid);

        $this->view->theme = 'backend';
        $this->view->content['title'] = $this->lang('title_details');
        $this->view->content['user'] = $user;
        $this->view->content['groups'] = $groups;

    }

    /**
     * Create a new user
     */
    public function newAction() {

        $user = array(
            'id' => 0,
            'handle' => '',
            'email' => '',
            'language' => $this->config['languages'][0],
            'active' => 1
        );

        $form = new \dollmetzer\zzaplib\Form($this->request, $this->view);
        $form->name = 'userform';
        $form->fields = $this->getUserformFields($user);
        $form->fields['password']['required'] = true;

        if ($form->process()) {

            $values = $form->getValues();

            $userModel = new \Application\modules\core\models\userModel($this->config);
            $oldUser = $userModel->getByHandle($values['handle']);
            if (!empty($oldUser)) {
                $form->fields['handle']['error'] = $this->lang('form_error_user_already_exists');
                $form->hasErrors = true;
            }

            if ($form->hasErrors === false) {

                $uid = $userModel->create(
                    $values['handle'],
                    $values['password'],
                    $values['language'],
                    $values['active'],
                    $values['email']
                );

                // attach standard user group to new user
                $groupModel = new \Application\modules\core\models\groupModel($this->config);
                $group = $groupModel->getByName('user');
                if (!empty($group)) {
                    $groupModel->addUserGroup($uid, $group['id']);
                }

                $this->forward($this->buildUrl('core/adminuser/details/' . $uid),
                    sprintf($this->lang('msg_user_created'), $values['handle']), 'message');

            }

        }

        $this->view->theme = 'backend';
        $this->view->content['title'] = $this->lang('title_new');
        $this->view->content['form'] = $form->getViewdata();

    }


    public function editAction() {

        if (sizeof($this->request->params) < 1) {
            $this->forward($this->buildUrl('core/adminuser/index/0'), $this->lang('error_core_parametermissing'),
                'error');
        }
        $uid = (int)$this->request->params[0];
        $userModel = new \Application\modules\core\models\userModel($this->config);
        $user = $userModel->read($uid);
        if (empty($user)) {
            $this->forward($this->buildUrl('core/adminuser/index/0'), $this->lang('error_core_illegalparameter'),
                'error');
        }

        $form = new \dollmetzer\zzaplib\Form($this->request, $this->view);
        $form->name = 'userform';
        $form->fields = $this->getUserformFields($user);

        if ($form->process()) {

            // get user
            $values = $form->getValues();

            $oldUser = $userModel->getByHandle($values['handle']);
            if (!empty($oldUser)) {
                if ($oldUser['id'] != $uid) {
                    $form->fields['handle']['error'] = $this->lang('form_error_user_already_exists');
                    $form->hasErrors = true;
                }
            }

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

                $this->forward($this->buildUrl('core/adminuser/details/' . $uid), $this->lang('msg_user_updated'),
                    'message');

            }

        }

        // now handle the groups
        $groupModel = new \Application\modules\core\models\groupModel($this->config);
        $userGroups = $groupModel->getUserGroups($uid);
        $allGroups = $groupModel->getList(0, 999);
        // remove groups from list that the user is already assigned to
        $groups = array();
        for ($i = 0; $i < sizeof($allGroups); $i++) {
            $found = false;
            for ($j = 0; $j < sizeof($userGroups); $j++) {
                if ($allGroups[$i]['id'] == $userGroups[$j]['id']) {
                    $found = true;
                }
            }
            if ($found === false) {
                $groups[] = $allGroups[$i];
            }
        }

        // change delete confirm dialog
        //$this->lang['msg_core_deleteconfirm'] = $this->app->lang['msg_confirm_resign'];
        //$this->lang['link_core_delete'] = $this->app->lang['link_group_resign'];

        $this->view->theme = 'backend';
        $this->view->content['title'] = $this->lang('title_edit');
        $this->view->content['form'] = $form->getViewdata();
        $this->view->content['userGroups'] = $userGroups;
        $this->view->content['groups'] = $groups;
        $this->view->content['user'] = $user;


    }


    public function deleteAction() {

        if (sizeof($this->request->params) < 1) {
            $this->forward($this->buildUrl('core/adminuser/index/0'), $this->lang('error_core_parametermissing'),
                'error');
        }
        $uid = (int)$this->request->params[0];
        $userModel = new \Application\modules\core\models\userModel($this->config);
        $user = $userModel->read($uid);
        if (empty($user)) {
            $this->forward($this->buildUrl('core/adminuser/index/0'), $this->lang('error_core_illegalparameter'),
                'error');
        }

        $userModel->delete($uid);

        $this->forward($this->buildUrl('core/adminuser/index/0'), sprintf($this->lang('msg_user_deleted'), $user['handle']), 'message');

    }


    /**
     * Change the table sorting and forward to table view
     */
    public function sortAction() {

        if (sizeof($this->request->params) < 2) {
            $this->forward($this->buildUrl('core/adminuser/index/0'), $this->lang('error_core_illegalparameter'),
                'error');
        }

        // get and check sort column
        $sortColumn = $this->request->params[0];
        $columns = $this->getColumns();
        if (!in_array($sortColumn, array_keys($columns))) {
            $this->forward($this->buildUrl('core/adminuser/index/0'), $this->lang('error_core_illegalparameter'),
                'error');
        }
        if ($columns[$sortColumn]['sortable'] !== true) {
            $this->forward($this->buildUrl('core/adminuser/index/0'), $this->lang('error_core_illegalparameter'),
                'error');
        }

        // get and check sort direction
        $sortDirection = $this->request->params[1];
        if ($sortDirection != 'desc') {
            $sortDirection = 'asc';
        }

        $this->session->sortUserCol = $sortColumn;
        $this->session->sortUserDir = $sortDirection;

        $this->forward($this->buildUrl('core/adminuser/index/0'));

    }


    public function profileAction()
    {

        $this->view->content['title'] = 'User Profile';

        $this->view->theme = 'backend';

    }

    public function settingsAction()
    {

        $this->view->content['title'] = 'User Settings';

        $this->view->theme = 'backend';

    }

    public function searchAction() {

        print_r($_POST);

        $this->view->content['title'] = 'User Search';


        $this->view->theme = 'backend';

    }


    /**
     * Assign a user to a group
     */
    public function assigngroupAction()
    {

        if (sizeof($this->request->params) < 2) {
            $this->forward($this->buildUrl('core/adminuser/index/0'), $this->lang('error_core_parametermissing'),
                'error');
        }

        $uid = (int)$this->request->params[0];
        $userModel = new \Application\modules\core\models\userModel($this->config);
        $user = $userModel->read($uid);
        if (empty($user)) {
            $this->forward($this->buildUrl('core/adminuser/index/0'), $this->lang('error_core_illegalparameter'),
                'error');
        }

        $gid = (int)$this->request->params[1];
        $groupModel = new \Application\modules\core\models\groupModel($this->config);
        $group = $groupModel->read($gid);
        if (empty($group)) {
            $this->forward($this->buildUrl('core/adminuser/index/0'), $this->lang('error_core_illegalparameter'),
                'error');
        }

        $groupModel->addUserGroup($uid, $gid);

        $this->forward($this->buildUrl('core/adminuser/edit/' . $uid),
            sprintf($this->lang('msg_group_assigned'), $user['handle'], $group['name']), 'message');

    }


    public function resigngroupAction()
    {

        if (sizeof($this->request->params) < 2) {
            $this->forward($this->buildUrl('core/adminuser/index/0'), $this->lang('error_core_parametermissing'),
                'error');
        }

        $uid = (int)$this->request->params[0];
        $userModel = new \Application\modules\core\models\userModel($this->config);
        $user = $userModel->read($uid);
        if (empty($user)) {
            $this->forward($this->buildUrl('core/adminuser/index/0'), $this->lang('error_core_illegalparameter'),
                'error');
        }

        $gid = (int)$this->request->params[1];
        $groupModel = new \Application\modules\core\models\groupModel($this->config);
        $group = $groupModel->read($gid);
        if (empty($group)) {
            $this->forward($this->buildUrl('core/adminuser/index/0'), $this->lang('error_core_illegalparameter'),
                'error');
        }

        $groupModel->deleteUserGroup($uid, $gid);

        $this->forward($this->buildUrl('core/adminuser/edit/' . $uid),
            sprintf($this->lang('msg_group_resigned'), $user['handle'], $group['name']), 'message');

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
            'active' => array(
                'type' => 'active',
                'sortable' => true,
                'width' => '5%',
            ),
            'handle' => array(
                'type' => 'text',
                'sortable' => true,
                'width' => '25%',
            ),
            'language' => array(
                'type' => 'text',
                'sortable' => true,
                'width' => '10%',
            ),
            'created' => array(
                'type' => 'datetime_short',
                'sortable' => true,
                'width' => '15%',
            ),
            'confirmed' => array(
                'type' => 'datetime_short',
                'sortable' => true,
                'width' => '15%',
            ),
            'lastlogin' => array(
                'type' => 'datetime_short',
                'sortable' => true,
                'width' => '15%',
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
     * Returns a definition array for the user form
     *
     * @param array $_user
     * @return array
     */
    protected function getUserformFields($_user)
    {

        $languages = array();
        foreach ($this->config['languages'] as $lang) {
            $languages[$lang] = $this->lang('language_' . $lang) . ' (' . $lang . ')';
        }

        return array(
            'id' => array(
                'type' => 'hidden',
                'value' => $_user['id'],
            ),
            'handle' => array(
                'type' => 'text',
                'value' => $_user['handle'],
                'minlength' => 4,
                'maxlength' => 32,
                'required' => true,
                'help' => $this->lang('form_help_registerform_handle'),
            ),
            'email' => array(
                'type' => 'email',
                'maxlength' => 255,
                'value' => $_user['email'],
            ),
            'password' => array(
                'type' => 'password',
                'minlength' => 4,
                'maxlength' => 32,
                'value' => '',
                'help' => $this->lang('form_help_registerform_password'),
            ),
            'language' => array(
                'type' => 'select',
                'options' => $languages,
                'value' => $_user['language'],
                'required' => true,
            ),
            'active' => array(
                'type' => 'checkbox',
                'value' => $_user['active'],
            ),
            'submit' => array(
                'type' => 'submit',
            ),

        );

    }
}