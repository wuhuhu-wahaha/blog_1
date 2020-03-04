<?php
require_once __DIR__ . '/vendor/autoload.php';
?>
<?php require_once( __DIR__ . '/src/includes/head.php') ?>
<title>Blog</title>
  </head>
  <body>
    <h1>Blog</h1>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" href="admin.php">Admin</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
    </ul>
  </body>
<?php require_once( __DIR__ . '/src/includes/footer.php') ?>


<?php
/*
use Blog\Factories\userFactory;
$userInstance = userFactory::getUserInstance();
$sfetchassoc = $userInstance->getAdminUsers();
echo "<PRE>";
print_r($sfetchassoc);
echo "</PRE>";
*/

?>


