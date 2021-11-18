<?php
    session_start();
    session_regenerate_id(true);
    $user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Twitter</title>
    </head>
    <body>
        <main>
            <form action="./checkWord.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="<?php print $user_id ?>">
                <p><label>
                    一言：
                    <input type="text" name="word">
                </label></p>
                <p><label>
                    画像：
                    <input type="file" name="image" accept=".png,.gif">
                </label></p>
                <input type="button" value="戻る" onclick="history.back()">
                <input type="submit" value="ツイート">
            </form>
        </main>
    </body>
</html>