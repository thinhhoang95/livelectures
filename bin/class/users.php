<?php
/**
 * Created by IntelliJ IDEA.
 * User: hoang
 * Date: 30/04/2018
 * Time: 14:40
 */

include_once "db.php";
include_once "user.php";

$db = new DbMan();

class Users
{
    public $users = [];

    public function getUsers()
    {
        global $db;
        $result = $db->query("SELECT * FROM users");
        while($row = $result->fetch_array(MYSQLI_ASSOC))
        {
            $user = new User($row["username"],$row["id"]);
            $this->users[]=$user;
        }
        return $this->users;
    }

    public function newUser($ident)
    {
        global $db;
        $db->query("INSERT INTO users (id, username) VALUES ('','$ident')");
    }

    public function deleteUser($ident)
    {
        global $db;
        $db->query("DELETE FROM users WHERE username='$ident'");
    }

    public function getUserPoints($ident)
    {
        global $db;
        $result = $db->query("SELECT SUM(progress.points) AS points FROM progress WHERE user_id=(SELECT id FROM users WHERE username='$ident');");
        $row = $result->fetch_array(MYSQLI_ASSOC);
        return $row["points"];
    }

    public function getUserByIdent($ident)
    {
        global $db;
        $result = $db->query("SELECT * FROM users WHERE username='$ident'");
        $row=$result->fetch_array(MYSQLI_ASSOC);
        return new User($row["username"],$row["id"]);
    }
}
?>