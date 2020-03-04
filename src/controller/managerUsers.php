<?php
namespace Blog\Controller;
require_once __DIR__ . '/../../vendor/autoload.php';
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

use Blog\Factories\userFactory;

$user_id = 0;
$isEditingUser = false;
$username = "";
$role = "";
$email = "";
$users = userFactory::getUserInstance()->getUsers();
$roles = ['Admin', 'Author'];

/**
 *  Edit User Control
 */
if (isset($_POST) && count($_POST) > 0) {

    switch ($_POST) {
        case key_exists('create_user', $_POST):
            createEditUser($_POST);
            break;
        case key_exists('update_user', $_POST):
            createEditUser($_POST, true);
            break;
        default:
            break;
    }
    header("Location: http://$host$uri/admin.php");

}

if (isset($_GET) && count($_GET) > 0) {
    $isEditingUser = true;
    switch ($_GET) {
        case key_exists('edit-user', $_GET):
            $editUser = userFactory::getUserInstance()->getUser($_GET['edit-user']);
            $username = $editUser['username'];
            $email = $editUser['email'];
            $user_id= $editUser['id'];
            break;
        case key_exists('delete-user', $_GET):
            userFactory::getUserInstance()->deleteUser((int) $_GET['delete-user']);
            header("Location: http://$host$uri/admin.php");
            break;
        default:
            break;
    }
}


/**
 * Creatres  or edit user
 *
 * @param array $post
 * @param bool $edit
 * @return bool
 */
function createEditUser(array $post, bool $edit = false): bool {

    $username = $post['username'];
    $email = $post['email'];
    $password = $post['password'];
    $passwordConfirmation = $post['passwordConfirmation'];
    $role = $post['role'];

    if ($password !== $passwordConfirmation) {
        return false;
    }

    switch ($edit) {
        case true:
            $userId = $post['user_id'];
            return userFactory::getUserInstance()->updateUser($userId, $username, $email, $password, $role);
            break;

        default:
            return userFactory::getUserInstance()->createUser($username, $email, $password, $role);
            break;
    }

}






//$userInstance = userFactory::getUserInstance();
//$admins = $userInstance->getAdminUsers();


