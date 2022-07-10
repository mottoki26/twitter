<?php
    $URL = getenv('URL');
    $dsn = 'mysql:host='.$URL.'; dbname=heroku_2fa9c229c266d42; charset=utf8';
    $dbuser = getenv('USER');
    $dbpass = getenv('PASS');
    $dbh = new PDO($dsn, $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>