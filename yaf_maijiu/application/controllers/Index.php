<?php

/*
 * Created by NetBeans
 * User:Ryan
 * Date:
 * Time:
 */
class IndexController extends Yaf_Controller_Abstract{
    public function indexAction(){
         if(!empty($_POST)){
            if(isset($_POST['money'])&& $_POST['money']>0){
                global $jiuping;
                global $gaizi;
                global $sum;
                global $money;
                $jiuping=0;
                $gaizi=0;
                $sum=0;
                $money = $_POST['money'];
                echo'$money='.$money.'<br>';
                $maijiu = new Maijiu();
                $maijiu->maijiu($money);
            }
        }
    }
}
