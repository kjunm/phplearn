<?php

/* 
 * Created by Netbeans
 * User:Ryan
 * Date:2016.04.19
 * Time:15:51
 */
class Sqlzsgc{
    function sql_Connect(){
        $dbServer = "localhost";
        $dbUser = "root";
        $dbPass = "123456";
        $dbName = "mysql_test";
        $charset="utf8";
        //链接数据库服务器
        global $conn;
        $conn = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName);
        if(mysqli_connect_errno($conn)){
            die("connction failed");
        }
        else{
            echo'connecton succeed';
        }
        mysqli_set_charset($conn, $charset);
    }
    function sql_caozuo($query){
        $this->sql_Connect();
        global $conn;
        mysqli_query($conn, $query);
    }
    function sql_chaxun(){
        global $conn;
        $result=  mysqli_query($conn, "SELECT Number,Name FROM s");
        $row = mysqli_fetch_array($result);
        echo'<br>Number:'.$row[0].' Name:'.$row[1];
    }
}
$sqlzsgc=new Sqlzsgc();
#$sqlzsgc->sql_caozuo("INSERT s (Number,Name)VALUES(1,'小智')");
#$sqlzsgc->sql_caozuo("INSERT s (Number,Name)VALUES(2,'小苍')");
#$sqlzsgc->sql_caozuo("DELETE FROM s WHERE Number=1");
#$sqlzsgc->sql_caozuo("UPDATE s  SET Name = '阿怡' WHERE Number=2");
$sqlzsgc->sql_chaxun();

