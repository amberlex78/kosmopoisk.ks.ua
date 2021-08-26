up:
	docker-compose up -d

down:
	docker-compose down --remove-orphans

build:
	docker-compose up --build -d
