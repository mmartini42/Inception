FROM debian:buster

MAINTAINER mathmart <mathmart@student.42lyon.fr>

#Installation of required packages
RUN apt-get update -y && apt-get upgrade -y;
RUN apt -y install lsb-release apt-transport-https ca-certificates wget git curl php-common
RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list
RUN apt update -y
RUN apt-get install -y php7.4 php7.4-fpm php7.4-json
RUN apt-get install -y php7.4-xml php7.4-iconv php7.4-ctype php7.4-mysqli php7.4-curl nginx openssl

#Creation of certificates
RUN openssl req -newkey rsa:4096 -x509 -sha256 -days 365 -nodes -out \
      /etc/ssl/mathmart.42Lyon.fr.pem -keyout /etc/ssl/mathmart.42Lyon.fr.key \
       -subj "/C=FR/ST=Lyon/L=Lyon/O=42 School/OU=mathmart/CN=mathmart.42.fr"

#Creating and Adding Configuration Files
RUN mkdir -p /var/www/adminer
COPY conf/adminer.php /var/www/adminer/index.php
COPY conf/www.conf /etc/php7/php-fpm.d/

#Add the script to launch the deamons
COPY tool/start.sh /start.sh
ENTRYPOINT ["sh", "start.sh"]
