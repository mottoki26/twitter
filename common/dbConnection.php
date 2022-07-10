<?php
    $URL = getenv('URL');
    $dsn = 'mysql:host='.$URL.'; dbname=heroku_2fa9c229c266d42; charset=utf8';
    $dbuser = getenv('DBUSER');
    $dbpass = getenv('DBPASS');
    error_log('URL:'.$URL);
    error_log('DSN:'.$dsn);
    error_log('USER:'.$dbuser);
    error_log('PASS:'.$dbpass);

    $dbh = new PDO($dsn, $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>