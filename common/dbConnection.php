<?php
    // $dsn = 'mysql:host=localhost; dbname=twitter; charset=utf8';
    // $dbname = 'testcode';
    // $dbpass = 'testcode';
    $dsn = 'mysql:host=us-cdbr-east-05.cleardb.net; dbname=heroku_2fa9c229c266d42; charset=utf8';
    $dbuser = 'b7b0fec2387eb8';
    $dbpass = 'e0318f9e';
    $dbh = new PDO($dsn, $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>