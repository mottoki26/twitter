<?php
    session_start();
    session_regenerate_id(true);
    $signin = false;
    if(isset($_SESSION['signin'])) {
        $signin = true;
        $user_id = $_SESSION['user_id'];
    } else {
        header('location:../');
        exit();
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
        <script src="./js/bookmark_list.js"></script>
        
    </head>
    <body class="dashboard">
        <main class="right-side">

        <!-- クラスの追加 -->
        <h1 class="title">ブックマーク一覧</h1>

        <?php
            try {
                include_once './common/dbConnection.php';

                $sql = 'select reference.reference_id, subject_name, name, word, definition, image from user, reference, subject, bookmark
                        where 1 and user.user_id = reference.user_id and reference.subject_id = subject.subject_id
                        and reference.reference_id = bookmark.reference_id and bookmark.user_id = ? order by reference_id desc';

                $stmt = $dbh->prepare($sql);
                $data[] = $user_id;
                $stmt->execute($data);

                $b_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $dbh = null;

                if(count($b_list) == 0) {
                    /* クラスの追加 */
                    print '<h1 class="book-none">現在ブックマークしているリファレンスは存在しません</h1>';
                    print '<p class="button"><label><i class="bi bi-arrow-left-square"><input type="button" value=" 戻る" onclick="history.back()"></i></label></p>';
                } else {
                    /* クラスの追加 */
                    print '<p class="button"><label><i class="bi bi-arrow-left-square"><input type="button" value=" 戻る" onclick="history.back()"></label></i></p>';
                    print '<div class="scroll-cards" style="width: auto;">';
                    $i = 0;
                    foreach ($b_list as $reference) {
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

                    print '</div>';
                }

            } catch(Exception $e) {
                print '障害発生中';
                print $e;
                exit();
            }
        ?>
        <?php
            $i = 0;
            foreach ($b_list as $rec) {
                print '<div id="detail'.$i.'" class="inline" style="display: none;">';
                $r_id = $rec['reference_id'];
            ?>
                    <div class="message active">
                        <div class="title">
                            <?php print $rec['word'] ?>
                        </div>

                        <div class="message-from">
                            <div class="subject_name">
                                <?php print $rec['subject_name'] ?>
                            </div>
                            <p>
                                <?php print $rec['definition'] ?>
                            </p>
                        </div>
                        <div class="attachment-last">
                            <?php if($rec['image'] != '') { ?>
                                <img src="./reference/img/<?php print $rec['image'] ?>">
                            <?php } ?>
                        </div>
                        <?php
                            /* ブックマーク */
                            $class_name = 'bi bi-bookmark-fill';
                            print '<i class="' . $class_name . '" data-id="'.$r_id.'" title="ブックマーク"></i>';
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