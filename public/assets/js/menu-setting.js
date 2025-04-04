"use strict";
$(document).ready(function() {
    // =========================================================
    // =========    Menu Customizer [ HTML ] code   ============
    // =========================================================
    $('body').append('' +
        '<div id="styleSelector" class="menu-styler">' +
            '<div class="style-toggler">' +
                '<a href="#!"></a>' +
            '</div>' +
            '<div class="style-block">' +
                '<h4 class="mb-2">Able-pro <small class="font-weight-normal">v8.0 Customizer</small></h4>' +
                '<hr class="">' +
                '<div class="m-style-scroller">' +
                    '<h6 class="mt-2">Layouts</h6>' +
                    '<div class="theme-color layout-type">' +
                        '<a href="#!" class="" data-value="menu-dark" title="Default Layout"><span></span><span></span></a>' +
                        '<a href="#!" class="active" data-value="menu-light" title="Light"><span></span><span></span></a>' +
                        '<a href="#!" class="" data-value="dark" title="Dark"><span></span><span></span></a>' +
                        '<a href="#!" class="" data-value="reset" title="Reset">Reset</a>' +
                    '</div>' +
                    '<h6>background color</h6>' +
                    '<div class="theme-color background-color flat">' +
                        '<a href="#!" class="active" data-value="background-blue"><span></span><span></span></a>' +
                        '<a href="#!" class="" data-value="background-red"><span></span><span></span></a>' +
                        '<a href="#!" class="" data-value="background-purple"><span></span><span></span></a>' +
                        '<a href="#!" class="" data-value="background-info"><span></span><span></span></a>' +
                        '<a href="#!" class="" data-value="background-green"><span></span><span></span></a>' +
                        '<a href="#!" class="" data-value="background-dark"><span></span><span></span></a>' +
                    '</div>' +
                    '<h6>background Gradient</h6>' +
                    '<div class="theme-color background-color gradient">' +
                        '<a href="#!" class="" data-value="background-grd-blue"><span></span><span></span></a>' +
                        '<a href="#!" class="" data-value="background-grd-red"><span></span><span></span></a>' +
                        '<a href="#!" class="" data-value="background-grd-purple"><span></span><span></span></a>' +
                        '<a href="#!" class="" data-value="background-grd-info"><span></span><span></span></a>' +
                        '<a href="#!" class="" data-value="background-grd-green"><span></span><span></span></a>' +
                        '<a href="#!" class="" data-value="background-grd-dark"><span></span><span></span></a>' +
                    '</div>' +
                    '<h6>background Image</h6>' +
                    '<div class="theme-color background-color image">' +
                        '<a href="#!" class="" data-value="background-img-1"><span></span><span></span></a>' +
                        '<a href="#!" class="" data-value="background-img-2"><span></span><span></span></a>' +
                        '<a href="#!" class="" data-value="background-img-3"><span></span><span></span></a>' +
                        '<a href="#!" class="" data-value="background-img-4"><span></span><span></span></a>' +
                        '<a href="#!" class="" data-value="background-img-5"><span></span><span></span></a>' +
                        '<a href="#!" class="" data-value="background-img-6"><span></span><span></span></a>' +
                    '</div>' +
                    '<div class="form-group mb-2">' +
                        '<div class="switch switch-primary d-inline m-r-10">' +
                            '<input type="checkbox" id="theme-rtl">' +
                            '<label for="theme-rtl" class="cr"></label>' +
                        '</div>' +
                        '<label>RTL</label>' +
                    '</div>' +
                    '<div class="form-group mb-2">' +
                        '<div class="switch switch-primary d-inline m-r-10">' +
                            '<input type="checkbox" id="menu-fixed" checked>' +
                            '<label for="menu-fixed" class="cr"></label>' +
                        '</div>' +
                        '<label>Sidebar Fixed</label>' +
                    '</div>' +
                    '<div class="form-group mb-2">' +
                        '<div class="switch switch-primary d-inline m-r-10">' +
                            '<input type="checkbox" id="header-fixed" checked>' +
                            '<label for="header-fixed" class="cr"></label>' +
                        '</div>' +
                        '<label>Header Fixed</label>' +
                    '</div>' +
                    '<div class="form-group mb-2">' +
                        '<div class="switch switch-primary d-inline m-r-10">' +
                            '<input type="checkbox" id="box-layouts">' +
                            '<label for="box-layouts" class="cr"></label>' +
                        '</div>' +
                        '<label>Box Layouts</label>' +
                    '</div>' +
                    '<div class="form-group mb-2">' +
                        '<div class="switch switch-primary d-inline m-r-10">' +
                            '<input type="checkbox" id="breadcumb-layouts">' +
                            '<label for="breadcumb-layouts" class="cr"></label>' +
                        '</div>' +
                        '<label>Breadcumb sticky</label>' +
                    '</div>' +
                '</div>' +
            '</div>' +
        '</div>');
    setTimeout(function() {
        $('.m-style-scroller').css({'height':'calc(100vh - 335px)','position':'relative'});
        var px = new PerfectScrollbar('.m-style-scroller', {
            wheelSpeed: .5,
            swipeEasing: 0,
            suppressScrollX: !0,
            wheelPropagation: 1,
            minScrollbarLength: 40,
        });
    }, 400);
    // =========================================================
    // ==================    Menu Customizer Start   ===========
    // =========================================================
    // open Menu Styler
    $('#styleSelector > .style-toggler').on('click', function() {
        $('#styleSelector').toggleClass('open');
        $('#styleSelector').removeClass('prebuild-open');
    });
    // layout types
    $('.layout-type > a').on('click', function() {
        var temp = $(this).attr('data-value');
        $('.layout-type > a').removeClass('active');
        $('.pcoded-navbar').removeClassPrefix('navbar-image-');
        $(this).addClass('active');
        $('head').append('<link rel="stylesheet" class="layout-css" href="">');
        if (temp == "menu-dark") {
            $('.pcoded-navbar').removeClassPrefix('menu-');
            $('.pcoded-navbar').removeClass('navbar-dark');
        }
        if (temp == "menu-light") {
            $('.pcoded-navbar').removeClassPrefix('menu-');
            $('.pcoded-navbar').removeClass('navbar-dark');
            $('.pcoded-navbar').addClass(temp);
        }
        if (temp == "reset") {
            location.reload();
        }
        if (temp == "dark") {
            $('.pcoded-navbar').removeClassPrefix('menu-');
            $('.pcoded-navbar').addClass('navbar-dark');
            $('.layout-css').attr("href", "assets/css/layout-dark.css");
        } else {
            $('.layout-css').attr("href", "");
        }
    });
    // background Color
    $('.background-color.flat > a').on('click', function() {
        var temp = $(this).attr('data-value');
        $('.background-color > a').removeClass('active');
        $('.pcoded-header').removeClassPrefix('brand-');
        $(this).addClass('active');
        if (temp == "background-default") {
            $('.pcoded-header').removeClassPrefix('header-');
        } else {
            $('.pcoded-header').removeClassPrefix('header-');
            $('.pcoded-header').addClass('header-'+ temp.slice(11, temp.length));
            $('body').removeClassPrefix('background-');
            $('body').addClass('background-'+ temp.slice(11, temp.length));
        }
    });
    // background Color outher
    $('.background-color.gradient > a').on('click', function() {
        var temp = $(this).attr('data-value');
        $('.background-color > a').removeClass('active');
        $('.pcoded-header').removeClassPrefix('brand-');
        $(this).addClass('active');
        if (temp == "background-default") {
        } else {
            $('body').removeClassPrefix('background-');
            $('body').addClass('background-'+ temp.slice(11, temp.length));
        }
    });
    // background Color outher
    $('.background-color.image > a').on('click', function() {
        var temp = $(this).attr('data-value');
        $('.background-color > a').removeClass('active');
        $('.pcoded-header').removeClassPrefix('brand-');
        $(this).addClass('active');
        if (temp == "background-default") {
        } else {
            $('body').removeClassPrefix('background-');
            $('body').addClass('background-'+ temp.slice(11, temp.length));
        }
    });
    // rtl layouts
    $('#theme-rtl').change(function() {
        $('head').append('<link rel="stylesheet" class="rtl-css" href="">');
        if ($(this).is(":checked")) {
            $('.rtl-css').attr("href", "assets/css/layout-rtl.css");
        } else {
            $('.rtl-css').attr("href", "");
        }
    });
    // Menu Fixed
    $('#menu-fixed').change(function() {
        if ($(this).is(":checked")) {
            $('.pcoded-navbar').addClass('menupos-fixed');
            setTimeout(function() {
                // $(".navbar-content").css({'overflow':'visible','height':'calc(100% - 70px)'});
            }, 400);
        } else {
            $('.pcoded-navbar').removeClass('menupos-fixed');
        }
    });
    // Header Fixed
    $('#header-fixed').change(function() {
        if ($(this).is(":checked")) {
            $('.pcoded-header').addClass('headerpos-fixed');
        } else {
            $('.pcoded-header').removeClass('headerpos-fixed');
        }
    });
    // breadcumb sicky
    $('#breadcumb-layouts').change(function() {
        if ($(this).is(":checked")) {
            $('.page-header').addClass('breadcumb-sticky');
        } else {
            $('.page-header').removeClass('breadcumb-sticky');
        }
    });
    // Box layouts
    $('#box-layouts').change(function() {
        if ($(this).is(":checked")) {
            $('body').addClass('container');
            $('body').addClass('box-layout');
        } else {
            $('body').removeClass('container');
            $('body').removeClass('box-layout');
        }
    });
    $.fn.removeClassPrefix = function(prefix) {
        this.each(function(i, it) {
            var classes = it.className.split(" ").map(function(item) {
                return item.indexOf(prefix) === 0 ? "" : item;
            });
            it.className = classes.join(" ");
        });
        return this;
    };
    // ==================    Menu Customizer End   =============
    // =========================================================
});
