<?php
    try {
        require_once '../common/common.php';

        $post = sanitize($_POST);

        $mail = $post['mail'];
        $name = $post['name'];
        $pass = $post['pass'];

        $pass = hash('sha256', $pass);

        // データベース接続ファイルの使用
        include_once '../common/dbConnection.php';

        $sql = 'insert into user(mail, name, password) values(?,?,?)';
        $stmt = $dbh->prepare($sql);
        
        $data[] = $mail;
        $data[] = $name;
        $data[] = $pass;

        $stmt->execute($data);

        $dbh = null;

        // print 'ユーザを作成しました<br>';
        $error['status'] = 'OK';

    } catch (Exception $e) {
        // print '障害発生中';
        $error['status'] = 'SERVER_ERROR';
    }
    print json_encode($error);
    header('Content-type: application/json; charset=utf8');
    exit();
?>