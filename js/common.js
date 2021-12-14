/// <Reference path="./jquery-3.6.0.min.js"/>
/// <Reference path="./modal.min.js"/>"

$(function() {

    let cards = $('.card');
    let messages = $('.message');
    let icons = $('.folder-icons');
    let menu = $('.menu');
    let nav = $('.navigation');

    let flg_ot = false;

    let signup_btn, signin_btn, signout_btn, list_btn, home_btn;

    /* scroll-cardsクラス内のcardクラスのクリックを動的に取得する */
    $('.scroll-cards').on('click', '.card', function() {
        for (let i = 0; i < cards.length; i++) {
            if (this == cards[i]) {
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
        }
    });

    for (let i = 0; i < icons.length; i++) {
        if (icons[i].children.length == 2) {
            let icon = icons[i].children[1];
            if (icon.classList.contains('icon-name')) {
                switch (icon.textContent) {
                    case 'Signout':
                        signout_btn = icons[i];
                        break;

                    case 'Signup':
                        signup_btn = icons[i];
                        break;

                    case 'Signin':
                        signin_btn = icons[i];
                        break;

                    case 'Bookmark':
                        list_btn = icons[i];
                        break;

                    case 'Home':
                        home_btn = icons[i];
                        break;
                }
            }
        }
    }

    menu[0].addEventListener('click', function() {
        $(nav[0]).animate({ 'width': 'toggle' });
    });

    if (list_btn != null) {
        list_btn.addEventListener('click', function() {
            trans('./bookmark_list.php');
        });
    }

    if (home_btn != null) {
        home_btn.addEventListener('click', function() {
            trans('./');
        })
    }

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

    if (signout_btn != null) {
        signout_btn.addEventListener('click', function() {
            trans('./user/logout.php');
        });
    }

    /* 引数のURLに遷移する */
    function trans(url) {
        setTimeout(window.location = url, 250);
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

        if (subject_id == '' || subject_name == '') {
            flg = true;
        }

        if (word == '') {
            flg = true;
        }

        if (image_name != '' && image_name.match(/.png$/) == null) {
            flg = true;
        }

        return flg;
    }

    add_form.on('submit', function() {
        let form = new FormData(add_form[0]);
        let error = $('.modal-content-container>form>div.error');

        if (formCheck(form)) {

            /* データの送信 */
            $.ajax({
                    url: './reference/addWordCheck.php',
                    type: 'POST',
                    data: form,
                    dataType: 'json',
                    processData: false,
                    contentType: false
                })
                .done(function(data) {

                    if (data.status != 'SERVER_ERROR') {
                        addCard(form, data);
                        add_form[0].reset();

                        /* モーダルウィンドウを閉じる */
                        $('#modal-close')[0].click();
                        $(".inline").modal();

                        error[0].innerHTML = '';
                    } else {
                        error[0].innerHTML = '科目または用語を入力してください';
                    }
                })
                .fail(function(XMLHttpRequest, status, e) {
                    error[0].innerHTML = '科目または用語を入力してください';
                });

            /* テスト用 */
            // data = {
            //     name: 'test',
            //     r_id: 1,
            //     subject_name: 'ネットワーク',
            //     subject: 1,
            //     subject_id: 5
            // }
            // addCard(form, data);
            // add_form[0].reset();
            // $(".inline").modal();
        }

        /* submitボタンの無効化 */
        return false;
    });

    /* cardクラスとmessageクラスの追加 */
    function addCard(form, data) {

        let word = htmlspecialchars(form.get('word'));
        let definition = htmlspecialchars(form.get('definition'));
        let image = form.get('image');
        let image_name = htmlspecialchars(image['name']);

        let name = data.name;
        let r_id = data.r_id;
        let subject = data.subject_name;

        /* 概要画面の入力 */
        let cards_parent = cards.parent();
        cards_parent.prepend('<div class="card"></div>');

        /* 要素の更新 */
        cards = $('.card');
        let card_child = cards_parent.children();
        card_child = card_child[0];

        $(card_child).append(Array(
            '<div class="mails"><div class="mail-names">' + name + '</div></div>',
            '<div class="mail-info"><p>' + subject + '</p>' + word + '</div>',
            '<div></div>',
        ));

        /* 詳細画面の入力 */
        let ri_body = messages[0].parentElement;

        /* HTMLタグが追加できるようにjQueryに変換 */
        ri_body = $(ri_body);

        /* 詳細画面の入力 */
        $(messages[0]).before('<div class="message"></div>');
        messages = $('.message');
        let message_child = ri_body.children();
        message_child = message_child[1];

        $(message_child).append(Array(
            '<button class="delete" data-id="' + r_id + '" data-name="' + word + '">削除</button>',
            '<button class="edit inline" style="float: right;" data-id="' + r_id + '" href="#edit">編集</button>',
            '<div class="title">' + word + '</div>',
            '<div class="message-from"><div class="subject_name">' + subject + '</div><p>' + definition + '</p>',
            '</div>',
            '<div class="attachment-last">' + (image_name == '' ? '' : '<img src="./reference/img/' + image_name + '">'),
            '</div>',
            '<i class="bi bi-chat-left-text inline" data-id="' + r_id + '" href="#chat"></i>',
            '<i class="bi bi-bookmark" data-id="' + r_id + '" title="ブックマーク"></i>',
            '<div class="reply"></div>',
        ));

        /* 追加項目の科目追加 */
        if (typeof data.subject != 'undefined') {
            $('select[name="subject"]')
                .append('<option value="' + data.subject_id + '">' + subject + '</option>');
        }
    }

    let edit_form = $('#edit>form');
    $('.right-body').on('click', '.edit', function() {

        let parent = this.parentElement;
        let r_id = this.dataset.id;
        let error = $('.modal-content-container>form>div.error');

        edit_form.find('input[name="r_id"]').val(r_id);

        /* 科目の選択 */
        let options = edit_form.children('p').children('select[name="subject"]');
        // console.log(options.children());
        for (let i = 0; i < options.children().length; i++) {
            if (options.children()[i].innerText == parent.querySelector('.subject_name').innerText) {
                let sub_val = options.children()[i].value;
                options.val(sub_val);
                break;
            }
        }

        /* 用語の設定 */
        let word = parent.querySelector('.title').innerText;
        edit_form.children('p').children('input[name="word"]').val(word);
        // console.log(word.innerText);

        /* 定義の設定 */
        let definition = parent.querySelector('.message-from').querySelector('p').innerText;
        // console.log(definition);
        edit_form.find('textarea[name="definition"]').val(definition);

        /* 画像名の設定 */
        let img = parent.querySelector('.attachment-last').children;
        edit_form.find('input[name="old_image"]').val('');
        if (img.length != 0) {
            let img_split = img[0].src.split('/');
            let img_name = img_split[img_split.length - 1];
            // console.log(img_name);
            edit_form.find('input[name="old_image"]').val(img_name);
        }

        let form;
        edit_form.on('submit', function() {
            form = new FormData(edit_form[0]);
            // console.log(...form.entries());

            $.ajax({
                    url: './reference/editWordDone.php',
                    type: 'POST',
                    data: form,
                    dataType: 'json',
                    processData: false,
                    contentType: false
                })
                .done(function(data) {
                    editCard(data);
                })
                .fail(function(XMLHttpRequest, status, e) {
                    console.log(XMLHttpRequest.responseText);
                })

            /* モーダルウィンドウを閉じる */
            $('#modal-close')[0].click();
            error[0].innerHTML = '';
            return false;
        })

        /* cardとmessageの書き換え */
        function editCard(data) {
            let mail_info, subject_name;
            for (let i = 0; i < messages.length; i++) {
                if (parent == messages[i]) {
                    // console.log(parent == messages[i]);
                    // console.log(cards[i].children[1].innerHTML);
                    mail_info = cards[i].children[1];
                    // console.log(typeof data.subject_name);
                    // console.log((typeof data.subject_name == 'undefined'));

                    /* 新規じゃなければプルダウンから取得 */
                    if (typeof data.subject == 'undefined') {
                        for (let i = 0; i < options.children().length; i++) {
                            if (options.children()[i].value == options.val()) {
                                // console.log(subject_val);
                                subject_name = options.children()[i].innerText;
                                break;
                            }
                        }
                    } else {
                        subject_name = data.subject_name;
                    }
                    // console.log(mail_info);
                    // console.log(subject_name);

                    /* cardの書き換え */
                    mail_info.innerHTML = '<p>' + subject_name + '</p>';
                    mail_info.innerHTML += form.get('word');
                    // console.log(cards[i]);

                    /* messageの書き換え */
                    messages[i].querySelector('.title').innerText = form.get('word');
                    let message_from = messages[i].querySelector('.message-from');
                    message_from.querySelector('.subject_name').innerText = subject_name;
                    message_from.querySelector('p').innerText = form.get('definition');
                    if (form.get('image')['name'] != '') {
                        if (messages[i].querySelector('img') == null) {
                            $(messages[i]).find('.attachment-last').append(
                                '<img src="./reference/img/' + form.get('image')['name'] + '">'
                            )
                        } else {
                            messages[i].querySelector('img').src = './reference/img/' + form.get('image')['name'];
                        }
                    }
                    break;
                }
            }
        }

        let flg = false;
        $('.modal-inline').on('click', function() {
            if (!flg) {
                closeModal();
            }
        });

        $('.modal-container').on('click', function() {
            flg = true;
        });

        $(window).keydown(function(e) {
            if (e.key == 'Escape') {
                closeModal();
            }
        });

        function closeModal() {
            setTimeout(() => {
                edit_form[0].reset();
            }, 300);
        }
    });

    let chats = $('div[id="chat"]>div[class="modal-confirm-wrap"]');

    /* 返信処理 */
    $(document).on('click', '.bi-chat-left-text', function() {

        let comment = $('textarea[name="comment"]');

        /* クリックされたオブジェクトの代入 */
        let chat = this;

        /* 返信ボタンが押されたときに呼び出される */
        chats.children('input[type="submit"]').on('click', function() {
            let comment_val = htmlspecialchars(comment.val());

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
    $('.right-body').on('click', 'button[class=delete]', function() {
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

    function htmlspecialchars(str) {
        return (str + '').replace(/&/g, '&amp;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');
    }
});