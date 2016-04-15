<?php

$index_url = 'http://www.hengtaiyf.com';//定义变量$index_url等于入口url
$index_contents = file_get_contents($index_url);//将入口url的内容存入字符串$index_contents
$class_preg = '/view\/list\?cid=(\d+)/';//正则匹配分类url
$page_preg = '/<span class="ex-page-status">\d+\/(\d+)\<\/span>/';//正则匹配分页url
$goods_preg = '/detail\?itemid=(\d+)/';//正则匹配商品页url
$title_preg = '/<h3 id="item-title">(.*?)<\/h3>/';//正则匹配标题标签
$price_preg = '/<b>￥(.*?)<\/b>/';//正则匹配价格标签

preg_match_all($class_preg,$index_contents,$class_arr);//在入口字符串中搜索全部分类url并存入数组


if(empty($class_arr)){//判断数组是否为空
	echo "没有内容!";
}else{
	foreach ($class_arr[1] as $value) {//遍历分类数组
		if(strlen($value) == 4){//判断分类数组url中cid值的长度是否等于四位整数
			$class[] = 'http://www.hengtaiyf.com/view/list?cid='.$value;//将满足条件的url存入数组$class
		}   		
	}
}

foreach ($class as  $key => $value) {//遍历数组$class
    $class_url = 'http://www.hengtaiyf.com/view/list?cid='. $value;//得到分类url
    $class_contents = file_get_contents($class_url);//将每一个分类url页面的内容存入字符串
    preg_match_all($page_preg,$class_contents,$page_arr);//匹配分页正则并存入数组
    if($page_arr[1][0] == 1){//判断页码是否为1
        echo "这个分类没有分页";
        $page_url =& $class_url;//得到页码url
        $page_contents = file_get_contents($page_url);//获取内容并存入数组
        preg_match_all($goods_preg,$page_contents,$goods_arr);//匹配商品页正则
        $goods_arr = array_unique($goods_arr[0]);//去除商品重名
        foreach($goods_arr as $val){//遍历数组
        $goods_contents = file_get_contents('http://www.hengtaiyf.com/'. $val);//获得内容并存入数组
        preg_match_all($title_preg,$goods_contents,$title_arr);//匹配标题
        preg_match_all($price_preg,$goods_contents,$price_arr);//匹配价格 
        if(empty($title_arr)) continue;//判断标题数组是否为空
        $title = $title_arr[1][0];//定义变量$title并赋值
        if(empty($price_arr)){//判断价格数组是否为空
                $price  = '0.00';//定义变量$price并赋值
        }else{
                $price = $price_arr[1][0];
        }
        $contents = $title . "\t" .  $price;//把标题和价格存入字符串
        write_log($contents);//执行方法
        echo $title_arr[1][0] . "爬完了！" . PHP_EOL;//输出信息
        }                             
    }else{
        for($n=1;$n<= $page_arr[1][0]; $n++){
            $page_url = $class_url . '&pageno=' . $n ;
            $page_contents = file_get_contents($page_url);
            preg_match_all($goods_preg,$page_contents,$goods_arr);
            $goods_arr = array_unique($goods_arr[0]);
            foreach($goods_arr as $val){
            $goods_contents = file_get_contents('http://www.hengtaiyf.com/'. $val);
            preg_match_all($title_preg,$goods_contents,$title_arr);
            preg_match_all($price_preg,$goods_contents,$price_arr);		 
            if(empty($title_arr)) continue;
            $title = $title_arr[1][0];
            if(empty($price_arr)){
                    $price  = '0.00';
            }else{
                    $price = $price_arr[1][0];
            }
            $contents = $title . "\t" .  $price;
            write_log($contents);
            echo $title_arr[1][0] . "爬完了！" . PHP_EOL;
            }
                       
        }
    }
}


function write_log($string){
    $file = './htyf.txt';
    file_put_contents($file, $string . PHP_EOL, FILE_APPEND);
}
//代码整合成方法出现变量未初始化以及返回变量的问题
//解决办法：继续了解变量知识和方法的运用
/*function getgoods_message(){
        $page_contents = file_get_contents($page_url);
        preg_match_all($goods_preg,$page_contents,$goods_arr);
        $goods_arr = array_unique($goods_arr[0]);
        foreach($goods_arr as $val){
        $goods_contents = file_get_contents('http://www.hengtaiyf.com/'. $val);
        preg_match_all($title_preg,$goods_contents,$title_arr);
        preg_match_all($price_preg,$goods_contents,$price_arr);		 
        if(empty($title_arr)) continue;
        $title = $title_arr[1][0];
        if(empty($price_arr)){
                $price  = '0.00';
        }else{
                $price = $price_arr[1][0];
        }
        $contents = $title . "\t" .  $price;
        write_log($contents);
        echo $title_arr[1][0] . "爬完了！" . PHP_EOL;
	}
}*/
