<?php
/**
 * Created by IntelliJ IDEA.
 * User: hoang
 * Date: 06/05/2018
 * Time: 10:20
 */
include_once "../bin/class/db.php";
$db = new DbMan();
$screen = $_GET["id"];
$db->query("UPDATE settings SET v=$screen WHERE k='current_lecture'");
header('location: admin.php');