<?php
    session_start();
    session_regenerate_id(true);
    $signin = false;
    if(isset($_SESSION['signin'])) {
        $signin = true;
        $user_id = $_SESSION['user_id'];
    } else {
        header('location:../');
        exit();
    }
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
            <h1>ブックマーク一覧</h1>

            <?php
                include_once './common/dbConnection.php';

                $sql = 'select reference_id, user.user_id, subject_name, name, word, definition, image from user, reference, subject, bookmark
                        where 1 and user.user_id = reference.user_id and reference.subject_id = subject.subject_id and reference.reference_id = bookmark.reference_id and bookmark.user_id = ?';

                
            ?>
        </main>
    </body>
</html>