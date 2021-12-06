/// <Reference path="./jquery-3.6.0.min.js"/>
/// <Reference path="./modal.min.js"/>"

$(function() {

    let cards = $('.card');
    let messages = $('.message');
    let icons = $('.folder-icons');
    let menu = $('.menu');
    let nav = $('.navigation');

    let flg_ot = false;

    let signup_btn, signin_btn, logout_btn;

    /* cardクラスにクリック判定の追加 */
    // for (let i = 0; i < cards.length; i++) {
    //     card(cards[i], i);
    // };

    // function card(dom, i) {
    //     dom.addEventListener('click', function() {
    //         if (!clickCheck()) {
    //             // thisは、クリックされたオブジェクト
    //             this.classList.toggle('active');

    //             // クリックされていないボタンにactiveがついていたら外す
    //             for (let j = 0; j < cards.length; j++) {
    //                 if (i !== j) {
    //                     if (cards[j].classList.contains('active')) {
    //                         cards[j].classList.remove('active');
    //                     }
    //                 }
    //             }

    //             for (let j = 0; j < messages.length; j++) {
    //                 if (i !== j) {
    //                     if (messages[j].classList.contains('active')) {
    //                         messages[j].classList.remove('active');
    //                     }
    //                 } else {
    //                     messages[j].classList.toggle('active');
    //                 }
    //             }
    //         }
    //     })
    // }

    /* scroll-cardsクラス内のcardクラスのクリックを動的に取得する */
    $('.scroll-cards').on('click', '.card', function() {
        cards = $('.card');
        messages = $('.message');
        for (let i = 0; i < cards.length; i++) {
            if (this == cards[i]) {
                if (!clickCheck()) {
                    this.classList.toggle('active');

                    for (let j = 0; j < cards.length; j++) {
                        if (i !== j) {
                            if (cards[j].classList.contains('active')) {
                                cards[j].classList.remove('active');
                            }
                        }
                    }

                    for (let j = 0; j < messages.length; j++) {
                        if (i !== j) {
                            if (messages[j].classList.contains('active')) {
                                messages[j].classList.remove('active');
                            }
                        } else {
                            messages[j].classList.toggle('active');
                        }
                    }
                }
                break;
            }
        }
    });

    for (let i = 1; i < icons.length; i++) {
        if (icons[i].children.length == 2) {
            let icon = icons[i].children[1];
            if (icon.classList.contains('icon-name')) {
                switch (icon.textContent) {
                    case 'Logout':
                        logout_btn = icons[i];
                        break;

                    case 'Signup':
                        signup_btn = icons[i];
                        break;

                    case 'Signin':
                        signin_btn = icons[i];
                        break;
                }
            }
        }
    }

    menu[0].addEventListener('click', function() {
        $(nav[0]).animate({ 'width': 'toggle' });
    });

    if (signup_btn != null) {
        signup_btn.addEventListener('click', function() {
            trans('./user/signup.php');
        });
    }

    if (signin_btn != null) {
        signin_btn.addEventListener('click', function() {
            trans('./user/signin.php');
        });
    }

    if (logout_btn != null) {
        logout_btn.addEventListener('click', function() {
            trans('./user/logout.php');
        });
    }

    /* 引数のURLに遷移する */
    function trans(url) {
        setTimeout(window.location.href = url, 250);
    }

    /* 押されたものがcardクラスかそれ以外かを判定 */
    function clickCheck() {
        if (flg_ot) {
            flg_ot = false;
            return true;
        }
        flg_ot = false;

        return false;
    }

    /* ブックマークボタン */
    // let bookmarks = $('.bi-bookmark');
    // let bookmark_fills = $('.bi-bookmark-fill');

    // bookmarks.on('click', bookmark);
    // bookmark_fills.on('click', bookmark);

    $('.right-body').on('click', '.bi-bookmark', bookmark);
    $('.right-body').on('click', '.bi-bookmark-fill', bookmark);

    function bookmark() {
        flg_ot = true;
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

    /* モーダルウィンドウ */
    $(".inline").modal();

    /* 追加画面要素の取得 */
    let add_form = $('#add>form');

    const formCheck = (form) => {
        let flg = false;

        let subject_id = form.get('subject');
        let subject_name = form.get('subject_name');
        let word = form.get('word');
        let definition = form.get('definition');
        let image = form.get('image');
        let image_name = image['name'];

        if (subject_id == '' && subject_name == '') {
            flg = true;
        }

        if (word == '') {
            flg = true;
        }

        return flg;
    }

    add_form.on('submit', function() {
        let form = new FormData(add_form[0]);
        let error = $('.modal-content-container>form>div.error');

        if (formCheck(form)) {
            error.append('科目または用語を入力してください');
            return false;
        }

        /* データの送信 */
        // $.ajax({
        //         url: './reference/addWordCheck2.php',
        //         type: 'POST',
        //         data: form,
        //         dataType: 'json',
        //         processData: false,
        //         contentType: false
        //     })
        //     .done(function(data) {
        //         console.log(data);
        //         addCard(form, data);
        //         cards = $('.card');
        //         messages = $('.message');
        //         setTimeout(() => {
        //             let child = $('.scroll-cards').children()
        //                 // child[child.length - 1];
        //             cardAction(child[child.length - 1], child.length - 1);

        //             /* for (let i = 0; i < child.length; i++) {
        //                 $('.scroll-cards').chi
        //             } */
        //             let i = cards.length - 1;
        //             console.log(i);
        //             cardAction(cards[i], i);
        //         }, 300);
        //     })
        //     .fail(function(XMLHttpRequest, status, e) {
        //         console.log(e);
        //         console.log(XMLHttpRequest);
        //     })

        data = {
            name: 'test',
            r_id: 1,
            subject_name: 'セキュリティ',
        }

        addCard(form, data);

        /* モーダルウィンドウを閉じる */
        $('#modal-close')[0].click();

        /* submitボタンの無効化 */
        return false;
    });

    function addCard(form, data) {

        let word = form.get('word');
        let definition = form.get('definition');
        let image = form.get('image');
        let image_name = image['name'];

        let name = data.name;
        let r_id = data.r_id;
        let subject = data.subject_name;

        /* 概要画面の入力 */
        let cards_parent = cards.parent();
        cards_parent.append('<div class="card"></div>');
        let card_child = cards_parent.children();
        card_child = card_child[card_child.length - 1];
        $(card_child).append(Array(
            '<div class="mails"><div class="mail-names">' + name + '</div></div>',
            '<div class="mail-info"><p>' + subject + '</p>' + word + '</div>',
            '<div></div>',
        ));

        /* 詳細画面の入力 */
        let ri_body = messages[0].parentElement;

        /* HTMLタグが追加できるようにjQueryに変換 */
        ri_body = $(ri_body);

        ri_body.append('<div class="message"></div>');
        let message_child = ri_body.children();
        message_child = message_child[message_child.length - 1];

        $(message_child).append(Array(
            '<button class="delete" data-id="' + r_id + '">削除</button>',
            '<div class="title">' + word + '</div>',
            '<div class="message-from"><div class="subject_name">' + subject + '</div><p>' + definition + '</p>',
            '</div>',
            '<div class="attachment-last">' + (image_name == '' ? '' : '<i class="bi bi-images"></i><img src="./reference/img/' + image_name + '">'),
            '</div>',
            '<i class="bi bi-chat-left-text inline" data-id="' + r_id + '" href="#chat"></i>',
            '<i class="bi bi-bookmark" data-id="' + r_id + '" title="ブックマーク"></i>',
            '<div class="reply"></div>',
        ))

        // cards = $('.card');
        // messages = $('.message');
        // let i = cards.length - 1;
        // card(cards[i], i);

        /* ブックマークボタン */
        // bookmarks = $('.bi-bookmark');

        // bookmarks[bookmarks.length - 1].addEventListener('click', bookmark);
        // chat_text = $('.bi-chat-left-text');
    }

    /* 返信ボタン */
    let chat_text = $('.bi-chat-left-text');

    /* 返信ボタンの親の取得 */
    let chats = $('div[id="chat"]>div[class="modal-confirm-wrap"]');

    chat_text.on('click', function() {

        let comment = $('textarea[name="comment"]');

        /* クリックされたオブジェクトの代入 */
        let chat = this;

        /* 返信ボタンが押されたときに呼び出される */
        chats.children('input[type="submit"]').on('click', function() {
            let comment_val = comment.val();

            chats.find(':submit').prop('disabled', true);
            setTimeout(() => {
                chats.find(':submit').prop('disabled', false);
            }, 500)

            /* 空文字の場合はfalseになる */
            if (comment_val) {
                $.ajax({
                        url: './reply/addReplyDone.php',
                        type: 'POST',
                        data: {
                            r_id: chat.dataset.id,
                            comment: comment_val,
                        },
                        dataType: 'json'
                    })
                    .done(function(data) {
                        if (data.status == 'OK') {
                            let message = chat.parentElement;
                            let reply = $(message).children('.reply');
                            reply.append(Array(
                                '<div style="border: 0.6px solid #ddd;"></div>',
                                '<div class="mails">',
                                '<div class="mail-names">' + data.name + '</div>',
                                '</div>',
                                '<div class="mail-info">' + comment_val + '</div>',
                            ));
                        }
                    });
            }
        });

        /* テキストエリアの初期化 */
        setTimeout(function() { comment.val(''); }, 100)
    });

    /* 削除処理 */
    let delete_btn = $('.delete');

    delete_btn.on('click', function() {
        let message = this.parentElement;
        let del_flg = confirm(this.dataset.name + 'を削除しますか？');
        if (del_flg) {
            $.ajax({
                    url: './reference/deleteWordDone.php',
                    type: 'POST',
                    data: {
                        r_id: this.dataset.id,
                    }
                })
                .done(function() {
                    for (let i = 0; i < messages.length; i++) {
                        if (messages[i] == message) {
                            cards[i].remove();
                            message.remove();
                            break;
                        }
                    }
                })
                .fail(function() {

                })
        }
    })
});