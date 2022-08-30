THIS_FILE := $(lastword $(MAKEFILE_LIST))

docker-compose := srcs/docker-compose.yml

help:
		make -pRrq  -f $(THIS_FILE) : 2>/dev/null | awk -v RS= -F: '/^# File/,/^# Finished Make data base/ {if ($$1 !~ "^[#.]") {print $$1}}' | sort | egrep -v -e '^[^[:alnum:]]' -e '^$@$$'

all:	build up

build:
		docker compose -f $(docker-compose) build $(c)

up:
		docker compose -f $(docker-compose) up -d $(c)

start:
		docker compose -f $(docker-compose) start $(c)

down:
		docker compose -f $(docker-compose) down $(c)

destroy:
		docker compose -f $(docker-compose) down --rmi all $(c)

stop:
		docker compose -f $(docker-compose) stop $(c)

restart:
		docker compose -f $(docker-compose) stop $(c)
		docker compose -f $(docker-compose) up -d $(c)

logs:
		docker compose -f $(docker-compose) logs --tail=100 -f $(c)

logs-api:
		docker compose -f $(docker-compose) logs --tail=100 -f api

ps:
		docker compose -f $(docker-compose) ps

.PHONY: all help build up start down destroy stop restart logs logs-api ps
