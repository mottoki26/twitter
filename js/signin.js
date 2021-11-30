/// <Reference path="./jquery-3.6.0.min.js"/>

$(function() {
    let form = $('form');
    form.on('submit', function(e) {

        let error = $('.error');

        /* メールの値取得 */
        let mail = $('input[name="mail"]').val();
        let pass = $('input[name="pass"]').val();

        /* $.ajax({
                url: './signinCheck.php',
                type: 'POST',
                data: {
                    'mail': mail,
                    'pass': pass
                },
                dataType: 'json'
            })
            .done(function(data) {
                console.log(data.error);
            })
            .fail(function(XMLHttpRequest, status, e) {
                console.log(status)
                alert(e)
            }); */

        console.log(form)
        console.log(form[0])
        form.prepend('<h1>Hello</h1>');
        return false;
    })
})