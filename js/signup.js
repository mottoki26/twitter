/// <Reference path="./jquery-3.6.0.min.js" />

$(function() {
    let forms = $('form');
    let error = $('.error');

    let mail = $('input[name="mail"]')[0];
    let name = $('input[name="name"]')[0];
    let pass = $('input[name="pass"]')[0];
    let pass2 = $('input[name="pass2"]')[0];

    let flg = true;
    clickable();

    mail.addEventListener('focusout', function(e) {
        let val = e.target.value;
        if (val.match(/^[\w\-\.]+@[\w\-\.]+\.([a-z]+)$/) != null) {
            this.style.borderColor = 'lawngreen';
            flg = false;
        } else {
            this.style.borderColor = 'red';
            flg = true;
        }
        clickable();
    });

    name.addEventListener('focusout', function(e) {
        if (e.target.value != '') {
            this.style.borderColor = 'lawngreen';
            flg = false;
        } else {
            this.style.borderColor = 'red';
            flg = true;
        }
        clickable();
    });

    pass.addEventListener('focusout', function(e) {
        if (e.target.value != '') {
            this.style.borderColor = 'lawngreen';
            flg = false;
        } else {
            this.style.borderColor = 'red';
            flg = true;
        }
        clickable();
    })

    pass2.addEventListener('focusout', function(e) {
        if (pass.value != '' && e.target.value == pass.value) {
            this.style.borderColor = 'lawngreen';
            flg = false;
        } else {
            this.style.borderColor = 'red';
            flg = true;
        }
        clickable();
    })

    function clickable() {
        forms.find(':submit').prop('disabled', flg);
    }

    forms.on('submit', function() {
        let mail_val = mail.value;
        let name_val = name.value;
        let pass_val = pass.value;

        $.ajax({
                url: './signupDone.php',
                type: 'POST',
                data: {
                    mail: mail_val,
                    name: name_val,
                    pass: pass_val,
                },
                dataType: 'json'
            })
            .done(function(data) {
                switch (data.status) {
                    case 'OK':
                        window.location = "../";
                        break;

                    case 'SERVER_ERROR':
                        log('ユーザを作成できませんでした');
                        break;
                }
            })
            .fail(function(XMLHttpRequest, status, e) {
                console.log(e);
            })
        return false;
    });

    function log(message) {
        error[0].innerHTML = '<p>' + message + '</p>';
    }
})