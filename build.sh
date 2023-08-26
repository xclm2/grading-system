#!bin/sh

docker-compose up -d
echo "Waiting for docker to complete"
sleep 10
docker-compose exec grading php artisan migrate
docker-compose exec grading npm install
docker-compose exec grading npm run dev
echo "For more info visit: https://hub.docker.com/r/bitnami/laravel/"