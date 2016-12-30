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
 * Class adminController
 *
 * @author Dirk Ollmetzer (dirk.ollmetzer@ollmetzer.com)
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL 3.0
 * @copyright 2016-2017 Dirk Ollmetzer (dirk.ollmetzer@ollmetzer.com)
 * @package zzap_app
 * @subpackage core
 */
class adminController extends Controller
{

    /*
    public $accessGroups = array(

        'index' => array('admin')

    );
    */


    public function indexAction() {

        $overviewAlerts = array(

        );

        $overviewMessages = array(
            array(
                'id' => '451',
                'name' => 'Claus Santnji',
                'time' => '2016-12-24 16:12:14',
                'shorttext' => 'So, der erste Kunde ist bedient. Das wird heute ...'
            ),
            array(
                'id' => '375',
                'name' => 'Clara Blikk',
                'time' => '2016-12-24 14:37:12',
                'shorttext' => 'Der Hein gelaubt noch an den Weihnachtsmann. Ist das nicht süß?'
            ),
            array(
                'id' => '373',
                'name' => 'Hein Doof',
                'time' => '2016-12-24 14:00:00',
                'shorttext' => 'In zwei Stunden kommt der Weihnachtsmann'
            )
        );


        $this->view->content['title'] = 'Dashboard';

        $this->view->content['overviewAlerts'] = $overviewAlerts;

        $this->view->content['link_to_message'] = '/message/admin/view/';
        $this->view->content['link_to_messages'] = '/message/admin';
        $this->view->content['overviewMessages'] = $overviewMessages;

        $this->view->theme = 'backend';

    }


    public function testAction() {

        $form = new \dollmetzer\zzaplib\Form($this->request);
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
            var_dump($values);
            die();
        }

        $this->view->content['title'] = 'Form test';
        $this->view->theme = 'backend';
        $this->view->content['form'] = $form->getViewdata();

    }


}