# 说明
LiRecord 2.0是一款基于Laravel 5.3进行开发的留言板系统。
本项目受[GPL V3](http://www.gnu.org/licenses/gpl-3.0.html)协议保护。

# 演示
[http://lirecord.licoy.cn](http://lirecord.licoy.cn)

#安装前提
1. PHP 5.3.2+
1. 安装git
    安装教程：[http://www.cnblogs.com/zhcncn/p/4030078.html](http://www.cnblogs.com/zhcncn/p/4030078.html)
2. 安装composer
    安装教程：[http://docs.phpcomposer.com/00-intro.html](http://docs.phpcomposer.com/00-intro.html)

#安装步骤
1. clone lirecord 到你的服务器网站目录（clone前请先安装git）

```
cd home/wwwroot/xxx/web #进入到你的web目录路径
git clone https://git.oschina.net/licoy/LiRecord.git
```

2.通过composer更新项目
```
composer install
```

3.cpoy  **.env.example**  为  **.env** 

4.创建一个数据库，在.env配置文件以下选项填入对应的值
```
DB_HOST=localhost #数据库地址
DB_PORT=3306 #端口
DB_DATABASE= #数据库名
DB_PREFIX= #数据表前缀
DB_USERNAME=root #数据库用户名
DB_PASSWORD=root #数据库密码
```

5.修改storage的目录权限
```
sudo chmod -R 777 storage/
```

6.数据迁移
```
php artisan migrate
```

7.填充数据
```
php artisan db:seed
```

8.重写模块
> apache:开启mod_rewrite模块

> nginx:参考[https://www.licoy.cn/2716.html](https://www.licoy.cn/2716.html)


9.将apache或nginx的root目录指定为网站目录的public目录


10.安装完成，访问你绑定的域名即可。（默认管理邮箱：admin@admin.com 密码：123456）

#许可证

GPL V3
