@   echo off
cd C:\laragon\www\sistema_escolar
C:\laragon\bin\php\php-8.3.15-nts-Win32-vs16-x64\php.exe artisan schedule:run >> NUL 2>&1
