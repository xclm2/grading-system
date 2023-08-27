#!bin/sh
sudo chown $USER:$USER -R project
cp project/.env.example project/.env
mv project temp

echo "MOVING TO TEMP"
sleep 5

docker-compose up -d
echo "Wait for docker build to finish"
sleep 5

sudo chown $USER:$USER -R project
echo "Changing permissions"
sleep 1

cp -R temp/. project
echo "Copying to project"
sleep 5

rm -rf temp

echo "NPM INSTALL"
docker-compose exec grading npm install
docker-compose exec grading php artisan key:generate
docker-compose exec grading php artisan migrate
echo "Changing permissions"
sleep 1
sudo chown $USER:$USER -R project

cd project
npm run dev

echo "For more info visit: https://hub.docker.com/r/bitnami/laravel/"