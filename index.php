<?php
    session_start();
    session_regenerate_id(true);
    $signin = false;
    if (isset($_SESSION['signin'])) {
        $signin = true;
        $user_id = $_SESSION['user_id'];
    }
?>

<!DOCTYPE html>
<html lang="ja">

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="css/style.css">

        <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/reset.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Modaal/0.4.4/css/modaal.min.css">
        <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/9-6-3/css/9-6-3.css">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Twitter</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Modaal/0.4.4/js/modaal.min.js"></script>
        <script src="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/9-6-3/js/9-6-3.js"></script>
        <script src="./js/common.js"></script>
    </head>

    <body class="dashboard">
        <div class="left">
            <div class="sidebar">
                <div class="wrapper">
                    <div class="menu">
                        <img src="https://i.ibb.co/B4Dn7CT/menu.png">
                    </div>
                    <div class="profile">
                        <i class="bi bi-gear" title="setting"></i>
                    </div>
                </div>
            </div>
            <div class="navigation">
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
                    <p class="test">→ 確認画面モーダルリンク</p>
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
                    <?php if($signin) { ?>
                        <div class="folder-icons">
                            <div class="icon1">
                                <!-- <img src="https://i.ibb.co/z4QhcbD/email.png" />-->
                                <i class="bi bi-dice-5"></i>
                            </div>
                            <div class="icon-name">Logout</div>
                        </div>
                    <?php } else { ?>
                        <div class="folder-icons">
                            <div class="icon1">

                            </div>
                            <div class="icon-name">Signup</div>
                        </div>
                        <div class="folder-icons">
                            <div class="icon1">

                            </div>
                            <div class="icon-name">Signin</div>
                        </div>
                    <?php } ?>
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

                        <!-- <div class="top-bar-items">
                            <div class="notif">
                                <div class="online pink">
                                </div>
                                <img src="https://i.ibb.co/VJm73Hz/notifications-button.png">
                            </div>
                            <img src="https://i.ibb.co/vz4HYJb/envelope.png">
                            <img src="https://i.ibb.co/52Vkq4M/earth-globe.png">
                            <div class="icon-name5"> English </div>
                        </div> -->
                    </div>
                    <?php if($signin) { ?>
                    <div class="profile2">
                        <!-- <img src="https://www.seekclipart.com/clipng/middle/103-1032140_graphic-transparent-1-vector-flat-small-user-icon.png"> -->
                        <!-- <div class="icon-name5">Larry Nunez</div> -->
                        <div class="icon-name5"><?php print $_SESSION['name']; ?></div>
                    </div>
                    <?php } ?>
                    <!-- <ul style="list-style-type: none; padding: 0; width: 300px;">
                        <?php if ($signin) { ?>

                        <?php } else { ?>
                            <li>
                                <p><a href="./user/signin.php"><button>サインイン</button></a></p>
                            </li>
                            <li>
                                <p><a href="./user/signup.php"><button>サインアップ</button></a></p>
                            </li>
                        <?php } ?>
                    </ul> -->
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

                    /* リファレンス情報のSQL実行 */
                    $sql = 'select reference_id, user.user_id, subject.subject_name, name, word, definition, image from user, reference, subject
                            where 1 and user.user_id = reference.user_id and reference.subject_id = subject.subject_id';
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute();

                    /* リファレンス情報を連想配列でデータ取得 */
                    $references = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    print '<br>';

                    /* 返信情報のSQL実行 */
                    $sql = 'select name, comment, reference_id from user, reply where user.user_id = reply.user_id';
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute();

                    /* 返信情報を連想配列でデータ取得 */
                    $replys = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if ($signin) {
                        /* ブックマーク情報のSQL実行 */
                        $sql = 'select reference_id, user_id from bookmark where user_id = ?';
                        $stmt = $dbh->prepare($sql);
                        $data[] = $user_id;
                        $stmt->execute($data);

                        /* ブックマーク情報を連想配列で取得 */
                        $bookmarks = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    }

                    /* データベースの切断 */
                    $dbh = null;

                } catch (Exception $e) {
                    print '障害発生中';
                    exit();
                }
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
                                <i class="bi bi-bookmark" data-id="1"></i>
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
                                <p><?php print $reference['subject_name'] ?></p>
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
                                                break;
                                            }
                                        }
                                        print '<div class="star">';
                                        print '<i class="' . $class_name . '" data-id="'.$reference['reference_id'].'" title="ブックマーク"></i>';
                                        print '</div>';
                                    ?>
                                    <!-- <div class="star">
                                        <?php /* 返信 */ ?>
                                        <a href="./reply/addReply.php?r_id=<?php print $reference['reference_id'] ?>"><i class="bi bi-chat-left-text"></i></a>
                                    </div> -->
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <?php } ?>
                <?php /* リファレンス表示終了 */ ?>

                <div class="message">
                    <i class="bi bi-three-dots-vertical" style="float: right;"></i>
                    <button style="float: right;" name="delete">削除</button>
                    <div class="title">
                        用語
                    </div>
                    <div class="message-from">
                        科目名
                        <p>
                            定義
                        </p>
                    </div>
                    <div class="attachment-last">
                        <i class="bi bi-images"></i>
                    </div>
                    <i class="bi bi-chat-left-text" data-id="1"></i>
                    <div class="reply"></div>
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
                        <div class="attachment-last">
                            <?php if(isset($user_id) && $reference['user_id'] == $user_id /* && $reference['image'] != '' */) { ?>
                                <i class="bi bi-images"></i>
                            <?php } ?>
                        </div>
                        <?php /* 返信 */ ?>
                        <?php if ($signin) { ?>
                            <!-- <a href="./reply/addReply.php?r_id=<?php print $reference['reference_id'] ?>"><i class="bi bi-chat-left-text" data-id="<?php print $reference['reference_id']; ?>"></i></a> -->
                            <?php
                                // print '<a href="./reply/addReply.php?r_id='.$reference['reference_id'].'">';
                                print'<i class="bi bi-chat-left-text" data-id="'.$reference['reference_id'].'"></i>';
                                // print '</a>';

                                /* ブックマーク */
                                $class_name = 'bi bi-bookmark';
                                foreach ($bookmarks as $bookmark) {
                                    if ($reference['reference_id'] == $bookmark['reference_id']) {
                                        $class_name .= '-fill';
                                        break;
                                    }
                                }
                                print '<i class="' . $class_name . '" data-id="'.$reference['reference_id'].'" title="ブックマーク"></i>';
                            }

                            print '<div class="reply">';
                            if (count($replys) > 0) {
                                print '<br>';
                                foreach ($replys as $reply) {
                                    if ($reference['reference_id'] == $reply['reference_id']) {
                                        // print '<div class="new-hr"></div>';
                                        print '<div style="border: 0.6px solid #ddd;"></div>';
                                        print '<div class="mails">';
                                        // print '返信者：' . $reply['name'] . '<br>';
                                        print '<div class="mail-names">'.$reply['name'].'</div>';
                                        print '</div>';
                                        print '<div class="mail-info">';
                                        // print '返信コメ：' . $reply['comment'] . '<br>';
                                        print $reply['comment'];
                                        print '</div>';
                                    }
                                }
                            }
                            print '</div>';
                        ?>
                    </div>
                <?php } ?>
            </div>
        </main>
    </body>
</html>