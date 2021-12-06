<?php
    session_start();
    session_regenerate_id(true);
    $user_id = $_SESSION['user_id'];
    $name = $_SESSION['name'];

    try {
        require_once '../common/common.php';

        $post = sanitize($_POST);

        $subject_id = $post['subject'];
        $subject_name = $post['subject_name'];
        $word = $post['word'];
        $definition = $post['definition'];
        $file = $_FILES['image'];
        
        $image_name = $file['name'];

        // if($subject_id == '' && $subject_name == '') {
        //     print '科目を選択または入力してください。<br>';
        //     $flg = true;
        // }

        // if($word == '') {
        //     print '用語が入力されていません。<br>';
        //     $flg = true;
        // }

        if($image_name != '') {
            if(str_ends_with($image_name, '.png')) {
                move_uploaded_file($file['tmp_name'], './img/'.$image_name);
            }
        }

        include_once '../common/dbConnection.php';
        
        $sql = 'lock tables reference write, subject write';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        if($subject_id == '' && $subject_name != '') {

            $sql = 'insert into subject(subject_name) values(?)';
            $stmt = $dbh->prepare($sql);
            $data[] = $subject_name;
            $stmt->execute($data);

            $sql = 'select last_insert_id()';
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            if($rec = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $subject_id = $rec['last_insert_id()'];
            }
        }

        $data = array();

        $sql = 'insert into reference(user_id, subject_id, word, definition, image) values(?,?,?,?,?)';

        $stmt = $dbh->prepare($sql);
        $data[] = $user_id;
        $data[] = $subject_id;
        $data[] = $word;
        $data[] = $definition;
        $data[] = $image_name;
        $stmt->execute($data);

        
        $sql = 'select last_insert_id()';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        if($rec = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $r_id = $rec['last_insert_id()'];
        }

        $data = array();

        $sql = 'select subject_name from reference, subject
                where reference.subject_id = subject.subject_id and reference_id = ?';
        $stmt = $dbh->prepare($sql);
        $data[] = $r_id;
        $stmt->execute($data);

        if($rec = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $subject_name = $rec['subject_name'];
        }

        $sql = 'unlock tables';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        $dbh = null;

        $error['r_id'] = $r_id;
        $error['subject_name'] = $subject_name;
        $error['name'] = $name;

    } catch(Exception $e) {
        $error['status'] = 'SERVER_ERROR';
        $error['message'] = $e;
    }

    print json_encode($error);

    header('Content-type: application/json; charset=utf8');
    exit();
?>