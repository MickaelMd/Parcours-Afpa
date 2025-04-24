<?php 
session_start();
$_SESSION['list'] = [

    "test" => 1,
    "test2" => 2,
    "test3" => 3

]; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="test_script.php" method="get">

        <input type="text" name="test_id" id="">
        <button type="submit">test</button>
    </form>

    <hr>

    <form action="test_script.php" method="POST">

        <input type="text" name="post_test1" id=""> </br>
        <input type="text" name="post_test2" id=""> </br>
        <input type="text" name="post_test3" id=""> </br>
        <input type="text" name="post_test4" id=""> </br>
        <button type="submit" name="btn_post">test</button>
    </form>

</body>

</html>