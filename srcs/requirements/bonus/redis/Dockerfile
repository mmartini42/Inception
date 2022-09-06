FROM debian:buster

MAINTAINER mathmart <mathmart@student.42lyon.fr>

#Installation of required packages
RUN apt-get update -y && apt-get upgrade -y
RUN apt-get install -y redis-server;

#Add the configuration file to launch the deamons
COPY conf/redis.conf /
CMD ["redis-server", "/redis.conf"]