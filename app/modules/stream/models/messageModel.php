<?php
/**
 * z z a p l i b   a p p l i c a t i o n   s c a f f o l d
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

namespace Application\modules\stream\models;

/**
 * Handling of stream messages
 *
 * @author Dirk Ollmetzer (dirk.ollmetzer@ollmetzer.com)
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL 3.0
 * @copyright 2016-2017 Dirk Ollmetzer (dirk.ollmetzer@ollmetzer.com)
 * @package zzapapp
 * @subpackage stream
 */
class messageModel extends \dollmetzer\zzaplib\DBModel
{

    /**
     * @var string $tablename Name for standard CRUD
     */
    protected $tablename = 'message';


    /**
     * Get a list of entries
     *
     * @param integer $_first
     * @param integer $_length
     * @return array
     */
    public function getList(array $_streamNames, $_first = null, $_length = null)
    {

        $ids = $this->getStreamIds($_streamNames);

        $sql = "SELECT * FROM message WHERE `type`='stream' AND to_id IN (" . join(',',
                $ids) . ") ORDER BY written DESC";

        if (isset($_first) && isset($_length)) {
            $sql .= ' LIMIT ' . (int)$_first . ',' . (int)$_length;
        }

        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        $list = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $list;

    }

    /**
     * Get the number of entries in a user list
     *
     * @return integer
     */
    public function getListEntries(array $_streamNames)
    {

        $ids = $this->getStreamIds($_streamNames);

        $sql = "SELECT COUNT(*) as entries FROM message WHERE `type`='stream' AND to_id IN (" . join(',', $ids) . ")";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['entries'];

    }

    /**
     * Get a list of stream ids based on a list of stream names
     *
     * @param array $_streamNames
     * @return array
     */
    public function getStreamIds(array $_streamNames)
    {

        $names = array();
        foreach ($_streamNames as $name) {
            $names[] = $this->dbh->quote($name);
        }

        $sql = "SELECT id FROM stream WHERE `name` IN (" . join(',', $names) . ")";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        $list = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $ids = array();
        foreach ($list AS $entry) {
            $ids[] = $entry['id'];
        }

        return $ids;

    }

    public function getMessageByMid($_mid) {

        $sql = "SELECT * FROM stream WHERE mid=".$this->dbh->quote($_mid);
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);

    }

}