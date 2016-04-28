<?php

/*
 * Created by NetBeans
 * User:Ryan
 * Date:2016.04.26 
 * Time:15:12
 */
class Sqlzsgc{
    function sql_Connect(){
        $dbServer = "localhost";
        $dbUser = "root";
        $dbPass = "jj1218";
        $dbName = "test";
        $charset="utf8";
        //链接数据库服务器
        global $conn;
        $conn = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName);
        if(mysqli_connect_errno($conn)){
            die("connction failed");
        }
        else{
            echo'connection succeed';
        }
        mysqli_set_charset($conn, $charset);
    }
    function sql_caozuo($query){
        //$this->sql_Connect();
        global $conn;
        mysqli_query($conn, $query);
    }
    function sql_chaxun(){
        global $conn;
        $result=  mysqli_query($conn, "SELECT Number,Name FROM s");
        $row = mysqli_fetch_array($result);
        //echo'<br>Number:'.$row[0].' Name:'.$row[1];
        return $row;
    }
}

