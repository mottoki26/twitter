<?php
    session_start();
    session_regenerate_id(true);
    $signin = false;
    if(isset($_SESSION['signin'])) {
        $signin = true;
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
            <?php
                require_once '../common/common.php';

                if(isset($_GET['r_id'])) {
                    $get = sanitize($_GET);
                } else {
                    header('location:../');
                    exit();
                }

                include_once '../common/dbConnection.php';

                $sql = 'select name, subject_name, word, definition from user, reference, subject
                        where 1 and user.user_id = reference.user_id and reference.subject_id = subject.subject_id and reference_id = ?';
                $stmt = $dbh->prepare($sql);
                $data[] = $get['r_id'];
                $stmt->execute($data);

                $dbh = null;

                if($rec = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    print '投稿者：'.$rec['name'].'<br>';
                    print '科目：'.$rec['subject_name'].'<br>';
                    print '用語：'.$rec['word'].'<br>';
                    print '定義：'.$rec['definition'].'<br>';
                }
            ?>
            <form action="./addCheckReply.php" method="post">
                <input type="hidden" name="r_id" value="<?php print $get['r_id'] ?>">
                <p><label>返信</label>
                <input type="text" name="comment"></p>
                <input type="button" value="戻る" onclick="history.back()">
                <input type="submit" value="返信">
            </form>
        </main>
    </body>
</html>