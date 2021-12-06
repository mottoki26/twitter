/// <Reference path="./jquery-3.6.0.min.js"/>

$(function() {
    let form = $('form');
    let error = $('.error');
    form.on('submit', function() {

        /* メールの値取得 */
        let mail = $('input[name="mail"]').val();
        let pass = $('input[name="pass"]').val();

        if (!mail) {
            log('メールアドレスを入力してください');
        } else {
            $.ajax({
                    url: './signinCheck.php',
                    type: 'POST',
                    data: {
                        'mail': mail,
                        'pass': pass
                    },
                    dataType: 'json'
                })
                /*  */
                .done(function(data) {
                    switch (data.status) {
                        case 'OK':
                            window.location.href = '../';
                            break;

                        case 'ERROR':
                            log('メールアドレス又はパスワード違います');
                            break;

                        case 'SERVER_ERROR':
                            log('障害発生中');
                            break;
                    }
                    console.log(data);
                })
                /*  */
                .fail(function(XMLHttpRequest, status, e) {
                    log(e);
                });
        }

        return false;
    })

    function log(message) {
        error[0].innerHTML = '<p>' + message + '</p>';
    }
})