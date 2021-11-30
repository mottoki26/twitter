/// <Reference path="./jquery-3.6.0.min.js"/>

$(function() {
    function bookmark(book_dom) {
        book_dom.addEventListener('click', function() {
            flg_ot = true;
            $.ajax({
                    url: "./bookmark.php",
                    type: "GET",
                    data: {
                        r_id: this.dataset.id,
                    },
                })
                .done(function() {
                    book_dom.classList.toggle('bi-bookmark');
                    book_dom.classList.toggle('bi-bookmark-fill');
                })
                .fail(function() {

                });
        });
    };
})