<?php
/**
 * Created by IntelliJ IDEA.
 * User: hoang
 * Date: 06/05/2018
 * Time: 02:00
 */

include_once "class/quiz.php";
$quiz = new Quiz("lecture/".$lecture->metaurl);

$quiz->writeQuiz();

?>