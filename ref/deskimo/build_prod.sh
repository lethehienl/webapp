#php -d memory_limit=-1  composer.phar install
yarn install
yarn build-prod
chmod -R 777 var/cache/prod
php bin/console c:c --env=prod