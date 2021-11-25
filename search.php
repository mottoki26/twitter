<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Twitter</title>
    </head>
    <body>
        <main>
            <?php
                print_r($_GET);
                $data = array();
                /* header('Content-type: text/html'); */
                $data[] = array(
                    'id' => 'test',
                );
                $data[] = array(
                    'id' => 'test2',
                );
                header('Content-type: application/json');
                print json_encode(['data' => $data], JSON_UNESCAPED_UNICODE);
            ?>
        </main>
    </body>
</html>