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
                    
                    require_once '../common/common.php';

                    $post = sanitize($_POST);

                    $mail = $post['mail'];
                    $name = $post['name'];
                    $pass = $post['pass'];

                    // 設定ファイルの読み込み
                    require_once '../common/dbConfig.php';

                    // データベース接続ファイルの使用
                    include_once '../common/dbConnection.php';

                    $sql = 'insert into user(mail, name, password) values(?,?,?)';
                    $stmt = $dbh->prepare($sql);
                    
                    $data[] = $mail;
                    $data[] = $name;
                    $data[] = $pass;

                    $stmt->execute($data);

                    $dbh = null;

                    print 'ユーザを作成しました<br>';
            
                } catch (Exception $e) {
                    print '障害発生中';
                    print $e;
                    exit();
                }
            ?>
            <a href="../"><button>戻る</button></a>
        </main>
    </body>
</html>