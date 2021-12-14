<?php
    session_start();
    session_regenerate_id(true);
    if(!isset($_SESSION['signin'])) {
        header('location:../');
        exit();
    }
    
    try {
        require_once '../common/common.php';

        $post = sanitize($_POST);

        $r_id = $post['r_id'];
        $subject_id = $post['subject'];
        $subject_name = $post['subject_name'];
        $word = $post['word'];
        $definition = $post['definition'];
        $file = $_FILES['image'];
        
        $old_image = $post['old_image'];
        $image_name = $file['name'];

        if($image_name != '') {
            if(str_ends_with($image_name, '.png')) {
                if($old_image != '') {
                    unlink('./img/'.$old_image);
                }
                move_uploaded_file($file['tmp_name'], './img/'.$image_name);
            }
        } else {
            $image_name = $old_image;
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

            $error['subject'] = 1;
            $error['subject_id'] = $subject_id;
        }

        $sql = 'update reference set subject_id = ?, word = ?, definition = ?, image = ?
                where reference_id = ?';
        $stmt = $dbh->prepare($sql);
        $data[] = $subject_id;
        $data[] = $word;
        $data[] = $definition;
        $data[] = $image_name;
        $data[] = $r_id;
        $stmt->execute($data);

        $sql = 'unlock tables';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        $dbh = null;

        $error['status'] = 'OK';
    } catch (Exception $e) {
        $error['status'] = 'SERVER_ERROR';
        $error['message'] = $e;
    }

    print json_encode($error);

    header('Content-type: application/json; charset=utf8');
    exit();
?>