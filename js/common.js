/// <Reference path="./jquery-3.6.0.min.js"/>

$(function() {

    var cards = $('.card');
    var message = $('.message');
    var icons = $('.folder-icons');
    var compose = $('.compose');
    var menu = $('.menu');
    var nav = $('.navigation');

    var logout_btn, search_btn;
    for (var i = 0; i < cards.length; i++) {
        cardAction(cards[i], i);
    };

    for (var i = 0; i < icons.length; i++) {
        if (icons[i].children.length == 2) {
            var icon = icons[i].children[1];
            if (icon.classList.contains('icon-name') || icon.classList.contains('icon-name1')) {
                if (icon.textContent == 'Search') {
                    search_btn = icons[i];
                } else if (icon.textContent == 'log out') {
                    logout_btn = icons[i];
                }
            }
        }
    }

    menu[0].addEventListener('click', function() {
        nav[0].classList.toggle('active');
    });

    compose[0].addEventListener('click', function() {
        window.location.href = './reference/addWord.php';
    });

    search_btn.addEventListener('click', function() {
        window.location.href = './search.php';
    });

    logout_btn.addEventListener('click', function() {
        window.location.href = './user/logout.php';
    });

    function cardAction(cardDOM, cardId) {
        // 各ボタンをイベントリスナーに登録
        cardDOM.addEventListener("click", function() {
            // activeクラスの追加と削除
            // thisは、クリックされたオブジェクト
            this.classList.toggle('active');

            // クリックされていないボタンにactiveがついていたら外す
            for (var i = 0; i < cards.length; i++) {
                if (cardId !== i) {
                    if (cards[i].classList.contains('active')) {
                        cards[i].classList.remove('active');
                    }
                }
            }

            for (var i = 0; i < message.length; i++) {
                if (cardId !== i) {
                    if (message[i].classList.contains('active')) {
                        message[i].classList.remove('active');
                    }
                } else {
                    message[i].classList.toggle('active');
                }
            }
        })
    };
});