#!/usr/bin/env bash
sass  ./src/Bundle/HtmlBundle/assets/thanhhuong/index.scss ./src/Bundle/HtmlBundle/public/thanhhuong/css/index.css
php bin/console cache:clear
php bin/console assets:install