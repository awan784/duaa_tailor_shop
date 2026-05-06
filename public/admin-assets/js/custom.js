(function($) {
    "use strict";

    $(window).on('scroll', function() {
        var scroll = $(window).scrollTop();
        if (scroll < 400) {
            $('#back-top').fadeOut(500);
        } else {
            $('#back-top').fadeIn(500);
        }
    });

    $('#back-top a').on("click", function() {
        $('body,html').animate({ scrollTop: 0 }, 1000);
        return false;
    });

    // Remove metisMenu related code
    // $("#sidebar_menu").metisMenu();
    // $("#admin_profile_active").metisMenu();
    
    $(".sidebar_icon").on('click', function() {
        $('.sidebar').toggleClass('active_sidebar');
    });

    $('.sidebar_close_icon i').on('click', function() {
        $('.sidebar').removeClass('active_sidebar');
    });

    $('.troggle_icon').on('click', function() {
        $('.setting_navbar_bar').toggleClass('active_menu');
    });

    $(".custom_select").click(function() {
        $(this).toggleClass('active');
        $('.custom_select.active').not(this).removeClass('active');
    });

    $(document).click(function(event) {
        if (!$(event.target).closest(".custom_select").length) {
            $("body").find(".custom_select").removeClass("active");
        }
    });

    $(document).click(function(event) {
        if (!$(event.target).closest(".sidebar_icon, .sidebar").length) {
            $("body").find(".sidebar").removeClass("active_sidebar");
        }
    });

    $("#checkAll").click(function() {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    var summerNote = $('#summernote');
    if (summerNote.length) {
        summerNote.summernote({
            placeholder: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            tabsize: 2,
            height: 305
        });
    }

    $('.input-file').each(function() {
        var $input = $(this),
            $label = $input.next('.js-labelFile'),
            labelVal = $label.html();
        $input.on('change', function(element) {
            var fileName = '';
            if (element.target.value) {
                fileName = element.target.value.split('\\').pop();
            }
            fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label.removeClass('has-file').html(labelVal);
        });
    });

    var bootstrapTag = $("#meta_keywords");
    if (bootstrapTag.length) {
        bootstrapTag.tagsinput();
    }

    if ($('.lms_table_active').length) {
        var table = $('.lms_table_active').DataTable({
            bLengthChange: false,
            "bDestroy": true,
            language: {
                search: "<i class='ti-search'></i>",
                searchPlaceholder: 'Quick Search',
                paginate: {
                    next: "<i class='ti-arrow-right'></i>",
                    previous: "<i class='ti-arrow-left'></i>"
                }
            },
            columnDefs: [{ visible: false }],
            responsive: true,
            searching: true,
        });
        $('#customSearchDataTable').on('keyup', function() {
            console.log(table);
            table.search(this.value).draw();
        });
    }

    if ($('.lms_table_active2').length) {
        $('.lms_table_active2').DataTable({
            bLengthChange: false,
            "bDestroy": false,
            language: {
                search: "<i class='ti-search'></i>",
                searchPlaceholder: 'Quick Search',
                paginate: {
                    next: "<i class='ti-arrow-right'></i>",
                    previous: "<i class='ti-arrow-left'></i>"
                }
            },
            columnDefs: [{ visible: false }],
            responsive: true,
            searching: false,
            info: false,
            paging: false
        });
    }

    $('.layout_style').click(function() {
        $(this).toggleClass('layout_style_selected');
        $('.layout_style.layout_style_selected').not(this).removeClass('layout_style_selected');
    });

    $('.switcher_wrap li.Horizontal').click(function() {
        $('.sidebar').addClass('hide_vertical_menu');
        $('.main_content ').addClass('main_content_padding_hide');
        $('.horizontal_menu').addClass('horizontal_menu_active');
        $('.main_content_iner').addClass('main_content_iner_padding');
        $('.footer_part').addClass('pl-0');
    });

    $('.switcher_wrap li.vertical').click(function() {
        $('.sidebar').removeClass('hide_vertical_menu');
        $('.main_content ').removeClass('main_content_padding_hide');
        $('.horizontal_menu').removeClass('horizontal_menu_active');
        $('.main_content_iner').removeClass('main_content_iner_padding');
        $('.footer_part').removeClass('pl-0');
    });

    $('.switcher_wrap li').click(function() {
        $('li').removeClass("active");
        $(this).addClass("active");
    });

    $('.custom_lms_choose li').click(function() {
        $('li').removeClass("selected_lang");
        $(this).addClass("selected_lang");
    });

    $('.spin_icon_clicker').on('click', function(e) {
        $('.switcher_slide_wrapper').toggleClass("swith_show");
        e.preventDefault();
    });

    $(document).ready(function() {
        $(".pCard_add").click(function() {
            $(".pCard_card").toggleClass("pCard_on");
            $(".pCard_add i").toggleClass("fa-minus");
        });
    });
}(jQuery));
