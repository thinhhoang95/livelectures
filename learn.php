<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Learn</title>

    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

<?php
if(!isset($_COOKIE["ident"]))
{
    header("location: index.php");
}
include_once "bin/class/users.php";
$ident = $_COOKIE["ident"];
$users = new Users();
$my_points = $users->getUserPoints($ident);

include_once "bin/class/lectures.php";
$lectures = new Lectures();
?>

<div class="container">
    <div class="row d-flex align-items-center pt-4 pb-4" >
        <div class="col">
            <h4>LiveLectures</h4>
        </div>
        <div class="col-auto d-flex flex-row align-items-center">
            <span style="margin-right: 12px">@<?php echo $_COOKIE["ident"]?> / <?php echo $my_points?> points</span>
            <button type="button" class="btn btn-secondary">Latest content</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3"> <!-- Table of contents !-->
            <div class="d-flex flex-column p-2" style="background-color: #e8e8e8; font-size: 10pt">
                <p style="font-weight: bold">TABLE OF CONTENTS</p>
            <?php
            $all_lectures = $lectures->getLectures();
            foreach($all_lectures as $lec)
            {
                echo "<a href='learn.php?lecture_id=".$lec->id."'>".$lec->title."</a>";
            }
            ?>
            </div>
            <div class="mt-3"></div>
        </div>
        <div class="col">
            <?php
            if(isset($_GET["lecture_id"]))
            {
                $lec_id = $_GET["lecture_id"];
                $lecture = $lectures->getLecture($_GET["lecture_id"]);
                if ($lecture->type == "lecture")
                {
                    include_once "lecture/".$lecture->metaurl;
                    echo '<div class="d-flex flex-row justify-content-center">';
                    echo '<button type="button" class="btn btn-primary" id="mark_as_completed">Mark as completed (+10)</button>';
                    echo '</div>';
                } elseif ($lecture->type=="quiz")
                {
                    include_once "bin/quiz.php";
                    echo '<div class="d-flex flex-row justify-content-center">';
                    echo '<button type="button" class="btn btn-primary" id="submit_for_grading">Submit for grading</button>';
                    echo '</div>';
                }
            }
            else {
                $current_lecture_id = $lectures->getCurrentLecture()->id;
                header('location:learn.php?lecture_id='.$current_lecture_id);
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="mt-3"></div>
    </div>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

<script language="javascript">
    $("#mark_as_completed").on("click",function(){
        $.post("bin/register_progress.php","ident=<?php echo $ident ?>&lec_id=<?php echo $lec_id?>&points=10",function(data){
            alert(data);
            location.reload(true);
        });
    });
    $("#submit_for_grading").on("click",function(){
        var user_ans = $("#quiz_form").serialize();
        $.post("bin/grade_quiz.php","ident=<?php echo $ident ?>&lec_id=<?php echo $lec_id?>&"+user_ans,function(data){
            alert(data);
            location.reload(true);
        });
    });
</script>
</body>
</html>