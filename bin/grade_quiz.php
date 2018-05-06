<?php
/**
 * Created by IntelliJ IDEA.
 * User: hoang
 * Date: 06/05/2018
 * Time: 08:31
 */
include_once "class/quiz.php";
include_once "class/lectures.php";

$lectures = new Lectures();
$lec_id = $_POST["lec_id"];
$lecture = $lectures->getLecture($lec_id);

$quiz = new Quiz("../lecture/".$lecture->metaurl);
$points = $quiz->gradeQuiz($_POST);
$quiz->saveProgress($_POST["ident"],$_POST["lec_id"]);

echo "Successfully graded your submission! You have ".$points." points, which corresponds to ".($points/5)." correct answers! Note that if you have already submitted your quiz, no more points will be gained.";
?>