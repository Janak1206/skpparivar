<?php
function db_connect()
{
    //$host = "skpfamilymembers-server.mysql.database.azure.com";
    //$dbUser = "loxeqovjro";
    //$dbPass = "5SAVI30G1730APPP";
    //$dbName = "sanand_parivar";
	$host = "127.0.0.1";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "sanand_parivar";
    $conn = mysqli_connect($host, $dbUser, $dbPass, $dbName) or die("DB Connection Error: " . mysqli_connect_error());
    return $conn;
}

function db_close($conn)
{
    mysqli_close($conn);
}
