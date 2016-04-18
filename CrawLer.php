<?php
/*
 * Created by Neatbeans
 * User:Ryan
 * Date:2016.04.18
 * Time:14:57
 */
class Crawler{
    public $index_url='http://www.hengtaiyf.com/view/list';
    public $page_preg='/var pages  = (.+)/';
    public $goods_preg='/class="no-link" href="http:\/\/www\.hengtaiyf\.com\/detail\?itemid=(\d+)"/';
    public $title_preg='/title="(.*?)" target="_blank"/';
    public $price_preg='/<p class="p-price">(.*?)<\/p>/';
    
    public function craw(){
        $page_arr=array();
        $title_arr=array();
        $price_arr=array();
       // $index_contents = file_get_contents($this->index_url); 
        $index_contents = $this->getContents($this->index_url);
        preg_match_all($this->page_preg,$index_contents,$page_arr);      
        for($i=1;$i<=$page_arr[1][0];$i++){
            $page_url = $this->index_url.'&pageno='.$i;
            //$page_contents=file_get_contents($page_url);
            $page_contents = $this->getContents($page_url);
            preg_match_all($this->price_preg, $page_contents, $price_arr);
            preg_match_all($this->title_preg, $page_contents, $title_arr);
            if(empty($title_arr)) continue;
            for($k=0;$k<=count($title_arr[1])-1;$k++){
                $title=$title_arr[1][$k];
                $price=$price_arr[1][$k];
                $contents=$title."\t".$price;
                $this->write_log($contents);
                echo $title_arr[1][$k],$price_arr[1][$k] . PHP_EOL;
            }
        }
        echo '爬完了！！';
    }
    public function write_log($string){
        $file = './htyf_last.txt';
        file_put_contents($file, $string . PHP_EOL, FILE_APPEND);
    }  
    public function getContents($url){
        $timeout=5;
        $curlhandle = curl_init();
        curl_setopt($curlhandle,CURLOPT_URL,$url);
        curl_setopt($curlhandle,CURLOPT_HEADER,0);
        curl_setopt($curlhandle,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curlhandle,CURLOPT_CONNECTTIMEOUT,$timeout);
        $result = curl_exec($curlhandle);
        curl_close($curlhandle);
        return $result;
    }
}
$crawle=new crawler();
$crawle->craw();