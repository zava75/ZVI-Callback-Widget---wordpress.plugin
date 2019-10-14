// console.log('js-front');
jQuery(document).ready(function ($) {
    // Проверка Name
    if (document.getElementById('name')) {
        var inputName = document.getElementById('name');
        inputName.onkeyup = function () {
            this.value = this.value.replace(/[^а-яa-zА-ЯA-Z\ ]/g, '')
        };
    }
    // Проверка Phone
    if (document.getElementById('tel')) {
        var inputTel = document.getElementById('tel');
        inputTel.onkeyup = function () {
            this.value = this.value.replace(/[^0-9\-+]/g, '')
        };
    }
    // button callback toggle
    setInterval(function() {
        $(".img-circl-text").toggleClass("show");
        $(".img-circl").toggleClass("hide");
    },5000);
    // pop up window callback
    var modal = $('.callback_popup'),
        overlay = $('.callback_overlay'),
        link = $('#callback_button'),
        close = $('.callback_close-btn');

    close.click(function (e) {
        modal.toggleClass('callback_popup_active');
        overlay.hide();
        link.show();
    });
    link.on('click', function (e) {
        e.preventDefault();
        link.hide();
        overlay.show();
        modal.toggleClass('callback_popup_active');
    });
    //E-mail Ajax Send
    $("#callback_form").submit(function (e) { //Change
        $("#zviform").hide();
        $(".callback_overlay").css(
            {"background": "#101010 url(/wp-content/plugins/zvi-callback-widget/img/preloader.gif) no-repeat center center"}
        );
        var name = $("input[name='name']").val(),
            url = $("input[name='url']").val(),
            tel = $("input[name='tel']").val();
        $.ajax({
            type: "POST",
            url: zviCallback.url ,
            data: {
                name: name,
                tel: tel,
                url: url,
                action: 'zvi_callback_post',
                security: zviCallback.nonce
            },
            beforeSend: function(){
              // выполняется перед запросом
            },
            success: function (result) {
               // console.log(result);
                if(result && result != 0){
                   document.location  = result;
                } else alert('Ошибка отправки');
            },
            error: function () {
                alert('errors');
            }
        });
        e.preventDefault();
    });
});