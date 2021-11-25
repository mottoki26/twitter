/// <Reference path="./jquery-3.6.0.min.js"/>

$(function() {
    var cards = $('.card');
    for (var i = 0; i < cards.length; i++) {
        cardAction(cards[i], i);
    };

    function cardAction(cardDOM, cardId) {
        // activeクラスの追加と削除
        // cardDOMは、クリックされたオブジェクト
        cardDOM.addEventListener("click", function() {
            this.classList.toggle('active');

            // クリックされていないボタンにactiveがついていたら外す
            for (var i = 0; i < cards.length; i++) {
                if (cardId !== i) {
                    if (cards[i].classList.contains('active')) {
                        cards[i].classList.remove('active');
                    }
                }
            }
        });
    }
});