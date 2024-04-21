let xa_theme ='';
$(document).ready(function() {
    console.log("XaInk Typecho Theme");

    if (localStorage.theme === "dark" || (!("theme" in localStorage) && window.matchMedia("(prefers-color-scheme: dark)").matches)) {
        xa_theme = "dark";
        toggleTheme(xa_theme);
        console.log('toggleTheme end');
    }

    $("img.lazy").lazyload();

    $('#themeToggle').on('click', function () {
        var tm = xa_theme == 'dark' ? '' : 'dark';
        toggleTheme(tm);
    });

    // 监听页面滚动事件
    $(window).scroll(function() {
        // 获取滚动位置
        var scrollPos = $(window).scrollTop();

        // 如果滚动位置大于 100，则显示返回顶部按钮，否则隐藏按钮
        if (scrollPos > 100) {
            $('#backToTop').fadeIn();
        } else {
            $('#backToTop').fadeOut();
        }
    });

    // 返回顶部按钮点击事件
    $('#backToTop').click(function() {
        // 平滑滚动到页面顶部
        $('html, body').animate({scrollTop: 0}, 'slow');
    });

    // 登录信息
    $('.xa-login').on('mouseenter', function () {
        toggleUserMenu('show');
    });
    $('.xa-login').on('mouseleave', function () {
        toggleUserMenu('hide');
    });
    $('.xa-login-menu').on('mouseenter', function () {
        toggleUserMenu('show');
    });
    $('.xa-login-menu').on('mouseleave', function () {
        toggleUserMenu('hide');
    });

    // 分类菜单
    $('.xa-categories-title').on('mouseenter', function() {
        $(this).find('.xa-categories-sub').eq(0).show();
    });
    $('.xa-categories-title').on('mouseleave', function () {
        $(this).find('.xa-categories-sub').eq(0).hide();
    });

    //移动设备菜单
    $('#mobileNavToggle').on('click',function(){
        $('aside').toggleClass('-translate-x-full');
        $('#xa-aside-mask').toggleClass('hidden');
    });
    $('#xa-aside-mask').on('click',function () {
        $('aside').toggleClass('-translate-x-full');
        $('#xa-aside-mask').toggleClass('hidden');
    });

    $('.xa-archive-year-title').on('click',function () {
        var id = "#xa-archive-year-item-"+$(this).attr("year");
        $(id).slideToggle();
    });

    //悬停右边
    $('.xa-sidebar').stickySidebar({
        topSpacing: 118,
        bottomSpacing: 40
    });

    if($('#OwO').length > 0) {
        var owo = new OwO({
            logo: '<i class="ti ti-mood-happy"></i>',
            container: document.getElementById('OwO'),
            target: document.getElementById('commentTextarea'),
            api: siteUrl + 'usr/themes/xaink/assets/js/OwO/OwO.json',
            position: 'down',
            width: '100%',
            maxHeight: '250px'
        });
    }

    if($('#postShare').length > 0) {
        $('#postShare').hover(function () {
            $('#qrcodePopup').removeClass('hidden');
        }, function () {
            $('#qrcodePopup').addClass('hidden');
        });
    }

    //sm (640px)	max-width: 640px;
    // md (768px)	max-width: 768px;
    // lg (1024px)	max-width: 1024px;

    //左悬停
    $(window).on('resize', function() {
        stickyLeftBar();
    });
    stickyLeftBar();
});

function stickyLeftBar() {
    var leftValue = $('#main-center').offset().left;
    $('.xa-left-bar').css('left',(leftValue - 128)+'px');
    $('.xa-left-bar-panel').show();
}

function toggleUserMenu(flag) {
    if(flag == 'show') {
        $('.xa-login-menu').show();
        $('.xa-login i').removeClass('ti-chevron-down').addClass('ti-chevron-up');
    }
    else {
        $('.xa-login-menu').hide();
        $('.xa-login i').removeClass('ti-chevron-up').addClass('ti-chevron-down');
    }
}


function toggleTheme(curTheme) {
    $('body').toggleClass('dark');
    $('#header').toggleClass('dark');
    $('#main').toggleClass('dark');
    $('#pager').toggleClass('dark');
    $('#footer').toggleClass('dark');
    $('button').toggleClass('dark');
    $('input').toggleClass('dark');
    $('a').toggleClass('dark');
    $('grid').toggleClass('dark');
    //需要有暗色需求的css
    $('.xa-theme').toggleClass('dark');

    if(curTheme == 'dark') {
        $('#themeToggle i').eq(0).removeClass('ti-moon').addClass('ti-sun');
    }
    else {
        $('#themeToggle i').eq(0).removeClass('ti-sun').addClass('ti-moon');
    }
    xa_theme = curTheme;
    //保存
    localStorage.theme = xa_theme;
}