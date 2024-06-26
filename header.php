<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php if ($this->is("index")): ?>
        <meta property="og:type" content="blog"/>
        <meta property="og:url" content="<?php $this->options->siteUrl(); ?>"/>
        <meta property="og:title" content="<?php $this->options->title(); ?>"/>
        <meta property="og:author" content="<?php $this->author->name(); ?>"/>
        <meta name="keywords" content="<?php $this->keywords(); ?>">
        <meta name="description" content="<?php $this->options->description(); ?>">
    <?php endif; ?>
    <?php if ($this->is("post") || $this->is("page") || $this->is("attachment")): ?>
        <meta property="og:url" content="<?php $this->permalink(); ?>"/>
        <meta property="og:title" content="<?php $this->title(); ?> - <?php $this->options->title(); ?>"/>
        <meta property="og:author" content="<?php $this->author(); ?>"/>
        <meta property="og:type" content="article"/>
        <meta property="article:published_time" content="<?php $this->date("c"); ?>"/>
        <meta property="article:published_first" content="<?php $this->options->title(); ?>, <?php $this->permalink(); ?>"/>
        <meta name="keywords" content="<?php
        $k = $this->fields->keyword;
        if (empty($k)) {
            echo $this->keywords();
        } else {
            echo $k;
        }
        ?>">
        <meta name="description" content="<?php
        $d = $this->fields->description;
        if (empty($d) || !$this->is("single")) {
            if ($this->getDescription()) {
                echo $this->getDescription();
            }
        } else {
            echo $d;
        }
        ?>"/>
    <?php endif; ?>
    <title><?php
        $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?><?php if($this->_currentPage>1) echo ' - 第 '.$this->_currentPage.' 页 '; ?></title>
    <link rel="shoucut icon" href="<?php $this->options->siteUrl . "favicon.ico" ?>">
    <?php $this->header("description=&generator=&pingback=&template=&xmlrpc=&wlw=&commentReply=&keywords="); ?>
    <link rel="preload" href="<?php $this->options->themeUrl("assets/css/fonts/tabler-icons.woff2") ?>" as="font" type="font/woff2" crossorigin />
    <link href="<?php $this->options->themeUrl("assets/css/tailwind.min.css?v=" . xaGetVersion()); ?>" rel="stylesheet" />
    <link href="<?php $this->options->themeUrl("assets/css/tabler-icons.min.css"); ?>" rel="stylesheet"/>
    <link href="<?php $this->options->themeUrl("assets/js/OwO/OwO.min.css?v=" . xaGetVersion()); ?>" rel="stylesheet" />
    <link href="<?php $this->options->themeUrl("assets/css/xa-ink.css?v=" . xaGetVersion()); ?>" rel="stylesheet" />
    <link href="<?php $this->options->themeUrl("assets/css/xa-ink-post.css?v=" . xaGetVersion()); ?>" rel="stylesheet" />
    <link href="<?php $this->options->themeUrl("assets/css/outline.min.css?v=" . xaGetVersion()); ?>" rel="stylesheet" />
    <script type="text/javascript" src="<?php $this->options->themeUrl("assets/js/jquery.min.js?v=" . xaGetVersion()); ?>"></script>
    <script type="text/javascript" src="<?php $this->options->themeUrl("assets/js/jquery.lazyload.min.js?v=" . xaGetVersion()); ?>"></script>
    <script type="text/javascript" src="<?php $this->options->themeUrl("assets/js/jquery.sticky-sidebar.min.js?v=" . xaGetVersion()); ?>"></script>
    <script type="text/javascript" src="<?php $this->options->themeUrl("assets/js/OwO/OwO.min.js?v=" . xaGetVersion()); ?>"></script>
    <script type="text/javascript">
        var siteUrl = '<?php $this->options->siteUrl() ?>';
    </script>
    <script type="text/javascript" src="<?php $this->options->themeUrl("assets/js/xa-ink.js?v=" . xaGetVersion()); ?>"></script>

</head>
<body>
<!-- 头部导航栏 -->
<header id="header" class="fixed top-0 z-30 w-full flex items-center shadow-md border-b-3 border-gray-100">
    <div class="relative flex items-center w-full">
        <div class="xa-header mx-auto flex items-center justify-between h-full w-full">
            <div class="xa-logo flex items-center justify-center">
                <?php if ($this->options->logoUrl): ?>
                <a href="<?php $this->options->siteUrl(); ?>">
                    <img src="<?php $this->options->logoUrl() ?>" alt="<?php $this->options->title() ?>" class="w-full">
                </a>
                <?php else: ?>
                    <a href="<?php $this->options->siteUrl(); ?>">
                        <img src="<?php $this->options->themeUrl("assets/images/logo.png"); ?>" alt="<?php $this->options->title() ?>" class="w-full">
                    </a>
                <?php endif; ?>
            </div>
            <!-- 搜索框 -->
            <div class="flex-1 hidden lg:block flex items-center justify-start">
                <form method="post" action="<?php $this->options->siteUrl(); ?>"  class="xa-search flex items-center w-full dark:bg-gray-700">
                    <input type="text" name="s" placeholder="搜索一下，你就找到"
                           class="w-full border-l-2 border-t-2 border-b-2 border-gray-200 dark:border-gray-600 rounded-l-lg py-2 px-4 h-10 focus:outline-none focus:border-blue-500"
                           value="<?php if($this->is('search')) echo $this->keywords; ?>" />
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 h-10 outline-blue-500 rounded-r-lg hover:bg-blue-600 focus:outline-none">搜索一下</button>
                </form>
            </div>
            <div class="hidden lg:block lg:mr-32" style="width: 340px;"></div>
        </div>
        <!-- 右侧靠右边栏 -->
        <div class="absolute right-2">
            <!-- 菜单和主题切换按钮 -->
            <div class="flex items-center space-x-2">
                <!-- Page -->
                <nav class="xa-nav hidden lg:block flex items-center justify-between space-x-4 mr-2">
                    <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                    <?php while($pages->next()): ?>
                        <a<?php if($this->is('page', $pages->slug)): ?> class="xa-selected"<?php endif; ?> href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
                    <?php endwhile; ?>
                </nav>
                <?php if($this->user->hasLogin()): ?>
                <!-- 登录后用户信息 -->
                <div class="relative">
                    <div class="xa-login flex items-center">
                        <!-- 用户头像 -->
                        <img src="<?php echo xaGetAvatar($this->user->mail); ?>" class="w-9 h-9 rounded-full mr-2">
                        <!-- 用户名 -->
                        <div><?php $this->user->screenName() ?></div>
                        <!-- 图标 -->
                        <i class="ti ti-chevron-down"></i>
                    </div>

                    <!-- 下拉框 -->
                    <div class="xa-login-menu xa-theme absolute top-full left-1 w-28 bg-white rounded-md shadow-md z-10 hidden">
                        <!-- 进入后台 -->
                        <div class="block px-4 py-2"><a href="<?php $this->options->adminUrl(); ?>" class="rounded-full px-3 py-1">进入后台</a></div>
                        <!-- 退出菜单 -->
                        <div class="block px-4 py-2"><a href="<?php $this->options->logoutUrl(); ?>" class="rounded-full px-3 py-1">退出</a></div>
                    </div>
                </div>
                <?php else: ?>
                <!-- 登录button -->
                <a href="<?php $this->options->adminUrl('login.php'); ?>" class="xa-button px-3 py-0.5 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">登录</a>
                <?php endif; ?>

                <!-- 主题 -->
                <button id="themeToggle"  class="dark:bg-gray-600 px-2 py-1.5 rounded-md hover:focus:outline-none" title="切换主题"><i class="ti ti-moon"></i></button>
                <!-- 移动端菜单 -->
                <button id="mobileNavToggle" class="lg:hidden px-2 py-1.5 rounded-md hover:focus:outline-none" title="菜单"><i class="ti ti-menu-2"></i></button>
            </div>
        </div>
    </div>
</header>