/// <Reference path="./jquery-3.6.0.min.js"/>

$(function() {

    /* ブックマークボタン */
    $('.right-body').on('click', '.bi-bookmark', bookmark);
    $('.right-body').on('click', '.bi-bookmark-fill', bookmark);

    function bookmark() {
        book_dom = this;
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
    }
})