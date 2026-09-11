$ErrorActionPreference = 'SilentlyContinue'

$cloudflared = 'C:\Program Files (x86)\cloudflared\cloudflared.exe'
if (-not (Test-Path $cloudflared)) { $cloudflared = 'cloudflared' }

Get-CimInstance Win32_Process -Filter "Name='php.exe'" |
    Where-Object { $_.CommandLine -match 'artisan' -and $_.CommandLine -match '8899' } |
    ForEach-Object { Stop-Process -Id $_.ProcessId -Force }
Get-Process -Name cloudflared -ErrorAction SilentlyContinue | Stop-Process -Force
Start-Sleep -Milliseconds 600

$server = Start-Process -FilePath 'php' -ArgumentList 'artisan', 'serve', '--host=127.0.0.1', '--port=8899' -WorkingDirectory $PSScriptRoot -WindowStyle Hidden -PassThru
Write-Host 'Menunggu server lokal siap...'

$ok = $false
for ($i = 0; $i -lt 30; $i++) {
    try {
        $r = Invoke-WebRequest -Uri 'http://127.0.0.1:8899/' -UseBasicParsing -TimeoutSec 3
        if ($r.StatusCode -eq 200) { $ok = $true; break }
    } catch { }
    Start-Sleep -Milliseconds 500
}

if (-not $ok) {
    Write-Host 'Gagal menjalankan server lokal.' -ForegroundColor Red
    exit 1
}

Write-Host 'Server lokal siap: http://127.0.0.1:8899' -ForegroundColor Green
Write-Host ''
Write-Host 'Mulai tunnel publik Cloudflare... (biarkan jendela ini terbuka)' -ForegroundColor Cyan
Write-Host '  - URL publik akan muncul di log sebagai https://xxxx.trycloudflare.com' -ForegroundColor Cyan
Write-Host '  - Panel admin: akses via /admin?admin_token= lalu ikuti token di .env (TEST_TOKEN)' -ForegroundColor Cyan
Write-Host '  - Tekan Ctrl+C untuk menghentikan testing.' -ForegroundColor Cyan
Write-Host ''

& $cloudflared tunnel --url http://127.0.0.1:8899

Get-Process -Id $server.Id -ErrorAction SilentlyContinue | Stop-Process -Force
Get-Process -Name cloudflared -ErrorAction SilentlyContinue | Stop-Process -Force
Write-Host 'Testing dihentikan. Server lokal dimatikan.'