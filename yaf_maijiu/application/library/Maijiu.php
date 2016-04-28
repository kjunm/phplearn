<?php

/*
 * Created by NetBeans
 * User:Ryan
 * Date:
 * Time:
 */
class Maijiu{
    function maijiu($money,$gaizi,$jiuping,$sum){              
        while($money>=2 || $jiuping>=2 || $gaizi>=4){
            if($gaizi>=4){
                $this->gaiziHuanJiu($gaizi,$sum,$jiuping);                        
            }
            else if($jiuping>=2){
                $this->jiupingHuanJiu($gaizi,$sum,$jiuping);
            }
            else if($money>=2){
                $this->moneyMaiJiu($gaizi,$sum,$jiuping,$money);
            }
            else{
                break;

            }
            echo'<br>当前剩余酒瓶：'.$jiuping;
            echo'<br>当前剩余瓶盖：'.$gaizi;
            echo'<br>当前剩余金钱：'.$money;
            echo'<br>当前已买到啤酒总数为：'.$sum.'<br>'; 
        }
    }
    function gaiziHuanJiu(&$gaizi,&$sum,&$jiuping){
        $gaizi-=3;
        $sum++;
        $jiuping++;
    }
    function jiupingHuanJiu(&$gaizi,&$sum,&$jiuping){
        $jiuping-=1;
        $sum++;
        $gaizi++;
    }
    function moneyMaiJiu(&$gaizi,&$sum,&$jiuping,&$money){
        $money-=2;
        $sum++;
        $gaizi++;
        $jiuping++;
    }
}

