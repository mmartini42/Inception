FROM debian:buster

EXPOSE 25565

RUN apt-get update -y && apt-get upgrade -y
RUN apt-get install -y screen

#Install java 8 configuration
RUN apt install apt-transport-https ca-certificates wget dirmngr gnupg software-properties-common -y;
RUN wget -qO - https://adoptopenjdk.jfrog.io/adoptopenjdk/api/gpg/key/public | apt-key add -
RUN add-apt-repository --yes https://adoptopenjdk.jfrog.io/adoptopenjdk/deb/
RUN apt-get update && apt-get upgrade -y
RUN apt install adoptopenjdk-8-hotspot -y

RUN mkdir -p /home/minecraft

WORKDIR /home/minecraft
RUN wget https://cdn.getbukkit.org/spigot/spigot-1.8.8-R0.1-SNAPSHOT-latest.jar
RUN chmod +x spigot-1.8.8-R0.1-SNAPSHOT-latest.jar
COPY conf/eula.txt /home/minecraft/eula.txt
COPY tool/start.sh /home/minecraft/start.sh

ENTRYPOINT ["sh", "start.sh"]
