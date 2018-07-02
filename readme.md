# 前言
该项目整合了laravel-china入门，进阶，api第三方登陆，电商教程的部分功能模块，参考了laravel-china前身开源的phphub样式，打造了一个可以互动的社区论坛模块以及支持付费阅读的的个人博客，本系统有以下几个角色。
## 1.角色
在里会出现以下角色：

- 游客——没有登录的用户

- 用户——github,邮箱微信注册用户，可以进行论坛发布讨论，可以购买需要付费的笔记进行阅读

- 管理员，站长——辅助站长做内容管理，笔记创建，广告位设置，论坛内容管理，用户管理，其他展示页的管理

## 2.信息结构
主要信息有：

- 笔记 note——章节属于一个笔记，一个笔记可以多个章节，可以设置是否付费和金额

- 章节 chapter——笔记章节，一个章节可以有多个文章

- 用户 User——所有内容都围绕用户来进行，采用github,邮箱微信自动登录方式验证

- 文章 article——本博客系统的核心数据，支持markdown，博客管理员可以选择笔记和章节发布文章

- 订单 Order——用户购买书本的凭证

- 话题 Topic，LaraBBS 论坛应用的最核心数据，有时我们称为帖子；

- 分类 Category，话题的分类，每一个话题必须对应一个分类，分类由管理员创建；

- 回复  Reply，针对某个话题的讨论，一个话题下可以有多个回复。

- 消息通知 Notice——向用户反馈信息

- 广告 Advertising——在首页进行展示

## 3.动作
角色和信息之间的互动称为动作，主要有以下几种：

- 用户注册、用户第三方登陆

- 用户创建话题

- 用户回复话题

- 管理员选择笔记，章节发布文章

- 用户创建订单支付

- 用户有权限访问文章

- 管理员设置资源推荐，广告位设置



# 关于项目

具体可移步 http://xhz-xed.org/
![文章](http://p7gqfr2rf.bkt.clouddn.com/article.png)
![支付](http://p982sr293.bkt.clouddn.com/bugshow.png)
![项目](http://p982sr293.bkt.clouddn.com/projectshow.png)
![订单](http://p982sr293.bkt.clouddn.com/ordershow.png)
![生活](http://p982sr293.bkt.clouddn.com/lifeshow.png)
![首页](http://p982sr293.bkt.clouddn.com/homeshow.png)
![笔记](http://p982sr293.bkt.clouddn.com/noteshow.png)
![文章](http://p7gqfr2rf.bkt.clouddn.com/articleshow.png)
![订单管理](http://p7gqfr2rf.bkt.clouddn.com/ordermanage.png)



### 还需开发功能

基于laravel5.5开发

- [x]全栈帖子搜索功能
- [ ]用户关注功能
- [ ]实现 @某个人 功能
- [x]增加第三方登陆
- [ ]七牛上传图片(现在后台广告资源图片需要自己手动输入七牛的链接，后续再更改吧)



## 怎么使用源码

### 线上环境部署，参考[部署指南](http://xhz-xed.org/articles/4)

注意：

- Master中不是该项目的源码，请切换到xhz-xed分支进行clone
- 源码仅做学习
- 开发环境参考[Laravel开发环境部署](https://laravel-china.org/docs/laravel-development-environment/5.5)
- git clone https://github.com/shisiying/Laravel-bbs


详细操作请按照以下

 运行环境要求

- Nginx 1.8+
- PHP 7.1+
- Mysql 5.7+
- Redis 3.0+
- Memcached 1.4+

### 开发环境部署/安装

本项目代码使用 PHP 框架 [Laravel 5.5](https://d.laravel-china.org/docs/5.5/) 开发，本地开发环境使用 [Laravel Homestead](https://d.laravel-china.org/docs/5.5/homestead)。

下文将在假定读者已经安装好了 Homestead 的情况下进行说明。如果您还未安装 Homestead，可以参照 [Homestead 安装与设置](https://laravel-china.org/docs/5.5/homestead#installation-and-setup) 进行安装配置。

#### 基础安装

##### 1. 克隆源代码

克隆 `larabbs` 源代码到本地：

    > git clone git@github.com:summerblue/larabbs.git

##### 2. 配置本地的 Homestead 环境

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

##### 3. 安装扩展包依赖

    composer install


##### 4. 生成配置文件

```
cp .env.example .env
```

你可以根据情况修改 `.env` 文件里的内容，如数据库连接、缓存、邮件设置等。


##### 5. 生成秘钥

```shell
php artisan key:generate
```

##### 6. 生成数据表及生成测试数据

在 Homestead 的网站根目录下运行以下命令

```shell
$ php artisan migrate --seed
```

初始的用户角色权限已使用数据迁移生成。


##### 7. 配置 hosts 文件

    echo "192.168.10.10   larabbs.test" | sudo tee -a /etc/hosts

#### 前端框架安装

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

#### 链接入口

* 首页地址：http://larabbs.test/
* 管理后台：http://larabbs.test/admin

管理员账号密码如下:

```
username: 751401459@qq.com
password: password
```

至此, 安装完成 ^_^。

#### 扩展包使用情况

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
|[laravel/socialite](https://socialiteproviders.github.io/)|第三方登陆库|微信，github登陆|
|[yansongda/pay](https://github.com/yansongda/laravel-pay)|第三方支付|支付宝微信支付|

#### 自定义 Artisan 命令

| 命令行名字 | 说明 | Cron | 代码调用 |
| --- | --- | --- | --- |
| `larabbs:calculate-active-user` |  生成活跃用户 | 一小时运行一次 | 无 |
| `larabbs:sync-user-actived-at` | 从 Redis 中同步最后登录时间到数据库中 | 每天早上 0 点准时 | 无 |

#### 队列清单

| 名称 | 说明 | 调用时机 |
| --- | --- | --- |
| TranslateSlug.php | 将话题标题翻译为 Slug | TopicObserver 事件 saved() |
| TopicReplied.php | 通知作者话题有新回复 | 话题被评论以后 |

#### License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
