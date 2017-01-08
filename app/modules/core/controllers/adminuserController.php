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
        'profile' => array('administrator'),
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
        $table->urlPage = 'users/adminuser/index';
        $table->urlSort = 'users/adminuser/sort';
        $table->urlNew = 'users/adminuser/new';
        $table->urlDetails = 'users/adminuser/details';
        $table->urlEdit = 'users/adminuser/edit';
        $table->urlDelete = 'users/adminuser/delete';

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