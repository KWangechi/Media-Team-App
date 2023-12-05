## Cloning the project
`` git clone https://github.com/KWangechi/Media-Team-App.git ``


## Create a new branch and checkout
`` git checkout -b [new_branch] ``

> **Replace the branch name with your new branch name. Note: it should be consistent with the remote branches**


## Install Composer Dependencies
`` composer install  && composer update ``


## Create a new ENV file and copying from the .env.example
`` cp .env.example .env ``


## Generate a key for the project
`` php artisan key:generate ``


## Clear any configurations for the project
`` php artisan optimize:clear ``


## Seed the databases with dummy data
`` php artisan migrate:seed ``


## Start the Laravel Server
`` php artisan serve ``
