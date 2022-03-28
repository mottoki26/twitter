<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SNS風単語帳</title>
    </head>
    <body>
        <main>
            <?php
                try {
                    require_once '../common/common.php';

                    $post = sanitize($_POST);

                    $mail = $post['mail'];
                    $name = $post['name'];
                    $pass = $post['pass'];
                    $pass2 = $post['pass2'];

                    $flg = false;

                    // メールアドレスの判定
                    if($mail == '') {
                        print 'メールアドレスが入力されていません。<br>';
                        $flg = true;
                    } else if(!preg_match('/\A[\w\-\.]+@[\w\-\.]+\.([a-z]+)\z/', $mail)) {   //メールアドレスの構文ミス判定
                        print 'メールアドレスを正確に入力してください。<br>';
                        $flg = true;
                    }

                    // ユーザ名の判定
                    if($name == '') {
                        print 'ユーザ名が入力されていません。<br>';
                        $flg = true;
                    }

                    if($pass == '') {
                        print 'パスワードが入力されていません。<br>';
                        $flg = true;
                    }

                    if($pass != $pass2) {
                        print 'パスワードが違います。<br>';
                        $flg = true;
                    }

                    if($flg){
                        print '<form>';
                        print '<input type="button" onclick="history.back()" value="戻る">';
                        print '</form>';
                    }else{

                        print '<form method="post" action="./signupDone.php">';
                        print '<input type="hidden" name="mail" value="'.$mail.'">';
                        print '<input type="hidden" name="name" value="'.$name.'">';
                        print '<input type="hidden" name="pass" value="'.$pass.'">';
                        print '<br>';
                        print '<script>';
                        print 'document.forms[0].submit()';
                        print '</script>';
                        print '</form>';
                        
                    }

                } catch (Exception $e) {
                    print '障害発生中';
                    
                    exit();
                }
            ?>
        </main>
    </body>
</html>