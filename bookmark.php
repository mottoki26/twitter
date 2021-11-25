<?php
    session_start();
    session_regenerate_id(true);
    $signin = false;
    if(isset($_SESSION['signin'])) {
        $signin = true;
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
                try {
                    require_once './common/common.php';

                    if(isset($_GET['r_id'])) {
                        $get = sanitize($_GET);
                        $r_id = $get['r_id'];
                        $u_id = $_SESSION['user_id'];
                    } else {
                        header('location:./');
                        exit();
                    }

                    // データベース接続ファイルの使用
                    include_once './common/dbConnection.php';

                    $sql = 'select * from bookmark where reference_id = ? and user_id = ?';
                    $stmt = $dbh->prepare($sql);
                    $data[] = $r_id;
                    $data[] = $u_id;
                    $stmt->execute($data);

                    $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    if(count($rec) > 0) {   /* ブックマークがされている場合 */
                        $sql = 'delete from bookmark where reference_id = ? and user_id = ?';
                        $stmt = $dbh->prepare($sql);
                        $stmt->execute($data);
                    } else {                /* ブックマークがされている場合 */
                        $sql = 'insert into bookmark(reference_id, user_id) values(?,?)';
                        $stmt = $dbh->prepare($sql);
                        $stmt->execute($data);
                    }

                    $dbh = null;

                    header('location:./');
                    exit();

                } catch(Exception $e) {
                    print '障害発生中';
                    exit();
                }
            ?>
        </main>
    </body>
</html>