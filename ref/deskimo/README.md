Deskimo

===How to deploy???===
   1. Require: 
        - Docker
        - Docker-composer
       
   2. Deploy application on local
        - Clone code from git repository: git clone {remote repository}
        - Switch to developer branch: git checkout develop
        - Run docker-composer: docker-compose up -d
        - Install application server & Database server: docker-compose exec php bash build_dev.sh
        - Add host: 127.0.0.1 deskimo.local
        => Open browser and access to deskimo.local/app_dev.php


    