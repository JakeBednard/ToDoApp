$OutputEncoding = New-Object -typename System.Text.UTF8Encoding
chcp 65001

$configurationOutputFile = "configuration.ini"

Write-Host "Before proceeding, make sure the root of this package is in your web server directory and that your database and web server are online." 
Write-Host ""
Write-Host "Configuration file will be outputted to:" $configurationOutputFile
Write-Host ""

$db_addr = Read-Host -Prompt 'Input your database address (default: localhost) '
$db_name = Read-Host -Prompt 'Input your database schema name (default: ToDoApp) '
$db_user = Read-Host -Prompt 'Input your database username (default: root) '
$db_pass = Read-Host -Prompt 'Input your database password (default: password) '

if ($db_addr -eq "") {
    $db_addr = "localhost"
}

if ($db_name -eq "") {
    $db_name = "ToDoApp"
}

if ($db_user -eq "") {
    $db_user = "root"
}

if ($db_pass -eq "") {
    $db_pass = "password"
}

"[database]" | Out-File -Encoding "UTF8" $configurationOutputFile
"db_address  = " + $db_addr | Out-File -append -Encoding "UTF8" $configurationOutputFile
"db_name     = " + $db_name | Out-File -append -Encoding "UTF8" $configurationOutputFile
"db_username = " + $db_user | Out-File -append -Encoding "UTF8" $configurationOutputFile
"db_password = " + $db_pass | Out-File -append -Encoding "UTF8" $configurationOutputFile

Write-Host ""
Write-Host "Configuration file has been sucessfully written to: " $configurationOutputFile;

Write-Host ""
Write-Host "Setting up Database...";

$url = "http://" + $db_addr + "/include/CreateDatabase.php"
$result = Invoke-WebRequest -Uri $url -Method GET

Write-Host "Database Setup: " $result;

if([int]$result.Content -eq 1) {
    Write-Host "Database has been successfully initalized."

    '' | Out-File -append -Encoding "UTF8" ".htaccess"
    '<Files "CreateDatabase.php">' | Out-File -append -Encoding "UTF8" ".htaccess"
    '     order allow,deny' | Out-File -append -Encoding "UTF8" ".htaccess"
    '     deny from all' | Out-File -append -Encoding "UTF8" ".htaccess"
    '</Files>' | Out-File -append -Encoding "UTF8" ".htaccess"

    Write-Host "Added deny to include/CreateDatabase.php to .htaccess"

    Write-Host "Restart your server and navigate to your web host to try things out."
}

else {
    Write-Host "SETUP FAILED. PLEASE CHECK YOUR PARAMETERS."
}


Read-Host -Prompt "Press enter to exit"