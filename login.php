<!DOCTYPE html>
<html>
<head>
    <meta  charset="UTF-8"/>
	<title>OPS 自动化运行平台</title>
</head>
<body  style="background-color:black">
	<div id="container" style="width:300px;height:300px;text-align:center;margin: 20% 50% 50% 40%">
		<div id="header" style="font-size:32px;magin-top:10px;color: white;"><span style="color:green;">OPS</span>自动化运维平台</div>
		<div id="gongsiname" style="color:blue;font-size:16px;margin-top: 10px;height:30px">©上海银路投资管理有限公司</div>
		<div id="dengluchuangkou" style="border-color:gray;;border-style: solid;border-width:5px;height:150px;background-color:white;margin-top:10px;">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <div id="shurutishi" style="color:blue;font-size:18px;text-decoration: underline;"><img src="coffee.jpg"  width="15" height="20" />Please Enter Your Information</div>
                    用户：<input type="text" id="username" style="margin-top: 10px;width:150px;" name="uname"  /><br>
                    密码：<input type="password" id="userpass" style="margin-top: 5px;width:150px" name=" upass"  /><br>
                    <div id="check" style="color: black;margin-left:30px;float: left;margin-top: 15px;"><input type="checkbox" name =" remenber" />remenber me</div>
                    <input id="login" style="color:blue;margin-right: 30px;float: right;margin-top: 15px;" type="submit" value="login" />
                    </form>
                </div>
	</div>
                        <!--PHP结果输出-->
        <?php
        
            if(!empty($_POST)){
                if((isset($_POST['uname']) && $_POST['uname']=='weijin') && (isset($_POST['upass']) && $_POST['upass']=='1234')){
                    echo "<script>alert('登陆成功')</script>";
                }else{
                    echo "<script>alert('登录失败，请重新输入')</script>";
                }
            }
            
            
        ?>
</body>
</html>
