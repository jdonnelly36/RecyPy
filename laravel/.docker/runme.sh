#!/bin/bash

docker stop laravel-mysql
docker rm laravel-mysql

docker run -d -p 3306:3306 --name laravel-mysql -e MYSQL_ROOT_PASSWORD=password laravel-mysql
