<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class IndexController extends Yaf_Controller_Abstract{
    public function indexAction(){
        $this->getView()->assign("content","Hello World");
        //$this->getView()->assign("message","Hello World");
    }
    public function sqlAction(){
        $sqlzsgc=new Sqlzsgc();
        $sqlzsgc->sql_connect();
        $sqlzsgc->sql_caozuo("INSERT s (Number,Name)VALUES(1,'小智')");
        $sqlzsgc->sql_caozuo("INSERT s (Number,Name)VALUES(2,'小苍')");
        $sqlzsgc->sql_caozuo("DELETE FROM s WHERE Number=1");
        $sqlzsgc->sql_caozuo("UPDATE s  SET Name = '阿怡' WHERE Number=2");
        $a = $sqlzsgc->sql_chaxun(); 
        $this->getView()->assign("message",$a);
    }
}
?>
