FROM debian:buster

MAINTAINER mathmart <mathmart@student.42lyon.fr>

#Installation of required packages
RUN apt-get update -y && apt-get upgrade -y;
RUN apt-get install -y php7 php7-fpm php7-session php7-json;
RUN apt-get install -y php7-xml php7-iconv php7-ctype php7-mysqli php7-curl nginx openssl;

#Creation of certificates
RUN openssl req -newkey rsa:4096 -x509 -sha256 -days 365 -nodes -out \
      /etc/ssl/mathmart.42Lyon.fr.pem -keyout /etc/ssl/mathmart.42Lyon.fr.key \
       -subj "/C=FR/ST=Lyon/L=Lyon/O=42 School/OU=llescure/CN=mathmart.42.fr"

#Creating and Adding Configuration Files
RUN mkdir -p /var/www/adminer
COPY conf/adminer.php /var/www/adminer/index.php
COPY conf/www.conf /etc/php7/php-fpm.d/

#Add the script to launch the deamons
COPY tool/start.sh /start.sh
ENTRYPOINT ["sh", "start.sh"]