<?php
    session_start();
    session_regenerate_id(true);
    $ope = false;
    if(isset($_SESSION['signin'])) {
        $ope = true;
    } else {
        header('location:./');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Twitter</title>
    </head>
    <body>
        <main>
            <?php
                print_r($_GET);
                if(isset($_GET['user_id'])) {

                }
            ?>
        </main>
    </body>
</html>