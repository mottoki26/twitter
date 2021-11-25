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

                    $subject_id = $post['subject'];
                    $subject_name = $post['subject_name'];
                    $word = $post['word'];
                    $definition = $post['definition'];
                    $file = $_FILES['image'];
                    
                    $image_name = $file['name'];
                    
                    include_once '../common/dbConnection.php';

                    if($image_name != '') {
                        if(str_ends_with($image_name, '.png') || str_ends_with($image_name, '.gif')) {
                            move_uploaded_file($file['tmp_name'], './img/'.$image_name);
                        }
                    }

                    if($subject_id == '') {
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