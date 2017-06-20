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

namespace Application\modules\stream\api;

/**
 * Class indexController
 *
 * @author Dirk Ollmetzer (dirk.ollmetzer@ollmetzer.com)
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL 3.0
 * @copyright 2016-2017 Dirk Ollmetzer (dirk.ollmetzer@ollmetzer.com)
 * @package zzap_app
 * @subpackage core
 */
class indexController extends \dollmetzer\zzaplib\ApiController
{

    /**
     * Returns a list of stream messages
     *
     * @return array
     */
    public function getAction() {

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
        $entries = (int)$messageModel->getListEntries($streamNames);
        $table->calculateMaxPage($entries);
        $first = $page * $entriesPerPage;

        $table->urlPage = 'stream/message/index';

        $messages = $messageModel->getList($streamNames, $first, $entriesPerPage);

        $result = array(
            'page' => $page,
            'num_pages' => $table->maxPage,
            'first_entry' => $first,
            'last_entry' => $first+sizeof($messages),
            'entries' => $entries,
            'per_page' => $entriesPerPage,
            'messages' => $this->prepareMessages($messages)
        );

        return $result;

    }

    /**
     * Strips unnecessary data from messagelist
     *
     * @param $_messages
     * @return array
     */
    protected function prepareMessages($_messages) {

        $messages = array();

        foreach($_messages as $msg) {
            $messages[] = array(
                'mid' => $msg['mid'],
                'parent_mid' => $msg['parent_mid'],
                'written' => $msg['written'],
                'from' => $msg['from'],
                'subject' => $msg['subject'],
            );
        }

        return $messages;

    }


}