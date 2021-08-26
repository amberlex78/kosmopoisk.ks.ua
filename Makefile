restart: down up
up:
	docker-compose up -d
down:
	docker-compose down --remove-orphans
build:
	docker-compose up --build -d

stop-local-services:
	sudo systemctl stop apache2
	sudo systemctl stop mysql

start-local-services:
	sudo systemctl start apache2
	sudo systemctl start mysql
