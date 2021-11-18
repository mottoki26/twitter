<?php
    session_start();
    // session_regenerate_id(true);
    $ope = false;
    if(isset($_SESSION['signin'])) {
        $ope = true;
    }
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Twitter</title>
    </head>
    <body>
        <header>
            <ul>
                <li><a href="./reference/addWord.php"><button>一言</button></a></li>
                <li><a href="./user/signin.php"><button>サインイン</button></a></li>
                <li><a href="./user/signup.php"><button>サインアップ</button></a></li>
                
                <form action="./search.php" method="post">
                    <input type="text" name="word" placeholder="検索">
                </form>
                <!-- <p><a href="./search.php"><button>検索</button></a></p> -->
                <p><a href="./user/logout.php"><button>ログアウト</button></a></p>
            </ul>
        </header>
        <main>
            <h1>ホーム画面</h1>
            <?php /* リファレンス表示 */ ?>
            <?php
                if($ope) {
                    print '<p>'.$_SESSION['name'].'さんがログイン中</p>';
                }

                try {
                    /* データベース接続ファイルの使用 */
                    include_once './common/dbConnection.php';
                    
                    /* ツイート情報のSQL実行 */
                    // $sql = 'select word, image, comment from user, reference, reply where 1 and user.user_id = reply.user_id and reference.reference_id = reply.reference_id';
                    $sql = 'select reference_id, user.user_id, name, word, image from user, reference where 1 and user.user_id = reference.user_id';
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute();

                    /* ツイート情報のデータ取得 */
                    $recs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    /* print_r($recs); */
                    print '<br>';

                    /* 返信情報のSQL実行 */
                    $sql = 'select name, comment, reference_id from user, reply where user.user_id = reply.user_id';
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute();

                    /* 返信情報のデータ取得 */
                    $replys = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    /* print_r($replys); */
                    $dbh = null;

                    /* if(count($recs) == 0) {
                        print '現在ツイートはありません';
                    } else {
                        foreach ($recs as $rec) {
                            print_r($rec);
                            print '<br>';
                            print 'ユーザ名：'.$rec['name'].'<br>';
                            print '一言：'.$rec['word'].'<br>';
                            if($rec['image'] != '') {
                                print '<img src="./reference/img/'.$rec['image'].'">';
                            }
                            if(isset($_SESSION['user_id']) && $rec['user_id'] == $_SESSION['user_id']) {
                                print '編集<br>';
                            }
                        }
                    } */
                    
                } catch(Exception $e) {
                    print '障害発生中';
                    print $e;
                    exit();
                }
            ?>
            <?php
                if(count($recs) == 0) {
                    print '現在ツイートはありません';
                } else {
            ?>
                <div class="right-body">
                    <div class="scroll-cards">
                            <?php foreach($recs as $rec) { ?>
                            <div class="card">
                                <div class="mails">
                                    <div class="mail-names">
                                        <?php print $rec['name'] ?><br>
                                        <?php if($rec['image'] != '') { ?>
                                            <img src="./reference/img/<?php print $rec['image'] ?>">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="mmail-info">
                                    <?php print $rec['word'] ?>
                                </div>
                                <br>
                                <?php
                                    if(count($replys) > 0) {
                                        print '<div style="margin-left: 10rem; text-align: left;">';
                                        foreach ($replys as $reply) {
                                            if($rec['reference_id'] == $reply['reference_id']) {
                                                print '返信者：'.$reply['name'].'<br>';
                                                print '返信コメ：'.$reply['comment'].'<br>';
                                            }
                                        }
                                        print '</div>';
                                    }
                                ?>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php /* リファレンス終了 */ ?>
            <br>
        </main>
    </body>
</html>
