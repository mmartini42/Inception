#!/bin/sh

#start.sh php-fpm and nginx
/usr/sbin/php-fpm7 -F & nginx -g "daemon off;"
