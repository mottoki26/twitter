<?php
    try {
        require_once '../common/common.php';

        $post = sanitize($_POST);

        $mail = $post['mail'];
        $pass = $post['pass'];

        $flg = false;

        // 設定ファイルの読み込み
        require_once '../common/dbConfig.php';

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
            if($rec['password'] != $pass) {
                $flg = true;
            }
        }

        if($flg){
            print 'メールアドレスまたはパスワードが違います';
            print '<form>';
            print '<input type="button" onclick="history.back()" value="戻る">';
            print '</form>';
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
        print $e;
        exit();
    }
?>