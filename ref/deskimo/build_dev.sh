#!/usr/bin/env bash
chmod -R 777 var/*
//php -d memory_limit=-1  composer.phar install
php bin/console c:c --env=dev
chmod -R 777 var/*
php bin/console doctrine:schema:update --force
yarn install
yarn build-dev
