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
        <title>Twitter</title>
    </head>
    <body>
        <main>
            <?php
                require_once '../common/common.php';

                $get = sanitize($_GET);
            ?>
            <form action="./addCheckReply.php" method="post">
                <input type="hidden" name="r_id" value="<?php print $get['r_id'] ?>">
                <p><label>返信</label>
                <input type="text" name="comment"></p>
                <input type="button" value="戻る" onclick="history.back()">
                <input type="submit" value="返信">
            </form>
        </main>
    </body>
</html>