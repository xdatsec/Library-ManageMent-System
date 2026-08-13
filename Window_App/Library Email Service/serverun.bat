@echo off
cd /d "C:\xampp\php"  REM Change directory to XAMPP's PHP folder
php.exe -f "%~dp0server\mailer.php"