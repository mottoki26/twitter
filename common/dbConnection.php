<?php
    $dsn = 'mysql:host='.DB_SERVER.'; dbname='.DB_NAME.'; charset=utf8';
    $dbh = new PDO($dsn, DB_USER, DB_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>