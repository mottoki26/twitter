<?php
    session_start();
    session_regenerate_id(true);
    if(isset($_SESSION['signin'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        header('location:../');
        exit();
    }
?>

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

        $error['status'] = 'OK';
        $error['name'] = $_SESSION['name'];
        /* ホーム画面に戻る */
        // header('location:../');

    } catch (Exception $e) {
        // print '障害発生中';
        // exit();
        $error['status'] = 'SERVER_ERROR';
    }

    print json_encode($error);

    header('Content-type: application/json; charset=utf8');
    exit();
?>