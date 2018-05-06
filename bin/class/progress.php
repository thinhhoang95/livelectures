<?php
/**
 * Created by IntelliJ IDEA.
 * User: hoang
 * Date: 04/05/2018
 * Time: 13:02
 */

include_once "db.php";
include_once "users.php";

$db = new DbMan();
$users = new Users();

class Progress
{
    public static function registerProgress($ident,$lec_id,$points)
    {
        global $db;
        global $users;
        $user_id = $users->getUserByIdent($ident)->id;
        if(!self::isProgress($ident,$lec_id))
        {
            $db->query("INSERT INTO progress(id,user_id,lecture_id,points) VALUES ('','$user_id','$lec_id','$points')");
            return true;
        } else
        {
            return false;
        }
    }
    public static function isProgress($ident,$lec_id)
    {
        global $db;
        global $users;
        $user_id = $users->getUserByIdent($ident)->id;
        $result=$db->query("SELECT * FROM progress WHERE user_id='$user_id' AND lecture_id='$lec_id'");
        if($result->num_rows>0)
        {
            return true;
        } else
        {
            return false;
        }
    }
}