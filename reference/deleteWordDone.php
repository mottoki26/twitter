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

<!-- <!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SNS風単語帳</title>
    </head>
    <body>
        <main>
            <?php
                try {
                    require_once '../common/common.php';
                    if(isset($_POST['r_id'])) {
                        $post = sanitize($_POST);
                        $r_id = $post['r_id'];
                    } else {
                        header('location:../');
                        exit();
                    }

                    include_once '../common/dbConnection.php';

                    $sql = 'select image from reference where reference_id = :rid';

                    $stmt = $dbh->prepare($sql);
                    $data[':rid'] = $r_id;
                    $stmt->execute($data);

                    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                    $image = $rec['image'];

                    $sql = 'delete from bookmark where reference_id = :rid;';

                    $sql .= 'delete from reply where reference_id = :rid;';

                    $sql .= 'delete from reference where reference_id = :rid;';
                    
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute($data);

                    $dbh = null;

                    if($image != '') {
                        unlink('./img/'. $image);
                    }

                    header('location:../');
                    exit();
                    
                } catch(Exception $e) {
                    print '障害発生中';
                    exit();
                }
            ?>
        </main>
    </body>
</html> -->

<?php
    
?>