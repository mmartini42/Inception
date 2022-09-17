FROM debian:buster

MAINTAINER mathmart <mathmart@student.42lyon.fr>

RUN apt-get update -y
RUN apt-get install -y nginx openssl

# Copy ssl certificat
RUN openssl req -newkey rsa:4096 -x509 -sha256 -days 365 -nodes -out \
  /etc/ssl/mathmart.42Lyon.fr.crt -keyout /etc/ssl/mathmart.42Lyon.fr.key \
   -subj "/C=FR/ST=Lyon/L=Lyon/O=42 School/OU=mathmart/CN=mathmart.42.fr"

#Copy config
COPY conf/conf/nginx.conf /etc/nginx/nginx.conf
COPY conf/conf/fastcgi_params /etc/nginx/fastcgi_params
COPY conf/conf.d /etc/nginx/conf.d
COPY conf/sites-enabled /etc/nginx/sites-enabled

CMD nginx -g 'daemon off;'

EXPOSE 443
