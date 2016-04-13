<?php
header('Content-Type:text/html;charset=utf-8');
/*
 * created by NetBeans
 * User:Ryan
 * date:2016.04.13
 * time:11:56
 */
$arr = array(1,2,3,4,5,6,9,23,56,78);
//冒泡排序
function mysort($arr){
    $length=count($arr);
    for($i=0;$i<$length-1;$i++){
	for($j=0;$j<$length-$i-1;$j++){
            if($arr[$j]>$arr[$j+1]){
                $t=$arr[$j+1];
                $arr[$j+1]=$arr[$j];
		$arr[$j]=$t;
            }
	}
    }
    foreach($arr as $value){//输出数组
        echo "$value ";
}
}
mysort($arr);
/*foreach($arr as $value){//输出数组
        echo "$value ";
}*/
function mysum($arr){
    $length = count($arr);
    $sum = 0 ;
    /*for($i=0;$i<$length;$i++){
        global $sum;
        $sum = $sum + $arr[i];
    }*/
    foreach($arr as $value){
       global $sum;
       $sum += $value;
    }
    echo '<br>数组总数是：'.$sum;
}
mysum($arr);
//获取路径并创建文件
function createFile(){
    echo '<br>'.__FILE__;
    $riqi = date('Ymd');
    $myfile = fopen("$riqi.csv","w");
}
createFile();
?>