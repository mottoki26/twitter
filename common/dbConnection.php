<?php
    $dsn = 'mysql:host=localhost; dbname=twitter; charset=utf8';
    $dbname = 'testcode';
    $dbpass = 'testcode';
    $dbh = new PDO($dsn, $dbname, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>