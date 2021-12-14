/// <Reference path="./jquery-3.6.0.min.js"/>

$(function() {
    /* ブックマークボタン */

    let options = $('option');
    let cards = $('.card');
    let messages = $('.message');


    /* ブックマーク解除 */
    $('.message').on('click', '.bi-bookmark-fill', bookmark);

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

                for (let i = 0; i < messages.length; i++) {
                    if (messages[i] == book_dom.parentNode) {
                        cards[i].remove();
                        messages[i].parentNode.remove();
                        $('#modal-close')[0].click();
                        break;
                    }
                }
                book_dom.parentNode.remove();
            })
            .fail(function() {

            });
    }

    /* モーダルウィンドウ */
    $(".inline").modal();
})