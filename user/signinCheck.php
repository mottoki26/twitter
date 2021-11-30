
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

                    $mail = $post['mail'];
                    $pass = $post['pass'];

                    $flg = false;

                    // データベース接続ファイルの使用
                    include_once '../common/dbConnection.php';

                    $sql = 'select user_id, name, password from user where mail=?';

                    $stmt = $dbh->prepare($sql);
                    $data[] = $mail;
                    $stmt->execute($data);
                    
                    // データベースの切断
                    $dbh = null;

                    // データの取得
                    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

                    // メールアドレスの判定
                    if($mail == '') {
                        $flg = true;
                    }

                    if($pass == '') {
                        $flg = true;
                    } else {
                        $pass = hash('sha256', $pass);
                        if(is_null($stmt) || $rec['password'] != $pass) {
                            $flg = true;
                        }
                    }

                    if($flg){
                        print 'メールアドレスまたはパスワードが違います';
                        print '<form>';
                        print '<input type="button" onclick="history.back()" value="戻る">';
                        print '</form>';
                        // header("Content-type: application/json; charset=UTF-8");
                        // echo json_encode(array('error' => 'メールアドレスまたはパスワードが違います'));
                        // print json_encode(array('error' => '<h1>HELP</h1>'));
                        exit;
                    } else {
                        session_start();
                        session_regenerate_id(true);
                        $_SESSION['signin'] = 1;
                        $_SESSION['mail'] = $mail;
                        $_SESSION['user_id'] = $rec['user_id'];
                        $_SESSION['name'] = $rec['name'];
                        header('location:../');
                        exit();
                    }

                } catch (Exception $e) {
                    print '障害発生中';
                    exit();
                }
            ?>
        </main>
    </body>
</html>