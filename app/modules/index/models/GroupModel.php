<?php
/**
 * E x a m p l e   a p p l i c a t i o n   s c a f f o l d
 * ========================================================
 * For the zzaplib 3 mini framework
 *
 * @author Dirk Ollmetzer (dirk.ollmetzer@ollmetzer.com)
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL 3.0
 * @copyright 2019 Dirk Ollmetzer (dirk.ollmetzer@ollmetzer.com)
 */

namespace Application\modules\index\models;

use dollmetzer\zzaplib\model\DbModel;

class GroupModel extends DBModel
{
    /**
     * @var string $tablename Name for standard CRUD
     */
    protected $tablename = 'group';

    /**
     * Get a list of all groups for a certain user
     *
     * @param integer $_userId
     * @return array
     */
    public function getUserGroups($_userId)
    {
        $sql = "SELECT g.*
                FROM `user_group` AS ug
                JOIN `group` AS g ON g.id=ug.group_id
                WHERE `user_id`=?
                    AND g.active=1";
        $values = array($_userId);
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($values);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Get a group by its name
     *
     * @param string $_name
     * @return array
     */
    public function getByName($_name)
    {
        $sql = "SELECT * FROM `group` WHERE name=?";
        $values = array($_name);
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($values);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Get a list of groups
     *
     * @param integer $_first
     * @param integer $_length
     * @param string $_sortColumn
     * @param string $_sortDirection
     * @return array
     */
    public function getList($_first = null, $_length = null, $_sortColumn = null, $_sortDirection = 'asc')
    {
        $sql = "SELECT * FROM `group`";
        if ($_sortColumn) {
            if ($_sortDirection != 'desc') {
                $_sortDirection = 'asc';
            }
            $sql .= ' ORDER BY ' . $_sortColumn . ' ' . strtoupper($_sortDirection);
        }
        if (isset($_first) && isset($_length)) {
            $sql .= ' LIMIT ' . (int)$_first . ',' . (int)$_length;
        }
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        $list = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $list;
    }

    /**
     * Get the number of entries in a group list
     *
     * @return integer
     */
    public function getListEntries()
    {
        $sql = "SELECT count(*) AS entries FROM `group`";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['entries'];
    }

    /**
     * Add a user to a group
     *
     * @param integer $_userId
     * @param integer $_groupId
     */
    public function addUserGroup($_userId, $_groupId)
    {
        $sql = "SELECT * FROM user_group WHERE user_id=? AND group_id=?";
        $values = array($_userId, $_groupId);
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($values);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (empty($result)) {
            $sql = "INSERT INTO user_group (user_id, group_id) VALUES (?, ?)";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute($values);
        }
    }

    /**
     * Delete a user from a group
     *
     * @param integer $_userId
     * @param integer $_groupId
     */
    public function deleteUserGroup($_userId, $_groupId)
    {
        $sql = "DELETE FROM user_group WHERE user_id=? AND group_id=?";
        $values = array($_userId, $_groupId);
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($values);
    }

    /**
     * Search for a group
     *
     * @param string $_searchterm
     * @param integer $_first
     * @param integer $_length
     * @param string $_sortColumn
     * @param string $_sortDirection
     * @return array users
     */
    public function search($_searchterm, $_first = null, $_length = null, $_sortColumn = null, $_sortDirection = 'asc')
    {
        $sql = "SELECT * FROM `group` WHERE name LIKE " . $this->dbh->quote($_searchterm);
        if ($_sortColumn) {
            if ($_sortDirection != 'desc') {
                $_sortDirection = 'asc';
            }
            $sql .= ' ORDER BY ' . $_sortColumn . ' ' . strtoupper($_sortDirection);
        }
        if (isset($_first) && isset($_length)) {
            $sql .= ' LIMIT ' . (int)$_first . ',' . (int)$_length;
        }
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        $list = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $list;
    }

    /**
     * Get the number of results for a search
     *
     * @param string $_searchterm
     * @return array
     */
    public function getSearchEntries($_searchterm)
    {
        $sql = "SELECT COUNT(*) as entries FROM `group` WHERE name LIKE " . $this->dbh->quote($_searchterm);
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['entries'];
    }

}