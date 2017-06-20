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

namespace Application\modules\stream\controllers;

/**
 * Class messageController
 * Actions around the news stream
 *
 * @author Dirk Ollmetzer (dirk.ollmetzer@ollmetzer.com)
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL 3.0
 * @copyright 2016-2017 Dirk Ollmetzer (dirk.ollmetzer@ollmetzer.com)
 * @package zzap_app
 * @subpackage stream
 */
class messageController extends \Application\modules\core\controllers\Controller
{

    /**
     * @var array $accessGroups For every action name is an array of allowed user groups
     */
    public $accessGroups = array(
        'index' => array('guest', 'user'),
        'new' => array('user'),
    );


    /**
     * Show news stream
     */
    public function indexAction()
    {

        $messageModel = new \Application\modules\stream\models\messageModel($this->config);

        if (in_array('user', $this->session->groups)) {
            $streamNames = array('guest', 'user');
        } else {
            $streamNames = array('guest');
        }

        // calculate pagination
        $table = new \dollmetzer\zzaplib\Table();
        $page = 0;
        if (sizeof($this->request->params) > 0) {
            $page = (int)$this->request->params[0];
        }
        $table->page = $page;
        $entriesPerPage = 10;
        $table->entriesPerPage = $entriesPerPage;
        $table->calculateMaxPage($messageModel->getListEntries($streamNames));
        $first = $page * $entriesPerPage;

        $table->urlPage = 'stream/message/index';

        $messages = $messageModel->getList($streamNames, $first, $entriesPerPage);

        $this->view->content['title'] = $this->lang('title_message_stream');
        $this->view->content['table'] = $table;

        $this->view->content['messages'] = $messages;

    }

    /**
     * write new news entry
     */
    public function newAction() {

        $form = new \dollmetzer\zzaplib\Form($this->request, $this->view);
        $form->name = 'registerform';
        $form->fields = array(
            'subject' => array(
                'type' => 'text',
                'required' => true,
                'maxlength' => 128,
            ),
            'message' => array(
                'type' => 'textarea',
                'required' => true,
                'rows' => 6,
            ),
            'submit' => array(
                'type' => 'submit',
                'value' => 'login'
            ),
        );

        if ($form->process()) {

            $values = $form->getValues();

            

            print_r($values);
            die();

        }

        $this->view->content['form'] = $form->getViewdata();
        $this->view->content['title'] = $this->lang('title_message_new');

    }

}