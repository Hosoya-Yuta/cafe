$(document).ready(function() {
    // ヘッダー固定
    $(window).on('scroll', function() {
        if($(this).scrollTop() > 57) {
            $('.nav').addClass('is-fixed');
        } else {
            $('.nav').removeClass('is-fixed');
        }
    })

    // メニューのスクロール
    var intro_pos = $(".photo").offset().top;
    var experience_pos = $(".bg_black").offset().top;
    
    $("#intro").on('click', function() {
        $("html").animate({scrollTop: intro_pos}, 600);
    })
    $("#experience").on('click', function() {
        $("html").animate({scrollTop: experience_pos}, 600);
    })

    // Jump To Topの処理
    $(window).on('scroll', function() {
        if($(this).scrollTop() > 500) {
            $('.jump').addClass('active');
        } else {
            $('.jump').removeClass('active');
        }
    })
    
    $('.jump').on('click', function() {
        $('html, body').animate({
            scrollTop: 0
        }, 600)
    });
    
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


})