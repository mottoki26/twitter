function samp(e) {
    $.ajax({
            url: './bookmark.php',
            type: 'GET',
            async: true,
            data: {
                reference_id: e.value
            },
            /* success: function(data) {
                console.log('OK');
                console.log(data);
            },
            error: function(e) {
                console.log('fail');
                console.log(e);
            } */
        })
        .done(function() {
            console.log('done');
        })
        .fail(function(e) {
            console.log('fail');
        });
};
$(function() {
    $('#btn').on('click', function() {
        console.log(this);
        $.ajax({
            type: "GET",
            url: "./bookmark.php",
            async: true,
            data: {
                r_id: this.value
            }
        }).
        done(function() {
            console.log(this);
        }).
        fail(function() {

        });
    });
});