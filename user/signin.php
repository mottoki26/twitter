<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/reset.css">
        <link rel="stylesheet" href="../css/signin.css">
        <!-- <link rel="stylesheet" href="../css/style.css"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <!-- <script src="../js/signin.js"></script> -->
        <title>Twitter</title>
    </head>
    <body>
        <main>
            <h1>サインインページ</h1>
            <form action="./signinCheck.php" method="post">
                <p><label>メールアドレス</label>
                <input type="text" name="mail"></p>
                <p><label>パスワード</label>
                <input type="password" name="pass"></p>
                <input type="button" value="戻る" onclick="history.back()">
                <input type="submit" value="サインイン">
            </form>
        </main>
    </body>
</html>