<?php
/**
 * Created by IntelliJ IDEA.
 * User: hoang
 * Date: 30/04/2018
 * Time: 14:33
 */

include_once "class/users.php";

$ident = $_POST["ident"];
$ip = $_POST["ip"];

$users = new Users();
$users->newUser($ident);
setcookie("ident",$ident,time() + (86400 * 30), "/");
setcookie("ip",$ip,time()+(86400*30),"/");
echo "Redirecting to main page...";
echo "<script>";
echo "window.location = '../learn.php'";
echo "</script>";

?>