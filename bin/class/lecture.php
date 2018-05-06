<?php
/**
 * Created by IntelliJ IDEA.
 * User: hoang
 * Date: 04/05/2018
 * Time: 11:52
 */

class Lecture
{
    public $id;
    public $metaurl;
    public $type;
    public $title;

    public function __construct($id,$metaurl,$type)
    {
        $this->id=$id;
        $this->metaurl=$metaurl;
        $this->type=$type;
    }

    public function setTitle($title)
    {
        $this->title=$title;
    }
}