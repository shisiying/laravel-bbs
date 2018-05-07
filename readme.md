<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## 关于Laravel-bbs，项目概述

laravel是我学习的laravel的个人项目，该项目更是让我感受到了laravel作为web开发的优雅性以及便利性，该项目功能主要包含了以下功能:

- 用户认证 —— 注册、登录、退出；
- 个人中心 —— 用户个人中心，编辑资料；
- 用户授权 —— 作者才能删除自己的内容；
- 上传图片 —— 修改头像和编辑话题时候上传图片；
- 表单验证 —— 使用表单验证类；
- 模型监控 —— 自动 Slug 翻译；
- 使用第三方 API —— 请求百度翻译 API ；
- 队列任务 —— 将百度翻译 API 请求和发送邮件放到队列中，以提高响应；
- 计划任务 —— 『活跃用户』计算，一小时计算一次；
- 多角色权限管理 —— 允许站长，管理员权限的存在；
- 后台管理 —— 后台数据模型管理；
- 邮件通知 —— 发送新回复邮件通知；
- 站内通知 —— 话题有新回复；
- 自定义 Artisan 命令行 —— 自定义活跃用户计算命令；
- 自定义 Trait —— 活跃用户的业务逻辑实现；
- 自定义中间件 —— 记录用户的最后登录时间；
- 模型修改器；
- XSS 安全防御；

### 还需开发功能

- [ ]全栈帖子搜索功能
- [ ]用户关注功能
- [ ]实现 @某个人 功能
- [ ]增加第三方登陆


## 项目个人总结

该项目主要涉及了以下知识点

- 用户认证 —— 注册、登录、退出

使用laravel自带auth组件,使用php artisan make:auth生成,具体路由如下所示:
>// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

- 添加验证码

安装第三方扩展包[mews/captcha](https://github.com/mewebstudio/captcha) 作为基础来实现 Laravel 中的验证码功能

由于 mews/captcha 是专门为 Laravel 量身定制的扩展包，因此后端显得很简单，可参照文档来操作

可参照源码[注册页](https://github.com/shisiying/laravel-bbs/blob/master/resources/views/auth/register.blade.php)的验证码显示

[后端验证](https://github.com/shisiying/laravel-bbs/blob/master/app/Http/Controllers/Auth/RegisterController.php)validator方法

- 上传图片 —— 修改头像和编辑话题时候上传图片

[上传图片以及裁剪图片工具类](https://github.com/shisiying/laravel-bbs/blob/master/app/Handlers/ImageUploadHandler.php)

裁剪图片使用Intervention/image 

具体使用工具类可参照[UsersController](https://github.com/shisiying/laravel-bbs/blob/master/app/Http/Controllers/UsersController.php)的update方法


- 用户授权 —— 作者才能删除自己的内容

[laravel授权策略](https://laravel-china.org/docs/laravel/5.5/authorization#policies)

[授权策略的编写](https://github.com/shisiying/laravel-bbs/blob/master/app/Policies/UserPolicy.php)

[授权策略在页面使用]()

[授权策略在控制器的使用](https://github.com/shisiying/laravel-bbs/blob/master/app/Http/Controllers/UsersController.php)中的$this->authorize('update', $user);

- 代码生成器的使用，更方便的crud
为此规范量身定制的代码生成器 —— [Laravel 5.x Scaffold Generator](https://github.com/summerblue/generator) 。代码生成器能让你通过执行一条 Artisan 命令，完成注册路由、新建模型、新建表单验证类、新建资源控制器以及所需视图文件等任务，不仅约束了项目开发的风格，还能极大地提高我们的开发效率

在使用代码生成器之前，我们需要先整理好 topics 表的字段名称和字段类型,生成命令具体示例:

php artisan make:scaffold Topic --schema="title:string:index,body:text,user_id:integer:unsigned:index,category_id:integer:unsigned:index,reply_count:integer:unsigned:default(0),view_count:integer:unsigned:default(0),last_reply_user_id:integer:unsigned:default(0),order:integer:unsigned:default(0),excerpt:text,slug:string:nullable"

- 假数据生成以及填充
laravel还有一个让人惊艳的方法就是可以生成假数据，例如用户数据的填充,随便活跃一个论坛也不过如此吧，hh

[用户的数据工厂](https://github.com/shisiying/laravel-bbs/blob/master/database/factories/UserFactory.php)
[用户的数据填充](https://github.com/shisiying/laravel-bbs/blob/master/database/seeds/UsersTableSeeder.php)
[注册数据填充](https://github.com/shisiying/laravel-bbs/blob/master/database/seeds/DatabaseSeeder.php)
使用命令php artisan db:seed生成数据

- XSS安全问题解决
有两种方法可以避免 XSS 攻击：

第一种，对用户提交的数据进行过滤；运用『白名单机制』对 HTML 文本信息进行 XSS 过滤,[HTMLPurifier for Laravel](https://github.com/mewebstudio/Purifier) 是对 HTMLPurifier 针对 Laravel 框架的一个封装。本章节中，我们将使用此扩展包来对用户内容进行过滤。使用方法$topic->body = clean($topic->body, 'user_topic_body');
第二种，Web 网页显示时对数据进行特殊处理，一般使用 htmlspecialchars() 输出，Laravel 的 Blade 语法 {{ }} 会自动调用 PHP htmlspecialchars 函数来避免 XSS 攻击

待总结...


## 怎么使用源码

- 开发环境参考[Laravel开发环境部署](https://laravel-china.org/docs/laravel-development-environment/5.5)
- git clone https://github.com/shisiying/Laravel-bbs

详细操作请按照以下

## 运行环境要求

- Nginx 1.8+
- PHP 7.1+
- Mysql 5.7+
- Redis 3.0+
- Memcached 1.4+

## 开发环境部署/安装

本项目代码使用 PHP 框架 [Laravel 5.5](https://d.laravel-china.org/docs/5.5/) 开发，本地开发环境使用 [Laravel Homestead](https://d.laravel-china.org/docs/5.5/homestead)。

下文将在假定读者已经安装好了 Homestead 的情况下进行说明。如果您还未安装 Homestead，可以参照 [Homestead 安装与设置](https://laravel-china.org/docs/5.5/homestead#installation-and-setup) 进行安装配置。

### 基础安装

#### 1. 克隆源代码

克隆 `larabbs` 源代码到本地：

    > git clone git@github.com:summerblue/larabbs.git

#### 2. 配置本地的 Homestead 环境

1). 运行以下命令编辑 Homestead.yaml 文件：

```shell
homestead edit
```

2). 加入对应修改，如下所示：

```
folders:
    - map: ~/my-path/larabbs/ # 你本地的项目目录地址
      to: /home/vagrant/larabbs

sites:
    - map: larabbs.test
      to: /home/vagrant/larabbs/public

databases:
    - larabbs
```

3). 应用修改

修改完成后保存，然后执行以下命令应用配置信息修改：

```shell
homestead provision
```

随后请运行 `homestead reload` 进行重启。

#### 3. 安装扩展包依赖

    composer install

#### 4. 生成配置文件

```
cp .env.example .env
```

你可以根据情况修改 `.env` 文件里的内容，如数据库连接、缓存、邮件设置等。


#### 5. 生成秘钥

```shell
php artisan key:generate
```

#### 6. 生成数据表及生成测试数据

在 Homestead 的网站根目录下运行以下命令

```shell
$ php artisan migrate --seed
```

初始的用户角色权限已使用数据迁移生成。


#### 7. 配置 hosts 文件

    echo "192.168.10.10   phphub.app" | sudo tee -a /etc/hosts

### 前端框架安装

1). 安装 node.js

直接去官网 [https://nodejs.org/en/](https://nodejs.org/en/) 下载安装最新版本。

2). 安装 Yarn

请按照最新版本的 Yarn —— http://yarnpkg.cn/zh-Hans/docs/install

3). 安装 Laravel Mix

```shell
yarn install
```

4). 编译前端内容

```shell
// 运行所有 Mix 任务...
npm run dev

// 运行所有 Mix 任务并缩小输出..
npm run production
```

5). 监控修改并自动编译

```shell
npm run watch

// 在某些环境中，当文件更改时，Webpack 不会更新。如果系统出现这种情况，请考虑使用 watch-poll 命令：
npm run watch-poll
```

### 链接入口

* 首页地址：http://larabbs.test/
* 管理后台：http://larabbs.test/admin

管理员账号密码如下:

```
username: 751401459@
password: password
```

至此, 安装完成 ^_^。

## 扩展包使用情况

| 扩展包 | 一句话描述 | 本项目应用场景 |
| --- | --- | --- |
| [Intervention/image](https://github.com/Intervention/image) | 图片处理功能库 | 用于图片裁切 |
| [guzzlehttp/guzzle](https://github.com/guzzle/guzzle) | HTTP 请求套件 | 请求百度翻译 API  |
| [predis/predis](https://github.com/nrk/predis.git) | Redis 官方首推的 PHP 客户端开发包 | 缓存驱动 Redis 基础扩展包 |
| [barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar) | 页面调试工具栏 (对 phpdebugbar 的封装) | 开发环境中的 DEBUG |
| [spatie/laravel-permission](https://github.com/spatie/laravel-permission) | 角色权限管理 | 角色和权限控制 |
| [mewebstudio/Purifier](https://github.com/mewebstudio/Purifier) | 用户提交的 Html 白名单过滤 | 帖子内容的 Html 安全过滤，防止 XSS 攻击 |
| [hieu-le/active](https://github.com/letrunghieu/active) | 选中状态 | 顶部导航栏选中状态 |
| [summerblue/administrator](https://github.com/summerblue/administrator) | 管理后台 | 模型管理后台、配置信息管理后台 |
| [viacreative/sudo-su](https://github.com/viacreative/sudo-su) | 用户切换 | 开发环境中快速切换登录账号 |
| [laravel/horizon](https://github.com/laravel/horizon) | 队列监控 | 队列监控命令与页面控制台 /horizon |


## 自定义 Artisan 命令

| 命令行名字 | 说明 | Cron | 代码调用 |
| --- | --- | --- | --- |
| `larabbs:calculate-active-user` |  生成活跃用户 | 一小时运行一次 | 无 |
| `larabbs:sync-user-actived-at` | 从 Redis 中同步最后登录时间到数据库中 | 每天早上 0 点准时 | 无 |

## 队列清单

| 名称 | 说明 | 调用时机 |
| --- | --- | --- |
| TranslateSlug.php | 将话题标题翻译为 Slug | TopicObserver 事件 saved() |
| TopicReplied.php | 通知作者话题有新回复 | 话题被评论以后 |

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
