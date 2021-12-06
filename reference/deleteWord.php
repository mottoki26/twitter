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
                try {
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

                } catch(Exception $e) {
                    print '障害発生中';
                    exit();
                }
            ?>

            <form action="./deleteWordDone.php" method="post">
                <input type="hidden" name="r_id" value="<?php print $r_id ?>">
                <p><?php print $rec['word'] ?>を削除しますか？</p>
                <input type="button" value="戻る" onclick="history.back()">
                <input type="submit" value="削除">
            </form>
        </main>
    </body>
</html>