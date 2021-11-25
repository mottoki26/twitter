<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <title>Twitter</title>
    </head>
    <body>
        <main>
            <?php
                /* print_r($_GET);
                $data = array();
                /* header('Content-type: text/html'); *
                $data[] = array(
                    'id' => 'test',
                );
                $data[] = array(
                    'id' => 'test2',
                );
                header('Content-type: application/json');
                print json_encode(['data' => $data], JSON_UNESCAPED_UNICODE); */
            ?>
            <script>
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
            <input id="keyword">
        </main>
    </body>
</html>