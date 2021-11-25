<?php
session_start();
session_regenerate_id(true);
$signin = false;
if (isset($_SESSION['signin'])) {
    $signin = true;
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
        <script src="./js/bookmark.js"></script>
        <script src="./js/common.js"></script>
    </head>

    <body class="dashboard">
        <div class="left">
            <div class="sidebar">
                <div class="wrapper">
                    <div class="menu">
                        <img src="https://i.ibb.co/B4Dn7CT/menu.png">
                    </div>
                </div>
            </div>
            <div class="navigation active">
                <div class="wrapper2">
                    <div class="abilan">
                        <!--<img src="https://i.ibb.co/HgJrt1p/abilan.png" />-->
                    </div>
                    <button class="compose">リファレンスの作成
                        <span class="plus">
                        <img src="https://i.ibb.co/v1HxGWj/add-1.png"/>
                        </span>
                    </button>
                    <div class="folders">Folders</div>
                    <div class="folder-icons">
                        <div class="icon1">
                            <!--<img src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css%22%3E" />-->
                            <i class="bi bi-book"></i>
                        </div>
                        <div class="icon-name1">Inbox
                            <!--<button class="button-span">-->
                            </button>
                        </div>
                    </div>
                    <div class="folder-icons">
                        <div class="icon1">
                            <!--<img src="https://i.ibb.co/2yLfX9W/sent-mail.png" />-->
                            <i class="bi bi-house"></i>
                        </div>
                        <div class="icon-name">Home</div>
                    </div>
                    <div class="folder-icons">
                        <div class="icon1">
                            <!--<img src="https://i.ibb.co/6ZH9kK3/star.png" />-->
                            <i class="bi bi-search"></i>
                        </div>
                        <div class="icon-name">Search</div>
                    </div>
                    <div class="folder-icons">
                        <div class="icon1">
                            <!-- <img src="https://i.ibb.co/z4QhcbD/email.png" />-->
                            <i class="bi bi-dice-5"></i>
                        </div>
                        <div class="icon-name">log out</div>
                    </div>
                    <div class="folder-icons">
                        <div class="icon1">
                            <!--<img src="https://i.ibb.co/3MzfGDF/bug.png" />-->
                        </div>
                        <!--<div class="icon-name">Spam</div>-->
                    </div>
                    <div class="folder-icons">
                        <div class="icon1">
                            <!--<img src="https://i.ibb.co/xfcFLCN/waste-bin.png" />-->
                        </div>
                        <!--<div class="icon-name">Trash</div>-->
                    </div>
                    <div class="folders">
                        follow
                    </div>
                    <div class="folder-icons">
                        <div class="avatar">
                            <div class="online">
                            </div>
                            <!--<img src="https://randomuser.me/api/portraits/women/65.jpg" />-->
                            <i class="bi bi-emoji-smile"></i>
                        </div>
                        <div class="names">Don Allen
                        </div>

                    </div>
                    <div class="folder-icons">
                        <div class="avatar">
                            <div class="online">
                            </div>
                            <!--<img src="https://randomuser.me/api/portraits/women/71.jpg" />-->
                            <i class="bi bi-emoji-smile"></i>
                        </div>
                        <div class="names">Aaron Tim</div>
                    </div>
                    <div class="folder-icons">
                        <div class="avatar">
                            <div class="online red">
                            </div>
                            <!--<img src="https://randomuser.me/api/portraits/men/54.jpg" />-->
                            <i class="bi bi-emoji-smile"></i>
                        </div>
                        <div class="names">Jack Joe</div>
                    </div>
                    <div class="folders">
                        Labels
                    </div>
                    <div class="section1">
                        <button class="btn button1"> Important
            <span class="tag">
              <img src="https://i.ibb.co/Zdx3jGx/tag.png"/></span>
            </button>

                        <button class="btn button2"> New
              <span class="tag">
              <img src="https://i.ibb.co/N1SMfgQ/tag.png"/></span>
            </button>
                    </div>
                    <div class="section2">
                        <button class="btn button3"> Old
               <span class="tag">
              <img src="https://i.ibb.co/C5q0MDM/tag.png"/></span>
             </button>
                        <button class="btn button4"> Priority
               <span class="tag">
              <img src="https://i.ibb.co/DMmSZW0/tag.png"/></span>
             </button>
                    </div>
                </div>
            </div>
        </div>
        
        <main class="right-side">
            <div class="right-header">
                <div class="top-bar">
                    <div class="top-bar-justify">
                        <div class="big-inbox">
                            Inbox
                        </div>

                        <div class="top-bar-items">
                            <div class="notif">
                                <div class="online pink">
                                </div>
                                <img src="https://i.ibb.co/VJm73Hz/notifications-button.png">
                            </div>
                            <img src="https://i.ibb.co/vz4HYJb/envelope.png">
                            <img src="https://i.ibb.co/52Vkq4M/earth-globe.png">
                            <div class="icon-name5"> English </div>
                        </div>
                    </div>
                    <div class="profile2">
                        <!-- <img src="https://www.seekclipart.com/clipng/middle/103-1032140_graphic-transparent-1-vector-flat-small-user-icon.png"> -->
                        <img src="" alt="">
                        <div class="icon-name5">Larry Nunez</div>
                    </div>
                    <ul style="list-style-type: none; padding: 0; width: 300px;">
                        <?php if ($signin) { ?>
                            <li>
                                <p><?php print $_SESSION['name'] ?></p>
                            </li>
                        <?php } else { ?>
                            <li>
                                <p><a href="./user/signin.php"><button>サインイン</button></a></p>
                            </li>
                            <li>
                                <p><a href="./user/signup.php"><button>サインアップ</button></a></p>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <hr class="new-hr">
                
                <div class="right-bottom">
                    <div class="check">
                        <label class="checkbox"><input type="checkbox"></label>
                        <div class="down-arrow">
                            <img src="https://i.ibb.co/WDqrXj6/drop-down-arrow.png">
                        </div>
                    </div>

                    <div class="middle-buttons">
                        <div class="buttons">
                            <button class="new button">
                                <img src="https://i.ibb.co/X4j3TZR/reload.png">
                            </button>
                            <button class="new button">
                                <img src="https://i.ibb.co/L60Yr87/eye.png">
                            </button>
                            <button class="new button">
                                <img src="https://i.ibb.co/Lv6TqBG/waste-bin.png">
                            </button>
                        </div>
                        <form action="./search.php" method="post" class="form has-search">
                            <input class="text" type="search" placeholder="検索" name="search">
                            <span class="searchIcon">
                                <img src="https://i.ibb.co/sqFgRq8/search.png">
                            </span>
                        </form>
                    </div>
                    <div class="search-arrow">
                        <img src="https://i.ibb.co/cx2t05H/scroll-arrows.png">
                    </div>
                </div>
            </div>

            <?php /* リファレンス表示 */ ?>
            <?php
                try {
                    /* データベース接続ファイルの使用 */
                    include_once './common/dbConnection.php';

                    /* ツイート情報のSQL実行 */
                    $sql = 'select reference_id, user.user_id, subject.subject_name, name, word, definition, image from user, reference, subject where 1 and user.user_id = reference.user_id and reference.subject_id = subject.subject_id';
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute();

                    /* ツイート情報のデータ取得 */
                    $references = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    print '<br>';

                    /* 返信情報のSQL実行 */
                    $sql = 'select name, comment, reference_id from user, reply where user.user_id = reply.user_id';
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute();

                    /* 返信情報のデータ取得 */
                    $replys = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if ($signin) {
                        /* ブックマーク情報のSQL実行 */
                        $sql = 'select reference_id, user_id from bookmark where user_id = ?';
                        $stmt = $dbh->prepare($sql);
                        $data[] = $_SESSION['user_id'];
                        $stmt->execute($data);

                        /* ブックマーク情報の取得 */
                        $bookmarks = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    }

                    /* データベースの切断 */
                    $dbh = null;
                } catch (Exception $e) {
                    print '障害発生中';
                    print $e;
                    exit();
                }

                /* if ($signin) {
                    print '<button id="btn" value="' . $_SESSION['user_id'] . '" onclick="samp(this)"><i class="bi bi-bookmark-fill"></i>テストボタン</button><br>';
                } */
            ?>

            <div class="right-body">
                <?php
                if (count($references) == 0) {
                    print '現在ツイートはありません';
                } else {
                ?>
                <div class="scroll-cards">
                    <div class="card">
                        <div class="mails">
                            <div class="mail-names">
                                名前
                            </div>
                        </div>
                        <div class="mail-info">
                            <p>科目名</p>
                            用語
                        </div>
                        <div></div>
                        <div class="bottom-info">
                            <div class="star">
                                <i class="bi bi-bookmark"></i>
                            </div>
                        </div>
                    </div>
                    
                    <?php foreach ($references as $reference) { ?>
                        <div class="card">
                            <div class="mails">
                                <div class="mail-names">
                                    <?php print $reference['name'] ?>
                                </div>
                                <?php
                                if ($reference['image'] != '') {
                                    print '<img src="./reference/img/' . $reference['image'] . '" style="width: 50px">';
                                }
                                /* if ($signin && $reference['user_id'] == $_SESSION['user_id']) {
                                    print '<a href="./reference/editWord.php?r_id=' . $reference['reference_id'] . '">編集</a><br>';
                                } */
                                /* print '<a href="./bookmark.php?r_id='.$reference['reference_id'].'"><i class="bi bi-bookmark"></i></a>';
                                        print '<a href="./bookmark.php?r_id='.$reference['reference_id'].'"><i class="bi bi-bookmark-fill" style="color: yellowgreen"></i></a>'; */
                                ?>
                            </div>
                            <div class="mail-info">
                                <!-- <script id="script" src="./js/tests.js" data-json-test='<?php /* print json_encode($reference); */ ?>'></script> -->
                                
                                <p id="test" data-json-test='<?php print json_encode($reference); ?>'><?php print $reference['subject_name']; ?></p>
                                <?php print $reference['word'] ?>
                            </div>
                            <?php if ($signin) { ?>
                                <div class="bottom-info">
                                    <?php
                                        /* ブックマーク */
                                        $class_name = 'bi bi-bookmark';
                                        foreach ($bookmarks as $bookmark) {
                                            if ($reference['reference_id'] == $bookmark['reference_id']) {
                                                $class_name .= '-fill';
                                            }
                                        }
                                        print '<div class="star">';
                                        print '<a href="./bookmark.php?r_id=' . $reference['reference_id'] . '"><i class="' . $class_name . '"></i></a>';
                                        print '</div>';
                                    ?>
                                    <!-- <div class="star">
                                        <?php /* 返信 */ ?>
                                        <a href="./reply/addReply.php?r_id=<?php print $reference['reference_id'] ?>"><i class="bi bi-chat-left-text"></i></a>
                                    </div> -->
                                </div>
                            <?php } ?>
                            <?php
                            /* if (count($replys) > 0) {
                                print '<div style="margin-left: 10rem; text-align: left;">';
                                foreach ($replys as $reply) {
                                    if ($reference['reference_id'] == $reply['reference_id']) {
                                        print '返信者：' . $reply['name'] . '<br>';
                                        print '返信コメ：' . $reply['comment'] . '<br>';
                                    }
                                }
                                print '</div>';
                            } */
                            ?>
                        </div>
                    <?php } ?>
                </div>
                <?php } ?>
                <?php /* リファレンス表示終了 */ ?>

                <div class="message">
                    <div class="title">
                        用語
                    </div>
                    <div class="message-from">
                        科目名
                        <p>
                            定義
                        </p>
                    </div>
                    <button class="btn2 buttona"> Reply
                        <span class="tag">
                            <img src="https://i.ibb.co/GQf8frw/reply.png">
                        </span>
                    </button>
                </div>
                <?php foreach($references as $reference) { ?>
                    <div class="message">
                        <div class="title">
                            <?php print $reference['word']; ?>
                        </div>
                        <div class="message-from">
                            <?php print $reference['subject_name']; ?>
                            <p>
                                <?php print $reference['definition']; ?>
                            </p>
                        </div>
                        <?php /* 返信 */ ?>
                        <a href="./reply/addReply.php?r_id=<?php print $reference['reference_id'] ?>"><i class="bi bi-chat-left-text"></i></a>
                        <?php
                            if (count($replys) > 0) {
                                print '<div>';
                                foreach ($replys as $reply) {
                                    if ($reference['reference_id'] == $reply['reference_id']) {
                                        print '返信者：' . $reply['name'] . '<br>';
                                        print '返信コメ：' . $reply['comment'] . '<br>';
                                    }
                                }
                                print '</div>';
                            }
                        ?>
                    </div>
                <?php } ?>
            </div>
        </main>
    </body>
</html>