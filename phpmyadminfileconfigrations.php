sudo nano /etc/nginx/sites-available/laravel.conf



configrations






server {
listen 443 ssl; # managed by Certbot
server_name raheeq.app www.raheeq.app;

ssl_certificate /etc/letsencrypt/live/raheeq.app/fullchain.pem; # managed by Certbot
ssl_certificate_key /etc/letsencrypt/live/raheeq.app/privkey.pem; # managed by Certbot
include /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot
ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by Certbot

root /var/www/html/raheeq/public;
index index.php index.html index.htm;

# Security headers
add_header X-Frame-Options "SAMEORIGIN" always;
add_header X-XSS-Protection "1; mode=block" always;
add_header X-Content-Type-Options "nosniff" always;
add_header Referrer-Policy "no-referrer-when-downgrade" always;
add_header Content-Security-Policy "default-src 'self' http: https: data: blob: 'unsafe-inline'" always;

# Laravel application
location / {
try_files $uri $uri/ /index.php?$query_string;
}

# phpMyAdmin
location /phpmyadmin {
alias /usr/share/phpmyadmin;
index index.php;

location ~ ^/phpmyadmin/(.+\.php)$ {
alias /usr/share/phpmyadmin/$1;
fastcgi_pass unix:/run/php/php7.4-fpm.sock;
fastcgi_index index.php;
fastcgi_param SCRIPT_FILENAME /usr/share/phpmyadmin/$1;
include fastcgi_params;
}

location ~* ^/phpmyadmin/(.+\.(jpg|jpeg|gif|css|png|js|ico|html|xml|txt))$ {
alias /usr/share/phpmyadmin/$1;
expires 1y;
add_header Cache-Control "public, immutable";
}
}

# PHP files for Laravel
location ~ \.php$ {
include snippets/fastcgi-php.conf;
fastcgi_pass unix:/run/php/php7.4-fpm.sock;
fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
fastcgi_param DOCUMENT_ROOT $realpath_root;
}

# Deny access to hidden files
location ~ /\. {
deny all;
}

# Deny access to Laravel sensitive files
location ~ /(\.env|\.git|storage|tests|database|resources/views) {
deny all;
}

# Optimize static files
location ~* \.(css|js|png|jpg|jpeg|gif|ico|svg)$ {
expires 1y;
add_header Cache-Control "public, immutable";
}
}

server {
listen 80;
server_name raheeq.app www.raheeq.app;

if ($host = www.raheeq.app) {
return 301 https://$host$request_uri;
} # managed by Certbot

if ($host = raheeq.app) {
return 301 https://$host$request_uri;
} # managed by Certbot

return 404; # managed by Certbot
}
