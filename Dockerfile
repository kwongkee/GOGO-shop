# GOGO-shop Dockerfile
# Laravel 5.7 + PHP 7.4 + Nginx + MySQL Client

FROM php:7.4-fpm-alpine

# 安装系统依赖
RUN apk add --no-cache \
    nginx \
    supervisor \
    mysql-client \
    libzip-dev \
    oniguruma-dev \
    autoconf \
    gcc \
    g++ \
    make \
    linux-headers \
    zip \
    unzip \
    git \
    curl

# 安装PHP扩展
RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    zip \
    opcache \
    bcmath \
    pcntl \
    intl

# 安装Redis扩展
RUN pecl install redis-5.3.7 && docker-php-ext-enable redis

# 安装Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 配置Nginx
RUN echo 'server {' > /etc/nginx/http.d/default.conf \
    && echo '    listen 80;' >> /etc/nginx/http.d/default.conf \
    && echo '    server_name _;' >> /etc/nginx/http.d/default.conf \
    && echo '    root /var/www/html/public;' >> /etc/nginx/http.d/default.conf \
    && echo '    index index.php index.html;' >> /etc/nginx/http.d/default.conf \
    && echo '' >> /etc/nginx/http.d/default.conf \
    && echo '    location / {' >> /etc/nginx/http.d/default.conf \
    && echo '        try_files $uri $uri/ /index.php?$query_string;' >> /etc/nginx/http.d/default.conf \
    && echo '    }' >> /etc/nginx/http.d/default.conf \
    && echo '' >> /etc/nginx/http.d/default.conf \
    && echo '    location ~ \\.php$ {' >> /etc/nginx/http.d/default.conf \
    && echo '        fastcgi_pass 127.0.0.1:9000;' >> /etc/nginx/http.d/default.conf \
    && echo '        fastcgi_index index.php;' >> /etc/nginx/http.d/default.conf \
    && echo '        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;' >> /etc/nginx/http.d/default.conf \
    && echo '        include fastcgi_params;' >> /etc/nginx/http.d/default.conf \
    && echo '    }' >> /etc/nginx/http.d/default.conf \
    && echo '' >> /etc/nginx/http.d/default.conf \
    && echo '    location ~ /\\.ht {' >> /etc/nginx/http.d/default.conf \
    && echo '        deny all;' >> /etc/nginx/http.d/default.conf \
    && echo '    }' >> /etc/nginx/http.d/default.conf \
    && echo '}' >> /etc/nginx/http.d/default.conf

# 配置Supervisor
RUN echo '[supervisord]' > /etc/supervisor/conf.d/supervisord.conf \
    && echo 'nodaemon=true' >> /etc/supervisor/conf.d/supervisord.conf \
    && echo 'logfile=/var/log/supervisor/supervisord.log' >> /etc/supervisor/conf.d/supervisord.conf \
    && echo 'pidfile=/var/run/supervisord.pid' >> /etc/supervisor/conf.d/supervisord.conf \
    && echo '' >> /etc/supervisor/conf.d/supervisord.conf \
    && echo '[program:php-fpm]' >> /etc/supervisor/conf.d/supervisord.conf \
    && echo 'command=php-fpm -F' >> /etc/supervisor/conf.d/supervisord.conf \
    && echo 'autostart=true' >> /etc/supervisor/conf.d/supervisord.conf \
    && echo 'autorestart=true' >> /etc/supervisor/conf.d/supervisord.conf \
    && echo '' >> /etc/supervisor/conf.d/supervisord.conf \
    && echo '[program:nginx]' >> /etc/supervisor/conf.d/supervisord.conf \
    && echo 'command=nginx -g "daemon off;"' >> /etc/supervisor/conf.d/supervisord.conf \
    && echo 'autostart=true' >> /etc/supervisor/conf.d/supervisord.conf \
    && echo 'autorestart=true' >> /etc/supervisor/conf.d/supervisord.conf

# 创建工作目录
WORKDIR /var/www/html

# 复制应用代码（会在构建时替换）
COPY . /var/www/html

# 设置权限
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 暴露端口
EXPOSE 80

# 启动命令
CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
