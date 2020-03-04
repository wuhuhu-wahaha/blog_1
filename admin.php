<?php
    define ('ROOT_PATH', realpath(dirname(__FILE__)));
    define('BASE_URL', 'http://localhost/blog_1/');
    require_once( __DIR__ . '/src/includes/head.php')
?>
<title>Admin | Manage users</title>
    <?PHP include(__DIR__ . '/src/controller/managerUsers.php') ?>
</head>
<table width="100%">
    <tr>
        <td align="center"><?php include(__DIR__ . '/src/includes/menu.php') ?></td>
    </tr>
    <tr>
        <td align="center"><h5>&nbsp;</h5></td>
    </tr>
    <tr>
        <td align="center"><h5>Create/Update User: </h5></td>
    </tr>
    <tr>
    <tr>
        <td>
            <table cellpadding="50" align="center">
                <tr>
                    <td>
                        <?php if (empty($users)): ?>
                            <h1>No users in the database.</h1>
                        <?php else: ?>
                        <table align="center" border="1" cellpadding="5" cellspacing="3">
                            <thead>
                                <th>Pos</th>
                                <th>Nick</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th colspan="2">Action</th>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $key => $user): ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $user['username']; ?></td>
                                    <td>&nbsp;<?php echo $user['email']; ?></td>
                                    <td><?php echo $user['role']; ?></td>
                                    <td>
                                        <a href="admin.php?edit-user=<?php echo $user['id'] ?>"> update</a>
                                    </td>
                                    <td>
                                        <a href="admin.php?delete-user=<?php echo $user['id'] ?>"> delete</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            </tbody>
                        </table>
            <?php endif ?>
                        </td>
                        <td valign="top">
                            <table  cellpadding="10" valign="top">
                                <tr>
                                    <td>
                                        <form method="post" action="<?php echo BASE_URL .'/admin.php'; ?>" >
                                            <?php if ($isEditingUser === true): ?>
                                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                            <?php endif ?>
                                            <table>
                                                <tr>
                                                    <td>username</td>
                                                    <td><input type="text" name="username" value="<?php echo $username; ?>" placeholder="Username"></td>
                                                </tr>
                                                <tr>
                                                    <td>email</td>
                                                    <td><input type="email" name="email" value="<?php echo $email ?>" placeholder="Email"></td>
                                                </tr>
                                                <tr>
                                                    <td>password</td>
                                                    <td><input type="password" name="password" placeholder="Password"></td>
                                                </tr>
                                                <tr>
                                                    <td>password Confirmation </td>
                                                    <td><input type="password" name="passwordConfirmation" placeholder="Password confirmation"></td>
                                                </tr>
                                                <tr>
                                                    <td>role</td>
                                                    <td><select name="role" >
                                                            <?php foreach ($roles as $key => $role): ?>
                                                                <option value="<?php echo $role; ?>"><?php echo $role; ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td align="right">
                                                        <?php if ($isEditingUser === true): ?>
                                                            <button type="submit"  name="update_user">UPDATE</button>
                                                        <?php else: ?>
                                                            <button type="submit"  name="create_user">Save User</button>
                                                        <?php endif ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                    </td>
                </tr>
            </table>
        </td>
            </table>
        </td>
    </tr>
</table>