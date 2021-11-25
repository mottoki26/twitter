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
        <link rel="stylesheet" href="css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Twitter</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="./js/bookmark.js"></script>
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
                    $sql = 'select reference_id, user.user_id, name, word, image from user, reference where 1 and user.user_id = reference.user_id';
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute();

                    /* ツイート情報のデータ取得 */
                    $recs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    print '<br>';

                    /* 返信情報のSQL実行 */
                    $sql = 'select name, comment, reference_id from user, reply where user.user_id = reply.user_id';
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute();

                    /* 返信情報のデータ取得 */
                    $replys = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    /* データベースの切断 */
                    $dbh = null;
                    
                } catch(Exception $e) {
                    print '障害発生中';
                    print $e;
                    exit();
                }

                if(isset($_SESSION['user_id'])) {
                    print '<button id="btn" value="'.$_SESSION['user_id'].'" onclick="samp(this)">テストボタン</button>';
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
                                        <?php print $rec['name'] ?>
                                    </div>
                                    <?php
                                        if($rec['image'] != '') {
                                            print '<img src="./reference/img/'.$rec['image'].'" style="width: 50px">';
                                        }
                                        if($ope && $rec['user_id'] == $_SESSION['user_id']) {
                                            print '<a href="./reference/editWord.php?r_id='.$rec['reference_id'].'">編集</a><br>';
                                        }
                                        print '<a href="./bookmark.php?r_id='.$rec['reference_id'].'"><button>Test</button></a>';
                                    ?>
                                    
                                </div>
                                <div class="mail-info">
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
