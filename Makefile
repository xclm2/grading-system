start-project:
	docker-compose start
	docker-compose exec grading npm run dev

run-migrate:
	docker-compose exec grading php artisan migrate

clear-route-cache:
	docker-compose exec grading php artisan cache:clear
	docker-compose exec grading php artisan route:cache

route-list:
	docker-compose exec grading php artisan route:list