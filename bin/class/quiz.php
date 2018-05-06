<?php
/**
 * Created by IntelliJ IDEA.
 * User: hoang
 * Date: 06/05/2018
 * Time: 07:53
 */

include_once "db.php";
include_once "progress.php";

class Quiz
{
    private $quiz_file;
    private $quiz_file_binary;
    private $quiz;
    private $points = 0;

    public function __construct($quiz_file)
    {
        $this->quiz_file=$quiz_file;
        $this->quiz_file_binary = file_get_contents($this->quiz_file);
        $this->quiz = json_decode($this->quiz_file_binary, TRUE);
    }
    public function getNumOfQuestions()
    {

        return sizeof($this->quiz["quiz"]);
    }
    public function gradeQuiz($_post)
    {
        $q=0;
        $points = 0;
        foreach($this->quiz["quiz"] as $question)
        {
            $correct_answer = $this->quiz["quiz"][$q]["correct_answer"];
            if(isset($_post["Q".$q]))
            {
                $user_answer = $_post["Q".$q];
                if(strtolower(trim($user_answer))==strtolower(trim($correct_answer)))
                {
                    $points+=5;
                }
            }
            $q++;
        }
        $this->points=$points;
        return $points;
    }
    public function saveProgress($ident,$lec_id)
    {
        $lectures = new Lectures();
        Progress::registerProgress($ident,$lec_id,$this->points);
    }
    public function writeQuiz()
    {
        echo "<form name='quiz_form' id='quiz_form'>";

        $possible_answers = ["0","A","B","C","D","E","F","G","H","I","J","K","L"];

        $q=0;
        foreach($this->quiz["quiz"] as $question)
        {
            echo "<div class='form-group'>";
            echo "<p>".$question["question"]."</p>";
            $a = 0;
            foreach($this->quiz["quiz"][$q]["answers"] as $answer)
            {
                $a++;
                $checked = $a==1?'checked':'';
                echo '<div class="form-check">
          <input class="form-check-input" type="radio" name="Q'.$q.'" id="Q'.$q.'-'.$a.'" value="'.$possible_answers[$a].'" '.$checked.'>
          <label class="form-check-label" for="Q'.$q.'-'.$a.'">
            '.$possible_answers[$a].'. '.$answer.'
          </label>
        </div>';
            }
            echo "</div>";
            $q++;
        }
        echo "</form>";
    }
}