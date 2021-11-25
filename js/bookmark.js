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
        .done(function(data) {
            console.log(data);
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        });
}