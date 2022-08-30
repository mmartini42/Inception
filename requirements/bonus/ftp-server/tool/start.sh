#!/bin/sh

chown -R mathmart:mathmart /home/mathmart

#start ftp-server
vsftpd /etc/vsftpd/vsftpd.conf