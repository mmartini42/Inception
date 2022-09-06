#!/bin/bash


#Colors
red=$(tput setaf 1)
green=$(tput setaf 2)
yellow=$(tput setaf 3)
cyan=$(tput setaf 6)
white=$(tput setaf 7)
normal=$(tput sgr0)
on_red=$(tput setab 1)
alert=${white}${on_red}

function isRoot() {
  if [ "$EUID" -ne 0 ]; then
    return 1
  fi
}

function initialCheck() {
  if ! isRoot; then
    printf "%sSorry, you need to run this as root%s\n" "$alert" "$normal"
    exit 1
  fi
  install
}

install() {
    apt-get update -y apt-get upgrade -y
    apt install -y apt-transport-https ca-certificates curl gnupg2 software-properties-common
    curl -fsSL https://download.docker.com/linux/debian/gpg | apt-key add -
    add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/debian $(lsb_release -cs) stable"
    apt-get update -y && apt-get upgrade -y
    apt install -y docker-ce
    curl -L https://github.com/docker/compose/releases/download/1.25.3/docker-compose-`uname -s`-`uname -m` \
      -o /usr/local/bin/docker-compose
    chmod +x /usr/local/bin/docker-compose
    usermod -aG docker user_42
    usermod -aG root user42
    printf "%sInstallation complete %s\n" "$green" "$normal"
}

initialCheck;

echo "127.0.0.1     mathmart.42lyon.fr" >> /etc/hosts
echo "%root   (ALL) NOPASSWD: ALL"
printf "%sAdd mathmart to hosts file %s\n" "$cyan" "$normal"