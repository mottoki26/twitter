<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <!-- <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
        <title>Twitter</title>
    </head>
    <body>
        <main>
            <?php
                require_once './common/common.php';

                if($_POST != []) {
                    try {
                        require_once './common/common.php';

                        $post = sanitize($_POST);
                        $item = $post['item'];
                        $search = $post['search'];

                        if($search != '') {
                            $search = '%'.$search.'%';
                        }

                        include_once './common/dbConnection.php';

                        // $sql = 'select word, definition, subject_name, name from user, reference, subject
                        //         where 1 and user.user_id = reference.user_id and reference.subject_id = subject.subject_id';

                        $sql = 'select name, subject_name, word, definition
                                from user us, subject sb, reference rf
                                where rf.user_id = us.user_id and rf.subject_id = sb.subject_id ';
                        
                        switch($item) {
                            /* 特定のユーザのリファレンス表示 */
                            case 'user':
                                $sql .= 'and name like ?';
                                break;

                            case 'subject':
                                /* 特定の科目のリファレンス表示 */
                                // $sql = 'select subject_name from subject where subject_name like ?';
                                $sql .= 'and subject_name like ?';
                                break;

                            case 'reference':
                                /* 特定の用語のリファレンス表示 */
                                // $sql = 'select word from reference where word like ?';
                                $sql .= 'and word like ?';
                                break;
                            
                            case 'reply':
                                /* 特定の返信コメントのリファレンス表示 */
                                $sql = 'select comment from reply where comment like ?';
                                break;
                        }
                        
                        $stmt = $dbh->prepare($sql);
                        $data[] = $search;
                        $stmt->execute($data);
        
                        $dbh = null;
        
                        /* リファレンス情報を連想配列で取得 */
                        $recs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                        if(count($recs) == 0) {
                            print '検索対象のものはありません。';
                        } else {
                            foreach($recs as $rec) {
                                print '名前：'.$rec['name'];
                                print '<br>';
                                print '科目名：'.$rec['subject_name'];
                                print '<br>';
                                print '用語：'.$rec['word'];
                                print '<br>';
                                print '定義：'.$rec['definition'];
                                print '<br>';
                            }
                        }

                        print '<p><input type="button" value="戻る" onclick="history.back()"></p>';

                    } catch (Exception $e) {
                        print '障害発生中';
                        exit();
                    }
                } else {
            ?>
            <br>
            <!-- <script>
                $(function() {
                    var words = [
                        "ActionScript",
                        "AppleScript",
                        "Asp",
                        "BASIC",
                        "C",
                        "C++",
                        "Clojure",
                        "COBOL",
                        "ColdFusion",
                        "Erlang",
                        "Fortran",
                        "Groovy",
                        "Haskell",
                        "Java",
                        "JavaScript",
                        "Lisp",
                        "Perl",
                        "PHP",
                        "Python",
                        "Ruby",
                        "Scala",
                        "Scheme",
                        ];
                        $( "#keyword" ).autocomplete({
                            source: words,
                        });
                    });
            </script>

            任意の英字を入力すると入力候補が表示されます（部分一致）<br>
            <input id="keyword"> -->

            <form action="" method="post">
                <select name="item">
                    <option value="user">ユーザ名</option>
                    <option value="subject">科目名</option>
                    <option value="reference">リファレンス</option>
                    <!-- <option value="reply">返信</option> -->
                </select>
                <p><label>
                    <input type="search" name="search">
                </label></p>
                <input type="button" value="戻る" onclick="history.back()">
                <input type="submit" value="検索">
            </form>
            <?php } ?>
        </main>
    </body>
</html>