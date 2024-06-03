let xa_theme ='';
$(document).ready(function() {
    console.log("%cXaInk Typecho Theme By XiaoA", "color:#fff; background: linear-gradient(270deg, #986fee, #8695e6, #68b7dd, #18d7d3); padding: 8px 15px; border-radius: 0 15px 0 15px");

    if (localStorage.theme === "dark" || (!("theme" in localStorage) && window.matchMedia("(prefers-color-scheme: dark)").matches)) {
        xa_theme = "dark";
        toggleTheme(xa_theme);
        console.log('toggleTheme end');
    }

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

    //如果文章则生成导读
    if($('#xa-post-content').length > 0 && $('#xa-toc').length > 0) {
        const outline = new Outline({
            // 文章显示区域的 DOM 元素或者选择器字符串
            articleElement: '#xa-post-content',
            // 要收集的标题选择器
            selector: 'h1,h2,h3,h4,h5,h6',
            // 负责文章区域滚动的元素
            // String 类型 - 选择器字符串，默认值：html,body（window窗口）
            // HTMLElement 类型 - DOM 元素
            scrollElement: 'html,body',
            title: false,
            stickyHeight: 75,
            // 文章导读菜单的位置
            // relative - （默认值）创建独立的侧滑菜单
            // sticky - 导航菜单将以 sticky 模式布局（需要确保菜单插入位置支持 sticky 模式布局）
            // fixed - 导航菜单将以 fixed 模式布局，会自动监听滚动位置，模拟 sticky 布局
            // sticky 和 fixed 布局时，需要设置 parentElement
            // 2.0.0 暂时不支持在文章开始位置插入 chapters 导航菜单
            position: 'sticky',
            // 设置 position: relative 时，placment 定义侧滑菜单和 toolbar 导航位置：
            // rtl - 菜单位置在窗口右侧，滑动动画为：right to left
            // ltr - 菜单位置在窗口左侧，滑动动画为：left to right
            // ttb - 菜单位置在窗口上方，滑动动画为：top to bottom
            // btt - 菜单位置在窗口下方，滑动动画为：bottom to top
            placement: '',
            // 导航菜单将要插入的位置（DOM 元素）
            // String 类型 - 选择器字符串
            // HTMLElement 类型 - 插入的 DOM 元素
            // 仅在 position 设置为 sticky 和 fixed 布局时有效
            parentElement: '#xa-toc',
            // 是否显示段落章节编号
            showCode: false,
            animationCurrent: false,
            hasToolbar: false,
            // 标题图标链接的 URL 地址
            // （默认）没有设置定制，点击链接页面滚动到标题位置
            // 设置了链接地址，则不会滚动定位
            anchorURL: '',
            // DIYer的福利
            // 独立侧滑菜单时，customClass 会追加到 drawer 侧滑窗口组件
            // 在文章中显示导航菜单时，customClass 会追加到 chapters 导航菜单
            customClass: ''
        });
    }

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

    //图片加载放到最后
    $("img.lazy").lazyload();
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