<?php
    session_start();
    session_regenerate_id(true);
    $user_id = $_SESSION['user_id'];
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

                    $post = sanitize($_POST);
                    $r_id = $post['r_id'];
                    $comment = $post['comment'];
                    
                    
                    include_once '../common/dbConnection.php';

                    $sql = 'insert into reply(reference_id, user_id, comment) values(?,?,?)';

                    $stmt = $dbh->prepare($sql);
                    $data[] = $r_id;
                    $data[] = $user_id;
                    $data[] = $comment;
                    $stmt->execute($data);

                    $dbh = null;

                    /* ホーム画面に戻る */
                    header('location:../');

                } catch (Exception $e) {
                    print '障害発生中';
                    print $e;
                    exit();
                }
            ?>
        </main>
    </body>
</html>