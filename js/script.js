//スクロールふわっと表示エフェクト
$(function() {
    $('.animation').css('visibility', 'hidden');
    $(window).scroll(function() {
        var windowHeight = $(window).height(),
            topWindow = $(window).scrollTop();
        $('.animation').each(function() {
            var targetPosition = $(this).offset().top;
            if (topWindow > targetPosition - windowHeight + 100) {
                $(this).addClass("fadeInDown");
            }
        });
    });
});

//セレクトのクリック後のギミック
$(function() {
    $('select').on('change',function() {
        $(this).css({
            'background':'none'
        });
    });
});

//テキストエリア自動改行
$(function() {
    $("#ta").height(100); //init
    $("#ta").css("lineHeight", "20px"); //init
    $("#ta").on("input", function(evt) {
        if (evt.target.scrollHeight > evt.target.offsetHeight) {
            $(evt.target).height(evt.target.scrollHeight);
        } else {
            var lineHeight = Number($(evt.target).css("lineHeight").split("px")[0]);
            while (true) {
                $(evt.target).height($(evt.target).height() - lineHeight);
                if (evt.target.scrollHeight > evt.target.offsetHeight) {
                    $(evt.target).height(evt.target.scrollHeight);
                    break;
                }
            }
        }
    });
});

//送信ボタンギミック
$(function() {
    $('input, textarea').on('keydown keyup keypress change', function() {
        if ($(this).val().length > 0) {
            $("#submit").prop("disabled", false);
            $('#submit').parent('li').removeClass('button--gray').addClass('button--orange');
        } else {
            $("#submit").prop("disabled", true);
            $('#submit').parent('li').removeClass('button--orange').addClass('button--gray');
        }
    });
});
