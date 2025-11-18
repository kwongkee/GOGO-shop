#!/bin/bash
cd /www/wwwroot/shopping.gogo198.cn

php artisan route:clear
php artisan config:clear
php artisan view:clear      # 重点加上这行
php artisan event:clear
php artisan cache:clear

echo "所有缓存已安全清除（已避开 view:cache 坑）"