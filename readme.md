## 简介

* 基于Laravel5.5和AdminLTE的后台开发框架
* 借鉴Laravel-admin 和 someline-starter 良多。
* 实现基本的前端打包环境(基于laravel-mix)
* 使用了l5-repository
* 实现了通过后台脚手架快速创建模块，一键生成模型所需所有的符合repository模式标准的代码骨架
* 实现了基于oauth2的接口开发骨架
* 前后台用户分离
* 多语言支持
* 需要一定的laravel、前端构建基础，需要php技能中级以上。

## 功能

* 登录验证(极验证)
* 后台用户管理
* 角色管理
* 权限管理
* 后台菜单
* 操作记录
* 工具=》日志查看器
* 工具=》路由查看器
* 工具=》Artisan终端
* 工具=》数据库终端
* 工具=》脚手架（可以一件添加模块）
* 工具=》计划任务
* 前台用户管理

## 界面预览

## 目录权限
~~~
chmod -R 755 storage

chmod -R 755 bootstrap/cache

sudo chown www-data:www-data storage/oauth-*.key

sudo chmod 600 storage/oauth-*.key
~~~
## laravel依赖
~~~
composer install

composer update
~~~
## 前端打包环境
~~~
npm install -g npm bower yarn gulp


yarn install


sudo bower install

// 运行所有 Mix 任务... ( 开发环境 )
yarn run dev
// 运行所有 Mix 任务并缩小输出.. ( 生产环境 )
yarn run production

~~~



How to use （ Win10 + VMware Ubuntu 16.04 ） 2018-4-3
------

### 1. Clone 代码
```
git clone https://gitee.com/yeelight/cloud2.git
```

### 2. 安装 composer 包
```
composer install
composer update /* 把控不住不要执行，若 update 之后，请务必测试新的版本是否影响现有业务，否则不要提交 composer.lock */
```

### 3. 生成配置文件
```
cp .env.example .env
```

### 4. 全局安装这些工具 ( 已安装请跳过 )
```
npm install -g npm bower yarn gulp
```

### 5. bower install
root 用户根据提示添加 --allow-root 参数
```
bower --allow-root install
```
参考资料：
https://segmentfault.com/a/1190000002971135
https://bower.io/

### 6. Yarn 设置淘宝源

```
yarn config set registry http://registry.npm.taobao.org/
yarn install
/* 如果你正在 Windows 系统上进行开发，或者在 Windows 主机系统上运行虚拟机，请执行这条命令。 */
yarn install --no-bin-links
```


如果报错：Laravel Mix "sh: 1: cross-env: not found error"
```
yarn install --global cross-env
```

如果报错：Error: spawn EACCES
```
chmod -R 777 node_modules/
```

如果报错目录不存在请按照报错信息创建，以下目录是我安装过程中碰到的：
```
创建 img 目录
resources/assets/img
创建 google-fonts 目录
resources/assets/vendors/google-fonts
```

### 7. 运行 Mix 任务

```
// 运行所有 Mix 任务... ( 开发环境 )
yarn run dev
// 运行所有 Mix 任务并缩小输出.. ( 生产环境 )
yarn run production
```

## Database & Seeding
~~~
php artisan migrate

php artisan db:seed
~~~
### Install Laravel Passport with encryption keys to generate secure access tokens.
~~~
php artisan passport:install
~~~
## 后台模板

https://github.com/almasaeed2010/AdminLTE/

其他组件手册请自行搜索

## l5-repository

https://github.com/daofirst/l5-repository

## 通过后台脚手架快速创建模块

### 1. 快捷创建模型

后台=》

工具=》

脚手架=》

填写模型信息=》

php artisan migrate（如果没有点选 Run migrate）

### 2.增加模型路由

在 route/backend/web.php 增加路由：

$router->resource('your/route', 'YourModelsController');

在 route/api.php 增加路由：

$api->resource('your_route', 'YourModelsController');

### 3.增加后台菜单

自行在后台添加模型对于的菜单