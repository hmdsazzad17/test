$processes = Get-Process

$i = 1
ForEach ($process in $processes) {

    
    Start-Sleep -Seconds 20
  
    Write-Output "Files are successfully created in ----"
    $i++
}
