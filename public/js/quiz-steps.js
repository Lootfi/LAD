$(document).ready(function () {

    var current_fs, next_fs, previous_fs;

    $(".next").click(function () {

        str1 = "next1";
        str2 = "next2";

        if (!str1.localeCompare($(this).attr('id')) && validate1(0) == true) {
            val1 = true;
        }
        else {
            val1 = false;
        }

        if (!str2.localeCompare($(this).attr('id')) && validate2(0) == true) {
            val2 = true;
        }
        else {
            val2 = false;
        }

        if ((!str1.localeCompare($(this).attr('id')) && val1 == true) || (!str2.localeCompare($(this).attr('id')) && val2 == true)) {
            current_fs = $(this).parent().parent().parent();
            next_fs = $(this).parent().parent().parent().next();

            $(current_fs).removeClass("show");
            $(next_fs).addClass("show");

            $("#progressbar li").eq($(".card").index(next_fs)).addClass("active");

            current_fs.animate({}, {
                step: function () {

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });

                    next_fs.css({
                        'display': 'block'
                    });
                }
            });
        }
    });

    $(".prev").click(function () {

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        $(current_fs).removeClass("show");
        $(previous_fs).addClass("show");

        $("#progressbar li").eq($(".card").index(next_fs)).removeClass("active");

        current_fs.animate({}, {
            step: function () {

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });

                previous_fs.css({
                    'display': 'block'
                });
            }
        });
    });

});