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
            
            <form action="./addCheckWord.php" method="post" enctype="multipart/form-data">
                <p><label>科目</label>
                <?php
                    include_once '../common/dbConnection.php';

                    $sql = 'select subject_id, subject_name from subject';
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute();

                    $dbh = null;

                    print '<select name="subject">';
                    print '<option>-----</option>';
                    while($rec = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        print '<option value="'.$rec['subject_id'].'">'.$rec['subject_name'].'</option>';
                    }
                    print '</select>';
                    print '<br><input type="text" name="subject_name" placeholder="科目名">';
                ?>
                </p>
                <p><label>用語：</label>
                <input type="text" name="word"></p>
                <p><label>定義：</label>
                <input type="text" name="definition"></p>
                <p><label>画像：</label>
                <input type="file" name="image" accept=".png,.gif"></p>
                <input type="button" value="戻る" onclick="history.back()">
                <input type="submit" value="ツイート">
            </form>
        </main>
    </body>
</html>