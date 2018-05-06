<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administrative Panel - LiveLectures</title>
    <style>
        td {
            border: 1px #000;
        }
    </style>
</head>
<body>
<h1>
    Screen management
</h1>
<table>
    <tr><td>Screen title</td><td>View Details</td><td>Set Active</td></tr>
    <?php
    include_once "../bin/class/lectures.php";
    $lectures = new Lectures();
    $lecs = $lectures->getLectures();
    foreach ($lecs as $lec)
    {
        $meta="";
        if($lec->type=="quiz") $meta="&quiz=1";
        echo "<tr><td>".$lec->title."</td><td><a href='admin.php?d=".$lec->id.$meta."'>View Details</a></td><td><a href='set_active.php?id=".$lec->id."'>Set Active</a></td></tr>";
    }
    ?>
</table>
<h1>
    Detailed View
</h1>
<table>
    <tr><td>User Ident</td><td>Point per question</td><td>Wrong answers (if available)</td></tr>
    <?php
    if(isset($_GET["d"]))
    {
        if(isset($_GET["quiz"])&&$_GET["quiz"]==1)
        {
            $sql="SELECT progress.points AS points, users.username AS ident, wrong_answers.wrong_answers AS wrong_answers FROM progress, users, wrong_answers WHERE users.id = progress.user_id AND wrong_answers.ident = users.username AND wrong_answers.screen = progress.lecture_id AND progress.lecture_id=".$_GET["d"];
            $result=$db->query($sql);
            while($row=$result->fetch_array(MYSQLI_ASSOC))
            {
                echo "<tr><td>".$row["ident"]."</td><td>".$row["points"]."</td><td>".$row["wrong_answers"]."</td></tr>";
            }
        } else {
            $sql="SELECT users.username AS ident, progress.points AS points FROM users, progress WHERE progress.user_id=users.id AND progress.lecture_id=".$_GET["d"];
            $result=$db->query($sql);
            while($row=$result->fetch_array(MYSQLI_ASSOC))
            {
                echo "<tr><td>".$row["ident"]."</td><td>".$row["points"]."</td><td>-</td></tr>";
            }
        }
    }
    ?>
</table>
</body>
</html>