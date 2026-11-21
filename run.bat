@echo off
title Jason Lantier Website (PHP Local Server)
echo ========================================================
echo Starting Jason Lantier Portfolio PHP Server...
echo Website URL:   http://localhost:8000
echo Portfolio URL: http://localhost:8000/jason_portfolio.php
echo.
echo Press Ctrl+C in this terminal to stop the server.
echo ========================================================
.\php_bin\php.exe -S 127.0.0.1:8000
pause

