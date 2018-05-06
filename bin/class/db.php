<?php
/**
 * Created by IntelliJ IDEA.
 * User: hoang
 * Date: 30/04/2018
 * Time: 14:34
 */
class DbMan
{
    public $db;

    public function __construct()
    {
        $this->db = mysqli_connect("localhost","root","","livelectures");
        $this->db->set_charset("utf8");
    }

    public function query($sql)
    {
        return $this->db->query($sql);
    }
}


?>