/// <Reference path="./jquery-3.6.0.min.js"/>
/// <Reference path="./modaal.min.js"/>"

$(function() {

    let cards = $('.card');
    let message = $('.message');
    let icons = $('.folder-icons');
    let compose = $('.compose');
    let menu = $('.menu');
    let nav = $('.navigation');

    /* ブックマークボタン */
    let bookmarks = $('.bi-bookmark');
    let bookmark_fills = $('.bi-bookmark-fill');

    /* 返信ボタン */
    let chat_text = $('.bi-chat-left-text');

    /* 返信 */
    let reply = $('.reply');

    let flg_ot = false;

    let signup_btn, signin_btn, logout_btn, search_btn;

    /* cardクラスのクリック判定 */
    for (let i = 0; i < cards.length; i++) {
        cardAction(cards[i], i);
    };

    for (let i = 0; i < icons.length; i++) {
        if (icons[i].children.length == 2) {
            let icon = icons[i].children[1];
            if (icon.classList.contains('icon-name') /*  || icon.classList.contains('icon-name1') */ ) {
                switch (icon.textContent) {
                    case 'Search':
                        search_btn = icons[i];
                        break;

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

    /* for (let i = 0; i < bookmarks.length; i++) {
        bookmark(bookmarks[i]);
    }

    for (let i = 0; i < bookmark_fills.length; i++) {
        bookmark(bookmark_fills[i]);
    } */

    bookmarks.on('click', bookmark);
    bookmark_fills.on('click', bookmark);

    menu[0].addEventListener('click', function() {
        $(nav[0]).animate({ 'width': 'toggle' });
    });

    compose[0].addEventListener('click', function() {
        trans('./reference/addWord.php');
    });

    search_btn.addEventListener('click', function() {
        trans('./search.php');
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

    function cardAction(cardDOM, cardId) {
        // 各ボタンをイベントリスナーに登録
        cardDOM.addEventListener("click", function() {
            // activeクラスの追加と削除
            if (!clickCheck()) {
                // thisは、クリックされたオブジェクト
                this.classList.toggle('active');

                // クリックされていないボタンにactiveがついていたら外す
                for (let i = 0; i < cards.length; i++) {
                    if (cardId !== i) {
                        if (cards[i].classList.contains('active')) {
                            cards[i].classList.remove('active');
                        }
                    }
                }

                for (let i = 0; i < message.length; i++) {
                    if (cardId !== i) {
                        if (message[i].classList.contains('active')) {
                            message[i].classList.remove('active');
                        }
                    } else {
                        message[i].classList.toggle('active');
                    }
                }
            }
        });
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
                console.log('fail');
            });
    }

    $('.test').modaal({
        type: 'confirm',
        confirm_title: '', //確認画面タイトル
        confirm_button_text: '返信', //確認画面ボタンのテキスト
        confirm_cancel_button_text: 'キャンセル', //確認画面キャンセルボタンのテキスト
        confirm_content: '<input type="text" name="comment">', //確認画面の内容
    });

    $('.test').on('click', function() {
        let reply = $('input[name="comment"]');
        reply.css('border-bottom', '1px solid')
        $('button[aria-label="Confirm"]').on('click', function() {
            console.log($('input[name="comment"]').val())
        })
    })


    chat_text.on('click', function() {
        // let pop = prompt('返信');
        /* for (let i = 0; i < chat_text.length; i++) {
            if (chat_text[i] == this) {
                console.log(chat_text[i])
                reply.prepend('<input type="text" name="comment">');
            }
        } */

        let pop = false
        if (pop) {
            $.ajax({
                    url: "./reply/addCheckReply.php",
                    type: "POST",
                    data: {
                        r_id: this.dataset.id,
                        comment: pop,
                    },
                })
                .done(function() {
                    console.log('done');
                })
                .fail(function() {

                });
        }
    });
});