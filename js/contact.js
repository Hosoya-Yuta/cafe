$(document).ready(function() {
    // サインイン　オープンモーダル
    var signin = $('.signin');
    var overlay = $('#overlay');
    var signin_box = $('.signin_box');

    signin.on('click', function() {
        overlay.css('display', 'block');
        signin_box.addClass('active');
    })
    overlay.on('click', function() {
        overlay.css('display', 'none');
        signin_box.removeClass('active');
    })

    // バリデーション

    // - 氏名 → 空チェック、10文字以内(半角、全角区別なし)
    // - フリガナ → 空チェック、10文字以内(半角、全角区別なし)
    // - 電話番号 → 数字(0-9)かどうか
    // - メールアドレス → 空チェック、メールアドレス(xxx@xxx)かどうか 
    // - お問い合わせ内容 → 空チェック(確認画面で改行を読み込むこと)
    $('#contact_form').validate({
        rules: {
            name: {
                required: true,
                maxlength: 10,
            },
            kana: {
                required: true,
                maxlength: 10,
            },
            tel: {
                number: true,
            },
            email: {
                required: true,
                email: true,
            },
            body: {
                required: true,
            }
        },
    });

    $('.contact_box button').on('click', function() {
        var result = $('#contact_form').valid();
        if(result == false) {
            alert("氏名は必須入力です。10文字以内でご入力ください。\nフリガナは必須入力です。10文字以内でご入力ください。\n電話番号は0-9の数字のみでご入力ください。\nメールアドレスは正しくご入力ください。\nお問い合わせ内容は必須入力です。");
        }
    })

    // リロードするとフォーム内容がクリアになる
    if(window.performance.navigation.type == 1) {
        $('#name').val("");
        $('#kana').val("");
        $('#tel').val("");
        $('#email').val("");
        $('#body').val("");
    }
});