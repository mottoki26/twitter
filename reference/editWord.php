<?php
    session_start();
    session_regenerate_id(true);
    $ope = false;
    if(isset($_SESSION['signin'])) {
        $ope = true;
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
                if(isset($_GET['r_id'])) {
                    $get = sanitize($_GET);
                    $r_id = $get['r_id'];
                } else {
                    header('location:../');
                    exit();
                }

                include_once '../common/dbConnection.php';

                $sql = 'select word, image from reference where reference_id = ?';

                $stmt = $dbh->prepare($sql);
                $data[] = $r_id;
                $stmt->execute($data);

                $dbh = null;

                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
            <form action="./editCheckWord.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="<?php print $user_id ?>">
                <p><label>
                    一言：
                    <input type="text" name="word" value="<?php print $rec['word'] ?>">
                </label></p>
                <?php if($rec['image']) { ?>
                    <p><img src="./img/<?php print $rec['image'] ?>"></p>
                <?php } ?>
                <p><label>
                    画像：
                    <input type="file" name="image" accept=".png,.gif">
                </label></p>
                <input type="button" value="戻る" onclick="history.back()">
                <input type="submit" value="ツイート">
            </form>
        </main>
    </body>
</html>