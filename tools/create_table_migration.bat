@echo off
cd ..\src

set /P table_name="table_name: "
php artisan make:migration create_%table_name%_table --create=%table_name%
