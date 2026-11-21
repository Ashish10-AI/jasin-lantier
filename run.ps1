Write-Host "========================================================" -ForegroundColor Cyan
Write-Host "Starting Jason Lantier Portfolio PHP Server..." -ForegroundColor Green
Write-Host "Website URL:   http://localhost:8000" -ForegroundColor Yellow
Write-Host "Portfolio URL: http://localhost:8000/jason_portfolio.php" -ForegroundColor Yellow
Write-Host "Press Ctrl+C to stop the server." -ForegroundColor Gray
Write-Host "========================================================" -ForegroundColor Cyan

& ".\php_bin\php.exe" -S 127.0.0.1:8000

