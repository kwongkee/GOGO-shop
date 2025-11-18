# GOGO Shop - 基于 Laravel 5.7.29 的 B2B2C 多用户商城系统

[![Laravel 5.7.29](https://img.shields.io/badge/Laravel-5.7.29-brightgreen.svg?style=flat-square)](https://laravel.com/docs/5.7.29)
[![PHP 7.2+](https://img.shields.io/badge/PHP-7.2%2B-blue.svg?style=flat-square)](https://php.net)
[![License](https://img.shields.io/badge/License-Custom-orange.svg?style=flat-square)](LICENSE)

> GOGO Shop 是多商户商城系统，完全基于 **Laravel 5.7.29 + PHP 7.2** 构建，轻量、高性能、易扩展。支持 PC 后台 + H5 + 微信公众号/小程序（uni-app 前端），适合个人学习、二次开发或小型商业项目。

如果本项目对你有帮助，欢迎 **Star** 和 **Watch**，第一时间获取更新！

## 技术栈

- **后端框架**：Laravel 5.7.29（优雅、现代的 PHP 框架）
- **PHP 版本**：7.2 ~ 7.4（严格遵循项目原始要求）
- **数据库**：MySQL 5.7+
- **缓存/队列**：Redis（推荐）
- **前端**：Blade 模板 + uni-app（H5/小程序）
- **权限系统**：RBAC 精细化权限控制
- **其他**：Intervention Image、Laravel Sanctum 等常用扩展

## 主要功能

- 多商户入驻与独立管理后台
- 商品 SKU、属性、规格完整管理
- 订单、支付（微信/支付宝）、物流追踪
- 分销、佣金、满减优惠、秒杀等营销功能
- 前台 H5 + 微信小程序（uni-app 开发）
- 完整的后台管理系统（管理员、运营、商家多角色）

## 环境要求（请严格遵守）

| 组件       | 最低版本要求          |
|------------|-----------------------|
| 操作系统   | CentOS 7 / Ubuntu 18.04+ |
| Web Server | Nginx 1.18+ 或 Apache |
| PHP        | 7.2 ~ 7.4（必须开启常见扩展） |
| MySQL      | 5.7+                  |
| Redis      | 5.0+（强烈推荐）      |
| Composer   | 2.x                   |

> 推荐使用宝塔面板一键部署（LNMP 环境）

## 快速安装（宝塔面板示例）

1. 创建站点 → 绑定域名 → 选择 PHP 7.2/7.4
2. 上传源码至站点根目录（确保根目录是 `public`）
3. 执行 Composer 安装（宝塔终端）：
   ```bash
   cd /www/wwwroot/your-domain.com
   composer install --no-dev -o

4. 导入数据库文件 install/laravelvip.sql
5. 修改 .env 文件（复制 .env.example）
APP_URL=https://your-domain.com
DB_HOST=127.0.0.1
DB_DATABASE=your_db
DB_USERNAME=your_user
DB_PASSWORD=your_pass
REDIS_HOST=127.0.0.1

6. 执行 Laravel 关键命令：
php artisan key:generate
php artisan storage:link
php artisan migrate --seed
php artisan config:cache
php artisan route:cache
php artisan view:cache

7. 设置目录权限：
chown -R www:www storage bootstrap/cache
chmod -R 755 storage bootstrap/cache

8.默认后台地址：
https://your-domain.com/admin
账号：admin   密码：admin123

项目结构（标准 Laravel 5.7.29）
├── app/                # 业务逻辑（Controllers、Models、Services）
├── bootstrap/
├── config/
├── database/           # migrations & seeders
├── public/             # 网站入口 index.php
├── resources/          # views、lang、assets
├── routes/             # web.php & api.php
├── storage/
├── vendor/
├── composer.json
└── artisan