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

                    $user_id = $post['user_id'];
                    $word = $post['word'];
                    $file = $_FILES['image'];
                    
                    $image_name = $file['name'];
                    
                    include_once '../common/dbConnection.php';

                    if($image_name != '') {
                        if(str_ends_with($image_name, '.png') || str_ends_with($image_name, '.gif')) {
                            move_uploaded_file($file['tmp_name'], './img/'.$image_name);
                        }
                    }

                    $sql = 'insert into reference(user_id, word, image) values(?,?,?)';

                    $stmt = $dbh->prepare($sql);
                    $data[] = $user_id;
                    $data[] = $word;
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