<?php
/**
 * Created by IntelliJ IDEA.
 * User: hoang
 * Date: 06/05/2018
 * Time: 08:40
 */
unset($_COOKIE["ident"]);
unset($_COOKIE["ip"]);
// empty value and expiration one hour before
setcookie("ident", '', time() - 3600,'/');
setcookie("ip", '', time() - 3600,'/');
header('location: index.php');
?>