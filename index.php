<?php
    session_start();
    session_regenerate_id(true);
    $ope = false;
    if(isset($_SESSION['signin'])) {
        $ope = true;
    }
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <!-- <link rel="stylesheet" href="css/style.css"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Twitter</title>
    </head>
    <body>
        <main>
            <h1>ホーム画面</h1>
            <!-- リファレンス表示 -->
            <?php
                if($ope) {
                    print '<p>'.$_SESSION['name'].'さんがログイン中</p>';
                }

                try {
                    // 設定ファイルの読み込み
                    require_once './common/dbConfig.php';

                    // データベース接続ファイルの使用
                    include_once './common/dbConnection.php';
                    
                    $sql = 'select word, image, comment from user, reference, reply where user.user_id = reply.user_id and reference.reference_id = reply.reference_id';

                    $stmt = $dbh->prepare($sql);
                    $stmt->execute();

                    $dbh = null;

                    $recs = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if(count($recs) == 0) {
                        print '現在ツイートはありません';
                    } else {
                        foreach ($recs as $rec) {
                            print_r($rec);
                            print '<br>';
                        }
                    }

                    
                } catch(Exception $e) {
                    print '障害発生中';
                    exit();
                }
            ?>
            <!--  -->
            <a href="./reference/"></a>
            <table>
                <tr>
                    <td><p><a href="./user/signin.php"><button>サインイン</button></a></p></td>
                    <td><p><a href="./user/signup.php"><button>サインアップ</button></a></p></td>
                </tr>
                <tr style="text-align: center;">
                    <td><p><a href="search"><button>検索</button></a></p></td>
                    <td><p><a href="./user/logout.php"><button>ログアウト</button></a></p></td>
                </tr>
            </table>
        </main>
    </body>
</html>
