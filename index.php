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
        
        <link rel="stylesheet" href="./css/style.css">

        <!-- モーダルウィンドウ -->
        <link rel="stylesheet" href="./css/modal_reset.css">
        <link rel="stylesheet" href="./css/modal.min.css">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Twitter</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="./js/modal.min.js"></script>
        <link rel="stylesheet" href="./css/modal.css">
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
            <div class="navigation">
                <div class="wrapper2">
                    <div class="folders">Folders</div>
                    <?php if($signin) { ?>
                        <div class="folder-icons inline" href="#add">
                        <div class="icon">
                            <i class="bi bi-pen"></i>
                        </div>
                        <div class="icon-name">作成</div>
                    </div>
                    <?php } ?>

                    <div class="folder-icons">
                        <div class="icon">
                            <i class="bi bi-book"></i>
                        </div>
                        <div class="icon-name">Index</div>
                    </div>

                    <div class="folder-icons">
                        <div class="icon1">
                            <i class="bi bi-house"></i>
                        </div>
                        <div class="icon-name">Home</div>
                    </div>

                    <?php if($signin) { ?>
                        <div class="folder-icons">
                            <div class="icon1">
                                <i class="bi bi-box-arrow-left"></i>
                            </div>
                            <div class="icon-name">Logout</div>
                        </div>
                    <?php } else { ?>
                        <div class="folder-icons">
                            <div class="icon1">
                                <i class="bi bi-person-plus"></i>
                            </div>
                            <div class="icon-name">Signup</div>
                        </div>
                        <div class="folder-icons">
                            <div class="icon1">
                                <i class="bi bi-box-arrow-in-right"></i>
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
                        <div class="big-Index">
                            Index
                        </div>
                    </div>
                    <?php if($signin) { ?>
                    <div class="profile2">
                        <p>ユーザー<br><i class="bi bi-emoji-smile" style="padding-right: 10px;"></i><?php print $_SESSION['name'] ?></p>
                    </div>
                    <?php } ?>
                </div>

                <hr class="new-hr">
                
                <div class="right-bottom">

                    <div class="middle-buttons">
                        <form action="./search.php" method="post" class="form has-search">
                            <input class="text" type="search" placeholder="検索" name="search">
                            <span class="searchIcon">
                                <img src="https://i.ibb.co/sqFgRq8/search.png">
                            </span>
                        </form>
                    </div>
                </div>
            </div>

            <?php /* リファレンス表示 */ ?>
            <?php
                try {
                    /* データベース接続ファイルの使用 */
                    include_once './common/dbConnection.php';

                    /* リファレンス情報のSQL実行 */
                    $sql = 'select reference_id, user.user_id, subject_name, name, word, definition, image from user, reference, subject
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
            ?>

            <div class="right-body">
                <?php
                if (count($references) == 0) {
                    print '<br><h1>現在リファレンスはありません</h1>';
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
                        <!-- <div class="bottom-info">
                            <div class="star">
                                <i class="bi bi-bookmark" data-id="1"></i>
                            </div>
                        </div> -->
                    </div>
                    
                    <?php foreach ($references as $reference) {
                        $r_id = $reference['reference_id'];
                    ?>
                        <div class="card">
                            <div class="mails">
                                <div class="mail-names">
                                    <?php print $reference['name'] ?>
                                </div>
                            </div>

                            <div class="mail-info">
                                <p><?php print $reference['subject_name'] ?></p>
                                <?php print $reference['word'] ?>
                            </div>

                            <!-- <?php if ($signin) { ?>
                                <div class="bottom-info">
                                    <?php
                                        /* ブックマーク */
                                        $class_name = 'bi bi-bookmark';
                                        foreach ($bookmarks as $bookmark) {
                                            if ($r_id == $bookmark['reference_id']) {
                                                $class_name .= '-fill';
                                                break;
                                            }
                                        }
                                        // print '<div class="star">';
                                        // print '<i class="' . $class_name . '" data-id="'.$r_id.'" title="ブックマーク"></i>';
                                        // print '</div>';
                                    ?>
                                </div>
                            <?php } ?> -->
                        </div>
                    <?php } ?>
                </div>
                <?php } ?>
                <?php /* リファレンス表示終了 */ ?>

                <!-- テスト用 ↓ -->
                <div class="message">
                    <button class="delete" data-id="1">削除</button>
                    <div class="title">
                        用語
                    </div>
                    <div class="message-from">
                        <div class="subject_name">科目名</div>
                        <p>
                            定義
                        </p>
                    </div>
                    <div class="attachment-last">
                        <i class="bi bi-images"></i>
                    </div>
                    <i class="bi bi-chat-left-text inline" data-id="1" href="#chat"></i>
                    <div class="reply"></div>
                </div>
                <!-- テスト用 ↑ -->

                <?php foreach($references as $reference) {
                    $r_id = $reference['reference_id'];
                ?>
                    <div class="message">
                        <?php if($signin) { ?>
                            <button class="delete" data-id="<?php print $r_id; ?>" data-name="<?php print $reference['word'] ?>">削除</button>
                        <?php } ?>
                        <div class="title">
                            <?php print $reference['word']; ?>
                        </div>

                        <div class="message-from">
                            <div class="subject_name">
                                <?php print $reference['subject_name']; ?>
                            </div>
                            <p>
                                <?php print $reference['definition']; ?>
                            </p>
                        </div>

                        <div class="attachment-last">
                            <?php if(isset($user_id) && $reference['user_id'] == $user_id && $reference['image'] != '') { ?>
                                <i class="bi bi-images"></i>
                                <img src="./reference/img/<?php print $reference['image'] ?>">
                            <?php } ?>
                        </div>

                        <?php /* 返信 */ ?>
                        <?php if ($signin) {
                                print '<i class="bi bi-chat-left-text inline" data-id="'.$r_id.'" href="#chat"></i>';

                                /* ブックマーク */
                                $class_name = 'bi bi-bookmark';
                                foreach ($bookmarks as $bookmark) {
                                    if ($r_id == $bookmark['reference_id']) {
                                        $class_name .= '-fill';
                                        break;
                                    }
                                }
                                print '<i class="' . $class_name . '" data-id="'.$r_id.'" title="ブックマーク"></i>';
                            }

                            print '<div class="reply">';
                            if (count($replys) > 0) {
                                foreach ($replys as $reply) {
                                    if ($r_id == $reply['reference_id']) {
                                        // print '<div class="new-hr"></div>';
                                        print '<div style="border: 0.6px solid #ddd;"></div>';
                                        print '<div class="mails">';
                                        // print '返信者：' . $reply['name'] . '<br>';
                                        print '<div class="mail-names">'.$reply['name'].'</div>';
                                        print '</div>';
                                        print '<div class="mail-info">';
                                        // print '返信コメ：' . $reply['comment'] . '<br>';
                                        print '<div class="comment">'.$reply['comment'].'</div>';
                                        print '</div>';
                                    }
                                }
                            }
                            print '</div>';
                        ?>
                    </div>
                <?php } ?>
            </div>

            <?php if($signin) { ?>
            <div id="add" class="inline" style="display: none;">
                <form>
                    <div class="error" style="color: red;"></div>
                    <p><label>科目</label>
                    <?php

                        $sql = 'select subject_id, subject_name from subject';
                        $stmt = $dbh->prepare($sql);
                        $stmt->execute();

                        $dbh = null;

                        print '<select name="subject">';
                        print '<option value="">-----</option>';
                        while($rec = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            print '<option value="'.$rec['subject_id'].'">'.$rec['subject_name'].'</option>';
                        }
                        print '</select>';
                        print '<br><input type="text" name="subject_name" placeholder="科目名">';
                    ?>
                    </p>
                    <p><label>用語</label>
                    <input type="text" name="word"></p>
                    <p><label>定義</label>
                    <textarea name="definition"></textarea></p>
                    <p><label>画像</label>
                    <input type="file" name="image" accept=".png"></p>
                    <input type="submit" value="作成">
                </form>
            </div>

            <div id="chat" class="inline" style="display: none;">
                <div class="modal-confirm-content" style="text-align: center;">
                    <!-- <input type="text" name="comment" style="border-bottom: 1px solid;" placeholder="返信"> -->
                    <textarea name="comment" placeholder="返信" style="width: 100%; height: 310px; resize: none; padding: 20px; border: 1px solid"></textarea>
                </div>
                <div class="modal-confirm-wrap">
                    <input type="submit" value="返信" class="modal-confirm-btn modal-ok">
                    <div class="inline_close"></div>
                </div>
            </div>
            <?php } ?>
            <?php
                /* リファレンス表示のtry文 */
                } catch (Exception $e) {
                    print '<br><h2>障害発生中</h2>';
                }
            ?>
        </main>
    </body>
</html>