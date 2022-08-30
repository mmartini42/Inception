FROM debian:buster

MAINTAINER mathmart <mathmart@student.42lyon.fr>

#Installation of required packages
RUN apt-get update -y && apt-get upgrade -y
RUN apt-get install-y vsftpd libc6-compat

#Creat a new user and add password
RUN adduser -D -g 'mathmart' mathmart
RUN echo "mathmart:pass" | chpasswd

#Adding Configuration Files
COPY conf/vsftpd.conf /etc/vsftpd/

#Add the script to launch the deamons
COPY tool/start.sh /
ENTRYPOINT ["sh", "/start.sh"]