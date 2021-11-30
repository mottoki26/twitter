/// <Reference path="./jquery-3.6.0.min.js"/>

$(function() {
    var bookmarks = $('.bi-bookmark');
    var bookmark_fills = $('.bi-bookmark-fill');
    /* for (var i = 0; i < bookmarks.length; i++) {
        bookmark(bookmarks[i], i);
        // bookmarks[i].addEventListener('click', bookmark());
    }

    for (var i = 0; i < bookmark_fills.length; i++) {
        bookmark(bookmark_fills[i], i);
        // bookmark_fills[i].addEventListener('click', bookmark());
    } */

    function bookmark(book_dom) {
        book_dom.addEventListener('click', function() {
            $.ajax({
                    url: "./bookmark.php",
                    type: "GET",
                    data: {
                        r_id: this.dataset.id,
                    },
                })
                .done(function() {
                    console.log('done');
                    book_dom.classList.toggle('bi-bookmark');
                    book_dom.classList.toggle('bi-bookmark-fill');
                })
                .fail(function() {
                    console.log('fail');
                });
        });
    }
});