<?php
declare(strict_types=1);

namespace Blog\Classes;
use Blog\Interfaces\database;
use mysql_xdevapi\Exception;
use mysqli_result;

/**
 * Class user
 *
 * @package Blog\Classes
 */
class user
{
    /**
     * @var database|null
     */
    private $database = null;

    /**
     * user constructor.
     *
     * @param database $db
     */
    public function __construct(database $db) {
        $this->database = $db;
    }

    /**
     * Get all users.
     *
     * @return mysqli_result
     */
    public function getUsers(): array {
        return $this->database->fetch_all('SELECT * FROM users ORDER BY id DESC');
    }

    /**
     * Fetches the admin from database
     * @param int $userId
     *
     * @return array
     */
    public function getUser(int $userId):array
    {
        return $this->database->fetch_assoc('SELECT * FROM users WHERE id= ' . $userId . ' LIMIT 1');
    }

    /**
     * delete admin user
     * @param $userID
     *
     * @return bool
     */
    public function deleteUser(int $userID): bool {
        return $this->database->query('DELETE FROM users WHERE id=' . $userID);
    }



    /**
     * Create new User.
     *
     * @param string $userName
     * @param string $email
     * @param string $passWord
     * @param string $role
     * @return bool
     */
    public function createUser(string $userName, string $email, string $passWord, string $role) : bool {

        if (!$this->_checkUserExist($email, $userName)) {

            $password = md5($passWord);

            $query = "INSERT INTO users (username, email, role, password, created_at, updated_at) 
				  VALUES('$userName', '$email', '$role', '$password', now(), now())";

            $this->database->query($query);

            return true;

        } else {
            return false;
        }

    }

    /**
     * Create new User.
     *
     * @param int $userId
     * @param string $userName
     * @param string $email
     * @param string $passWord
     * @param string $role
     * @return bool
     */
    public function updateUser(int $userId, string $userName, string $email, string $passWord, string $role) : bool {

        $password = md5($passWord);
        $query = "UPDATE users SET username='$userName', email='$email', role='$role', password='$password' WHERE id=$userId";
        return $this->database->query($query);

    }

    /**
     * Check is user exsists.
     *
     * @param string $email
     * @param $userName
     * @return bool
     */
    private function _checkUserExist(string $email, string $userName): bool
    {
        $userCheckQuery = "SELECT * FROM users WHERE username='$userName' 
							OR email='$email' LIMIT 1";

        var_dump($userCheckQuery);


        $user = $this->database->fetch_assoc($userCheckQuery);

        if ($user) {
            return true;
        }

        return false;
    }
}
