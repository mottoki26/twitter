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

        <!-- モーダルウィンドウ -->
        <link rel="stylesheet" href="./css/modal_reset.css">
        <link rel="stylesheet" href="./css/modal.min.css">
        <link rel="stylesheet" href="./css/modal.css">

        <link rel="stylesheet" href="./css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SNS風単語帳</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="./js/modal.min.js"></script>
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
                        <div class="icon-name">Create</div>
                    </div>

                    <div class="folder-icons">
                        <div class="icon">
                            <i class="bi bi-book"></i>
                        </div>
                        <div class="icon-name">Bookmark</div>
                    </div>
                    <?php } ?>

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
                            <div class="icon-name">Signout</div>
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

                    <?php /* ?>
                    <div class="pro">
                        <a href="profile/profile.html" target="_blank">チームのプロフィール</a>
                    </div>
                    <?php */ ?>
                </div>
            </div>
        </div>
        
        <main class="right-side">
            <div class="right-header">
                <div class="top-bar">
                    <div class="top-bar-justify">
                        <div class="big-inbox">
                            Home
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
                            <input class="text" type="search" placeholder="検索" name="search" onsubmit="this.value=''">
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
                            where 1 and user.user_id = reference.user_id and reference.subject_id = subject.subject_id order by reference.reference_id desc';
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute();

                    /* リファレンス情報を連想配列でデータ取得 */
                    $references = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

                        $sql = 'select subject_id, subject_name from subject';
                        $stmt = $dbh->prepare($sql);
                        $stmt->execute();

                        $dbh = null;

                        $subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    }

                /* リファレンス表示のtry文 */
                } catch (Exception $e) {
                    print '<br><h2>障害発生中</h2>';
                    print ($e);
                    exit();
                }
            ?>
            <br>
            <div class="right-body">
                <?php
                if (count($references) == 0) {
                    print '<br><h1>現在リファレンスはありません</h1>';
                } else {
                ?>
                <div class="scroll-cards">
                    
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
                        </div>
                    <?php } ?>
                </div>
                <?php } ?>
                <?php /* リファレンス表示終了 */ ?>

                <?php foreach($references as $reference) {
                    $r_id = $reference['reference_id'];
                ?>
                    <div class="message">
                        <?php if($signin && $_SESSION['name'] == $reference['name']) { ?>
                            <button class="delete" data-id="<?php print $r_id; ?>" data-name="<?php print $reference['word'] ?>">削除</button>
                            <button class="edit inline" data-id="<?php print $r_id; ?>" href="#edit">編集</button>
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
                            <?php if($reference['image'] != '') { ?>
                                <img src="./reference/img/<?php print $reference['image'] ?>">
                            <?php } ?>
                        </div>

                        <?php /* アイコン */ ?>
                        <?php
                            if ($signin) {
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

                            /* 返信 */
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
            <div id="add" class="inline hide-area">
                <form method="post" class="create-form">
                    <div class="error" style="color: red;"></div>
                    <p class="item"><label class="item-label">科目</label>
                    <?php
                        print '<select name="subject">';
                        print '<option value="">-----------</option>';
                        foreach ($subjects as $rec) {
                            print '<option value="'.$rec['subject_id'].'">'.$rec['subject_name'].'</option>';
                        }
                        print '</select>';
                        print '<br><input type="text" name="subject_name" placeholder="科目名">';
                    ?>
                    </p>
                    <p class="item"><label>用語</label>
                    <input type="text" name="word"></p>
                    <p class="item-text"><label>定義</label><br>
                    <textarea name="definition"></textarea></p>
                    <p class="item-img"><label>画像</label>
                    <input type="file" name="image" accept=".png"></p>
                    <input type="submit" value="作成" class="create_a">
                </form>
            </div>

            <div id="edit" class="inline hide-area">
                <form method="post" class="create-form">
                    <div class="error" style="color: red;"></div>
                    <input type="hidden" name="r_id">
                    <p class="item"><label class="item-label">科目</label>
                    <?php
                        print '<select name="subject">';
                        print '<option value="">-----------</option>';
                        foreach ($subjects as $rec) {
                            print '<option value="'.$rec['subject_id'].'">'.$rec['subject_name'].'</option>';
                        }
                        print '</select>';
                        print '<br><input type="text" name="subject_name" placeholder="科目名">';
                    ?>
                    </p>
                    <p class="item"><label>用語</label>
                    <input type="text" name="word"></p>
                    <p class="item-text"><label>定義</label><br>
                    <textarea name="definition"></textarea></p>
                    <input type="hidden" name="old_image">
                    <p class="item-img"><label>画像</label>
                    <input type="file" name="image" accept=".png"></p>
                    <input type="submit" value="編集" class="create_a">
                </form>
            </div>

            <div id="chat" class="inline hide-area">
                <div class="modal-confirm-content" style="text-align: center;">
                    <textarea name="comment" placeholder="返信" style="width: 100%; height: 310px; resize: none; padding: 20px; border: 1px solid"></textarea>
                </div>
                <div class="modal-confirm-wrap">
                    <input type="submit" value="返信" class="modal-confirm-btn modal-ok">
                    <div class="inline_close"></div>
                </div>
            </div>
            <?php } ?>
        </main>
        
        <script src="./js/common.js"></script>
        <script src="./js/bookmark.js"></script>
    </body>
</html>