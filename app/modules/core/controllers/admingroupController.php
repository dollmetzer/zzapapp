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
 * Class admingroupController
 *
 * @author Dirk Ollmetzer (dirk.ollmetzer@ollmetzer.com)
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL 3.0
 * @copyright 2016-2017 Dirk Ollmetzer (dirk.ollmetzer@ollmetzer.com)
 * @package zzap_app
 * @subpackage core
 */
class admingroupController extends Controller
{

    /**
     * @var array $accessGroups For every action name is an array of allowed user groups
     */
    public $accessGroups = array(
        'index' => 'administrator',
        'search' => 'administrator',
    );


    /**
     * Method is called before any controller action.
     * Overload in the application controller to use
     */
    public function before() {

        $this->view->content['searchurl'] = $this->buildURL('core/admingroup/search');
        $this->view->content['searchtext'] = 'Search for group...';
        $this->view->theme = 'backend';

    }

    public function indexAction()
    {

        $this->view->content['title'] = $this->lang('title_groups');

    }

    public function searchAction() {

        print_r($_POST);

        $this->view->content['title'] = $this->lang('title_group_search');

    }

}