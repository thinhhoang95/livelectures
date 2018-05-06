<?php
/**
 * Created by IntelliJ IDEA.
 * User: hoang
 * Date: 30/04/2018
 * Time: 14:42
 */

class User
{
    public $ident;
    public $id;

    public function __construct($ident,$id)
    {
        $this->ident = $ident;
        $this->id = $id;
    }
}