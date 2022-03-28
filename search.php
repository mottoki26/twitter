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
        <link rel="stylesheet" href="./css/bookmark_list.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SNS風単語帳</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="./js/modal.min.js"></script>
        <script src="./js/search.js"></script>
        
    </head>
    <body class="dashboard">
        <main class="right-side">
            <h1 class="title">検索結果一覧</h1>
            <div class="scroll-cards" style="width: auto;">
            <?php
                try {
                    require_once './common/common.php';

                    $post = sanitize($_POST);
                    $search = $post['search'];

                    if($search != '') {
                        $search = '%'.$search.'%';
                    }

                    include_once './common/dbConnection.php';

                    $sql = 'select reference_id, us.user_id, rf.user_id, name, subject_name, word, definition, image
                            from user us, subject sb, reference rf
                            where rf.user_id = us.user_id and rf.subject_id = sb.subject_id and (word like :search or subject_name like :search)
                            order by reference_id desc';
                    
                    $stmt = $dbh->prepare($sql);
                    $data[':search'] = $search;
                    $stmt->execute($data);
    
                    /* リファレンス情報を連想配列で取得 */
                    $references = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if($signin) {
                        $data = array();

                        /* ブックマーク情報のSQL実行 */
                        $sql = 'select reference_id, user_id from bookmark where user_id = ?';
                        $stmt = $dbh->prepare($sql);
                        $data[] = $user_id;
                        $stmt->execute($data);

                        /* ブックマーク情報を連想配列で取得 */
                        $bookmarks = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    }

                    $dbh = null;

                    if(count($references) == 0) {
                        print '<h1 class="book-none">検索結果は0件です</h1>';
                        print '<p class="button"><label><i class="bi bi-arrow-left-square"><input type="button" value=" 戻る" onclick="history.back()"></i></label></p>';
                    } else {
                        print '<p class="button"><label><i class="bi bi-arrow-left-square"><input type="button" value=" 戻る" onclick="history.back()"></label></i></p>';
                        print '<div class="scroll-cards" style="width: auto;">';
                        $i = 0;
                        foreach ($references as $reference) {
                            $r_id = $reference['reference_id'];
                        ?>
                            <div class="card inline" href="#detail<?php print $i ?>">
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
                        <?php
                            $i++;
                        }
                    }
                    print '</div>';

                } catch (Exception $e) {
                    print '障害発生中';
                    print $e;
                    exit();
                }
            ?>
            <?php
                $i = 0;
                foreach ($references as $reference) {
                    print '<div id="detail'.$i.'" class="inline" style="display: none;">';
                    $r_id = $reference['reference_id'];
                ?>
                        <div class="message active">
                            <div class="title">
                                <?php print $reference['word'] ?>
                            </div>

                            <div class="message-from">
                                <div class="subject_name">
                                    <?php print $reference['subject_name'] ?>
                                </div>
                                <p>
                                    <?php print $reference['definition'] ?>
                                </p>
                            </div>
                            <div class="attachment-last">
                                <?php if($reference['image'] != '') { ?>
                                    <img src="./reference/img/<?php print $reference['image'] ?>">
                                <?php } ?>
                            </div>
                            <?php
                                if ($signin) {
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
                            ?>
                        </div>
                    </div>
                    <?php
                    $i++;
                }
                    ?>
        </main>
    </body>
</html>