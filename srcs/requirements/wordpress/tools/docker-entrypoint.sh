#!/bin/bash


if [ ! -d "/var/www/wordpress" ]; then
	cp -r /tmp/wordpress /var/www
	chown -Rv www-data: /var/www/
	sleep 10
	wp --allow-root core install --path=/var/www/wordpress --url=$DOMAIN_NAME --title=$WORDPRESS_SITE_TITLE --admin_user=$WORDPRESS_ADMIN_USER --admin_password=$WORDPRESS_ADMIN_PASS --admin_email=$WORDPRESS_ADMIN_EMAIL
	wp --allow-root --path=/var/www/wordpress user create $WORDPRESS_USER $WORDPRESS_EMAIL --role=$WORDPRESS_ROLE --user_pass=$WORDPRESS_PASS
	fi

php-fpm7.4 -F
