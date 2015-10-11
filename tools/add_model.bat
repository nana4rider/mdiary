@echo off
cd ..\src

set /P MODEL_NAME="ModelName: "
php artisan make:model Models/%MODEL_NAME%
