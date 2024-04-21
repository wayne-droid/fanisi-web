This is fanisi technical test web app done with laravel. Below is the nginx config file deploying thhe project.

server {
        listen 8050;
        listen [::]:8050 ipv6only=on;
        root /var/www/html/fanisi-web/public;
        index index.php index.html index.htm;
        server_name _;

        error_log  /var/log/nginx/fanisi_admin_error.log;
        access_log  /var/log/nginx/fanisi_admin_access.log; 
 
       location / {
                try_files $uri $uri/ /index.php?_url=$uri&$args;
        }
        location ~ \.php$ {
                #try_files $uri =404;
                fastcgi_split_path_info ^(.+\.php)(/.+)$;
                fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
                fastcgi_index index.php;
                fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
                include fastcgi_params;
        }
}
