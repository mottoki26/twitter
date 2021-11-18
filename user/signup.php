<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Twitter</title>
    </head>
    <body>
        <h1>サインアップページ</h1>
        <form action="./signupCheck.php" method="post">
            <p><label>メールアドレス</label>
            <input type="email" name="mail" required></p>
            <p><label>ユーザ名</label>
            <input type="text" name="name" required></p>
            <p><label>パスワード</label>
            <input type="password" name="pass" required></p>
            <p><label>パスワード(再入力)</label>
            <input type="password" name="pass2" required></p>
            <input type="button" value="戻る" onclick="history.back()">
            <input type="submit" value="サインアップ">
        </form>
    </body>
</html>