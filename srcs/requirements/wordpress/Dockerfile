FROM debian:buster

MAINTAINER mathmart <mathmart@student.42lyon.fr>

EXPOSE 9000

# Install php
RUN apt-get update && \
	apt-get -y install lsb-release apt-transport-https ca-certificates wget curl && \
	wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg && \
	echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list && \
	apt-get update && \
	apt-get install -y php7.4-fpm php7.4-mysql

# Install wp-cli
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && \
	chmod +x wp-cli.phar && \
	mv wp-cli.phar /usr/local/bin/wp

# Download wordpress
RUN cd /tmp/ \
	&& wget https://fr.wordpress.org/wordpress-5.7-fr_FR.tar.gz \
	&& tar xvf wordpress-5.7-fr_FR.tar.gz

COPY conf/wp-config.php /tmp/wordpress/wp-config.php
COPY tools/docker-entrypoint.sh /docker-entrypoint.sh
COPY conf/object-cache.php /

# Configure wordpress
RUN sed -i "s/\/run\/php\/php7.4-fpm.sock/0.0.0.0:9000/g" /etc/php/7.4/fpm/pool.d/www.conf && \
	sed -i 's/;clear_env = no/clear_env = no/g' /etc/php/7.4/fpm/pool.d/www.conf && \
	sed -i 's/variables_order = "GPCS"/variables_order = "EGPCS"/g' /etc/php/7.4/fpm/php.ini && \
    mkdir -p /run/php && \
	chmod +x docker-entrypoint.sh

ENTRYPOINT ["./docker-entrypoint.sh"]

