##### 日期：2016.03.30
##### 记录：KjunM
##### 主题：两天学习所得
# 内容：
## 一：Git初步
>### 1.1 认识GIT 
GIT是一个分布式版本管理系统。它与集中化不同的是，使用该系统的开发者既是单一也是全部。项目数据物理安全性大大提高。开发者版本交流自由且迅速。
>### 1.2 创建git本地库
>1. Windows 环境：GIT官网下载 GIT for windows ;Ubuntu系统，在终端输入sudo apt-get git 
>2. 安装好，windows打开GIt bash。Ubuntu-> 
>3. git config --global user.name:” 用户姓名”,git config --global user.email”用户邮箱” .
>4. mkdir  <文件夹> 或略过
>5. cd <文件夹>输入命令 git init 创建版本库（所有的版本记录都在里头，重要不可随意更改)  
>6. ls -al 查询当前文件夹所有文件，会看到 .git目录（自动隐藏在windows系统，可通过文件查看属性打开选项。Ubuntu系统 crtl+H可查看隐藏文件）
>### 1.3 创建文件，添加暂存区，更改记录
>1. vim /地址/文件名  创建文件并在打开。
>2. Vim文件编辑程序（i进入编辑模式，Esc退出编辑模式。/光标跳到文件末尾，输入:wq保存退出 :q!不保存退出）。
>3. /<字符> 在文件中查询该字符匹配。
>4. git add <文件>  把文件上传到暂存区;  git add .  上传该目录所有文件。
>5. git commit -m “编辑更改记录”。 提交到分之
>6. git status 查询该目录下文件是否有变化。
>7. git log 显示所有更改历史记录。git reflog 查询版本号及显示更改记录 
>8. rm <文件名>  删除文件 
>9. git rm <文件名> 如果被删除的文件已上传到暂存区可用该命令删除暂存区记录
>10. git reset --hard HEAd^  将文件返回到上一版本 。
>11. git reset --hard <版本号> 将文件返回到某一版本。
>12. git checkout <文件名> 撤销文件上一次操作或还原该文件（文件在目录中被删除，版本库暂存区还有记录）。
>13. cat <文件名> 阅读该文件 。
>14. git branch  查看当前分之
>15. git checkout -b <分之名>  创建分之并切换到该分支
>16. Git checkout <分之名>  切换分之
>17. Git merge <分之名>  合并当前分之
>18. Git branch -d <分之名> 删除分之
>19. Git rebase <分之1> 分之一盒当期分之进行有机结合（当前分之从分之1上获取它所没有的进度）
>20. Git clone <地址> 从远程库上克隆库到本地
>21. Git fench <地址> 和Git pull <地址> 作用是从远程库获取最新版本到本地。Fench和pull的差别是fench不自动进行合并。需与git diff 和git merge配合使用
>### 1.4连接远程库，推送文件
>进入github或gitlab。点击new project创建库。
>>1. 在本地库，进入终端。输入命令：ssh-keygen  在主目录创建 .ssh文件夹。
>>2. 打开 .ssh文件夹，打开 id_rsa.pub 复制ssh公钥。粘贴到github或gitlab的add ssh页面。
>>3. 终端输入 git remote add origin库地址  连接远程库
>>4. 连接成功 输入 git push -u origin 分之名 将该分之下的文件推送到远程库

## 二．搭建LNMP
> ###2.1 Ubantu系统搭建过程记录
>> LNMP是Linux+Nginx+MySQL+PHP的简称，是一套完整的PHP网站服务器架构环境。
所用Linux发行版为Ubuntu Gnome 15.04，所有需要的软件均使用Ubuntu自带apt源下载安装。
LNMP搭建参考资料：http://www.linuxdiyf.com/linux/13025.html
Linux修改localhost：http://451568057.iteye.com/blog/1807610
首先，更新Ubuntu源：
sudo apt-get update
然后，安装Nginx：
sudo apt-get install nginx

>> 等待nginx安装完成后，打开浏览器，在地址栏输入localhost，检测nginx是否开启；若开启成功，则会显示欢迎使用Nginx的界面；若没有，则在终端下输入以下命令即可打开nginx：
sudo /etc/init.d/nginx start

>> 然后安装mysql：
sudo apt-get install mysql-server-5.6 mysql-workbench mysql-client-5.6
安装过程中需要设置root用户的密码，选择自己容易记住的密码即可。

>> 接下来安装php：
sudo apt-get install php5 php5-fpm php5-mysql php-apc
至此所有基本组件已安装完毕，可以根据需要继续安装其它可选组件等。

>>#### 配置php:
>>>##### 首先：
>>>>1. sudo vim /etc/nginx/sites-available/default
>>>>2. 在打开的文档中找到root，将其改为：root/home/tevenfeng/coding/php/tjurobocup
此处路径为你的php页面文件的根目录路径，比如我这里就把所有php页面放在tjurobocup文件夹下。​
同时在index一行中添加 index.php。​
>>>>3. 然后找到以下代码块并按照下面的修改：
>>>>>
	\# pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
	\#
	location ~ \.php$ {
	\#include snippets/fastcgi-php.conf;
	\## With php5-cgi alone:
	\#fastcgi_pass 127.0.0.1:9000;
	\## With php5-fpm:
	fastcgi_pass unix:/var/run/php5-fpm.sock;
	include fastcgi_params;
	}
 然后保存。

>>>##### 接下来修改​fastcgi_params文件：
>>>>
sudo vim /etc/nginx/fastcgi_params
在该文件的末尾添加如下行：
fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
保存退出。

>>>##### 然后修改php.ini文件：
>>>>
sudo vim /etc/php5/fpm/php.ini
找到:;cgi.fix_pathinfo()=1   （大约在700行附近）
将其修改为cgi.fix_pathinfo()=0​
找到doc_root =   （大约在720行左右）
将其修改为doc_root = /home/tevenfeng/coding/php/tjurobocup  （注意，这里的路径必须与前面修改default文件中root的路径一致）。​
保存并退出。

>>>##### 然后重启nginx和php5-fpm：
sudo /etc/init.d/nginx restart
sudo /etc/init.d/php5-fpm restart
然后在/home/tevenfeng/coding/php/tjurobocup文件夹下新建一个index.php文件，并输入相应的测试内容，打开浏览器输入localhost测试。
## 三．http协议、url
>### 3.1 http协议
在B-S（浏览器-服务器）系统架构中。http超文本传输协议的作用就是对二者之间的数据传输作一个规定。类似于现实生活中的合同，规定二者的权利和义务。使用http协议能大大提升网页浏览速度。
>### 3.2 url
Url是统一资源定位符。他的作用类似于现实中每个家庭都有的门牌号。Url指定了你在网络中的地址。


