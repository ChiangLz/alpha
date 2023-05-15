<?php
class conexion{
    public static function con(){
        include 'liga_BD.php';
        $link->set_charset("utf8");
        return $link;
    }
}
?>