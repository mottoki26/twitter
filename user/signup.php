<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/reset.css">
        <link rel="stylesheet" href="../css/signin.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Twitter</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="../js/signup.js"></script>
    </head>
    <body>
        <main>
            <h1>サインアップページ</h1>
            <div class="error" style="color: red; margin-bottom: 15px"></div>
            <form method="post">
                <p><label>メールアドレス</label>
                <input type="text" name="mail" required></p>
                <p><label>ユーザ名</label>
                <input type="text" name="name" required></p>
                <p><label>パスワード</label>
                <input type="password" name="pass" required></p>
                <p><label>パスワード(再入力)</label>
                <input type="password" name="pass2" required></p>
                <input type="button" value="戻る" onclick="history.back()">
                <input type="submit" value="サインアップ">
            </form>
        </main>
    </body>
</html>