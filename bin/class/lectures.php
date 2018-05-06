<?php
/**
 * Created by IntelliJ IDEA.
 * User: hoang
 * Date: 04/05/2018
 * Time: 11:53
 */

include_once "db.php";
include_once "lecture.php";

$db = new DbMan();

class Lectures
{
    public $lectures = [];

    public function getLectures()
    {
        global $db;
        $result = $db->query("SELECT * FROM lecture");
        while($row = $result->fetch_array(MYSQLI_ASSOC))
        {
            $lecture = new Lecture($row["id"],$row["metaurl"],$row["type"]);
            $lecture->setTitle($row["title"]);
            $this->lectures[] = $lecture;
        }
        return $this->lectures;
    }

    public function getCurrentLecture()
    {
        global $db;
        $result = $db->query("SELECT * FROM lecture AS l WHERE l.id = (SELECT v FROM settings AS s WHERE s.k='current_lecture')");
        $row = $result->fetch_array(MYSQLI_ASSOC);
        return new Lecture($row["id"],$row["metaurl"],$row["type"]);
    }

    public function getLecture($id)
    {
        global $db;
        $result = $db->query("SELECT * FROM lecture WHERE id='$id'");
        $row = $result->fetch_array(MYSQLI_ASSOC);
        return new Lecture($row["id"],$row["metaurl"],$row["type"]);
    }
}