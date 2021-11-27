<?php
/**
 * E x a m p l e   a p p l i c a t i o n   s c a f f o l d
 * ========================================================
 * For the zzaplib 3 mini framework
 *
 * @author Dirk Ollmetzer (dirk.ollmetzer@ollmetzer.com)
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL 3.0
 * @copyright 2006-2022 Dirk Ollmetzer (dirk.ollmetzer@ollmetzer.com)
 */

namespace Application\modules\index\controllers;

use Application\modules\index\models\UserModel;
use dollmetzer\zzaplib\controller\WebController;
use dollmetzer\zzaplib\data\Table;

class AdminuserController extends WebController
{
    /*
    public $permission = [
        'login' => ['Guest'],
        'register' => ['Guest'],
        'confirm' => ['Guest'],
        'resetpassword' => ['Guest'],
        'impersonate' => ['Operator'],
    ];
    */

    /**
     * Method is called before any controller action.
     * Overload in the application controller to use
     */
    public function before()
    {
        $this->view->addContent('searchurl', $this->router->buildURL('users/adminuser/search'));
        $this->view->addContent('searchtext', $this->translator->translate('txt_user_search_placeholder'));
        $this->view->theme = 'backend';
    }

    public function indexAction()
    {
        $userModel = new UserModel($this->config, $this->logger);

        // set table columns
        $columns = $this->getColumns();
        $table = new Table();
        $table->setColumns($columns);

        // calculate pagination
        $page = 0;
        $params = $this->request->getParams();
        if (sizeof($params) > 0) {
            $page = (int)$params[0];
        }
        $table->setPage($page);
        /*
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
        */
        $this->view->addContent('table', $table);
        $this->view->addContent('title', $this->translator->translate('title_users'));
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
}
