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
 * Class Controller
 *
 * @author Dirk Ollmetzer (dirk.ollmetzer@ollmetzer.com)
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL 3.0
 * @copyright 2016-2017 Dirk Ollmetzer (dirk.ollmetzer@ollmetzer.com)
 * @package zzap_app
 * @subpackage core
 */
class Controller extends \dollmetzer\zzaplib\Controller
{

    /**
     * @var array $accessGroups If not empty, hold information of groups with accessright for every action
     */
    protected $accessGroups;

    /**
     * Check, if call of a certain action is allowed
     *
     * Checks, if the current user is in the group for the controller action.
     * If no group access array is found, access is granted.
     * If an group access array is found, but no entry for the actionname, access is denied
     * If an entry is found and the user is group member, access is granted.
     * If an entry is found and the user is not group meber, access is denied.
     *
     * @param string $_actionName
     * @return boolean
     */
    public function isAllowed($_actionName)
    {

        // access forbidden by default
        $result = false;

        if (empty($this->accessGroups)) {

            // access granted, if group access definition array is empty
            $result = true;

        } elseif (!empty($this->accessGroups[$_actionName])) {

            // access granted, if user is in defined group
            $userGroups = $this->session->groups;
            if(in_array($this->accessGroups[$_actionName], $userGroups)) {
                $result = true;
            }

        }

        return $result;

    }

    /**
     *
     */
    public function quicklogin()
    {

    }

}