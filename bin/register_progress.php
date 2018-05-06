<?php
/**
 * Created by IntelliJ IDEA.
 * User: hoang
 * Date: 04/05/2018
 * Time: 14:27
 */
include_once "class/progress.php";
$ident = $_POST["ident"];
$lec_id = $_POST["lec_id"];
$points = $_POST["points"];
if(Progress::registerProgress($ident,$lec_id,$points))
{
    echo "Progress recorded successfully!";
} else {
    echo "You have already recorded this progress!";
}
?>