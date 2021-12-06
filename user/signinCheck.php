<?php
    try {
        require_once '../common/common.php';

        session_start();
        session_regenerate_id(true);

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

        $error = array();

        if($flg){
            $error['status'] = 'ERROR';
        } else {
            // session_start();
            // session_regenerate_id(true);
            $_SESSION['signin'] = 1;
            $_SESSION['mail'] = $mail;
            $_SESSION['user_id'] = $rec['user_id'];
            $_SESSION['name'] = $rec['name'];
            $error['status'] = 'OK';
        }

    } catch (Exception $e) {
        $error['status'] = 'SERVER_ERROR';
    } finally {
        print json_encode($error);

        header('Content-type: application/json; charset=utf8');
        exit();
    }
    
?>