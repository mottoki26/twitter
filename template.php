<?php
    session_start();
    session_regenerate_id(true);
    $signin = false;
    if(isset($_SESSION['signin'])) {
        $signin = true;
    } else {
        header('location:../');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SNS風単語帳</title>
    </head>
    <body>
        <main>
            
        </main>
    </body>
</html>