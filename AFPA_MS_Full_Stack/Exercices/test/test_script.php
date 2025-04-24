<?php
session_start();


$id = "test";


if (isset($_GET['test_id'])) {

    $_SESSION['id'] = $_GET['test_id'];

}
echo $_SESSION['id'] . "</br>";

print_r($_SESSION);

echo "</br>";

print_r($_SESSION['list']);

echo "</br>" . $_SESSION['list'][$id];
echo "</br>" . $_SESSION['list']['test2'];
echo "</br>" . $_SESSION['list']['test3'];

echo "<hr>";

if (isset($_POST['btn_post'])) {
    print_r($_POST);
}