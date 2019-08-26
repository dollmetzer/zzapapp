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

class UserModel extends DbModel
{
    /**
     * @var string $tablename Name for standard CRUD
     */
    protected $tablename = 'user';

    /**
     * create a new user
     *
     * @param string $_handle
     * @param string $_password Hash password only, if set
     * @param string $_language
     * @param int $_active
     * @param string $_email
     * @param string $_confirmcode
     * @param string $_created Datetime string
     * @param string $_confirmed Datetime string
     * @return integer
     *
    public function create(
        $_handle,
        $_password,
        $_language,
        $_active,
        $_email = '',
        $_confirmcode = '',
        $_created = '',
        $_confirmed = ''
    ) : int {
        if ($_active != 0) {
            $_active = 1;
        }
        if ($_created == '') {
            $_created = strftime('%Y-%m-%d %H:%H:%S');
        }
        if ($_confirmed == '') {
            $_confirmed = strftime('%Y-%m-%d %H:%H:%S');
        }
        if ($_password != '') {
            $_password = hash('sha256', $_password);
        }
        $sql = "INSERT INTO user (
                    handle,
                    password,
                    language,
                    active,
                    email,
                    confirmcode,
                    created,
                    confirmed
                ) VALUES (
                    " . $this->dbh->quote($_handle) . ",
                    " . $this->dbh->quote($_password) . ",
                    " . $this->dbh->quote($_language) . ",
                    $_active,
                    " . $this->dbh->quote($_email) . ",
                    " . $this->dbh->quote($_confirmcode) . ",
                    " . $this->dbh->quote($_created) . ",
                    " . $this->dbh->quote($_confirmed) . "
                )";
        $this->dbh->exec($sql);
        return $this->dbh->lastInsertId();
    }
     * */

    /**
     * Set password
     *
     * @param integer $uid
     * @param string $password
     */
    public function setPassword($uid, $password)
    {
        $sql = "UPDATE user 
                SET password=" . $this->dbh->quote(hash('sha256', $password)) . " 
                WHERE id=" . (int)$uid;
        $this->dbh->exec($sql);
    }

    /**
     * Confirm a new user as registered
     *
     * @param int $uid User ID
     * @param string $password
     * @param string $language
     */
    public function confirm($uid, $password, $language)
    {
        $sql = "UPDATE user 
                SET password=" . $this->dbh->quote(hash('sha256', $password)) . ",
                    language=" . $this->dbh->quote($language) . ",
                    confirmed=" . $this->dbh->quote(strftime('%Y-%m-%d %H:%M:%S', time())) . ",
                    confirmcode=''
                WHERE id=" . (int)$uid;
        $this->dbh->exec($sql);
    }

    /**
     * Get a user by his handle
     *
     * @param string $handle
     * @return array
     */
    public function getByHandle($handle)
    {
        $sql = "SELECT * FROM user WHERE handle = ?";
        $values = array(
            $handle
        );
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($values);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Returns a user, if login is possible
     *
     * @param string $handle
     * @param string $password
     * @return false|array
     */
    public function getByLogin($handle, $password)
    {
        $sql = "SELECT *
                FROM user
                WHERE handle = ?
                    AND password=?
                    AND active=1";
        $values = array(
            $handle,
            hash('sha256', $password)
        );

        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($values);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $user;
    }

}