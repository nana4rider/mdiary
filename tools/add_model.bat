@echo off
cd ..\src
set /P MODEL_NAME="Model–¼‚ð“ü—Í‚µ‚Ä‚­‚¾‚³‚¢: "

php artisan make:model Models/%MODEL_NAME%

set table_name=%MODEL_NAME%s
for %%i in (a b c d e f g h i j k l m n o p q r s t u v w x y z) do call set table_name=%%table_name:%%i=%%i%%

php artisan make:migration create_%table_name%_table --create=%table_name%

pause