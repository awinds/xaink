<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="xa-sidebar hidden lg:block lg:mr-32">
    <!-- 用户信息 -->
    <section class="xa-sidebar-item xa-sidebar-author xa-theme">
        <div class="flex items-center space-x-4">
            <!-- 头像 -->
            <div>
                <img src="<?php echo xaGetAuthorAvatar($this->author->mail); ?>" alt="<?php $this->author->screenName(); ?>" class="w-14 h-14 rounded-full">
            </div>

            <!-- 用户名和签名 -->
            <div class="flex flex-1 flex-col justify-between space-y-2">
                <!-- 用户名 -->
                <div class="font-bold"><?php $this->author->screenName(); ?></div>
                <!-- 签名 -->
                <div class="text-sm text-gray-500">
                    <?php if($this->options->authorSign): $this->options->authorSign(); else: $this->options->description(); endif; ?>
                </div>
            </div>
        </div>

        <!-- 简介 -->
        <div class="mt-4">
            <?php if($this->options->authorProfile): $this->options->authorProfile(); else: _e('这家伙很懒，什么都没有留下'); endif; ?>
        </div>

        <!-- 链接 -->
        <div class="grid grid-cols-6 items-center gap-x-8 gap-y-4 mt-4">
            <a href="<?php $this->options->feedUrl(); ?>">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-rss"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M4 4a16 16 0 0 1 16 16" /><path d="M4 11a9 9 0 0 1 9 9" /></svg>
            </a>
            <?php if(xaPluginIsActivated('Sitemap')): ?>
            <a href="<?php $this->options->siteUrl(); ?>sitemap.xml">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-sitemap"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 15m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v2a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M15 15m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v2a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v2a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M6 15v-1a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v1" /><path d="M12 9l0 3" /></svg>
            </a>
            <?php endif; ?>

            <?php if($this->options->authorWechat): ?>
            <!-- Wechat -->
            <a rel="external nofollow" target="_blank" title="<?php $this->options->authorWechat() ?>" href="javascript:;">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-wechat"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.5 10c3.038 0 5.5 2.015 5.5 4.5c0 1.397 -.778 2.645 -2 3.47l0 2.03l-1.964 -1.178a6.649 6.649 0 0 1 -1.536 .178c-3.038 0 -5.5 -2.015 -5.5 -4.5s2.462 -4.5 5.5 -4.5z" /><path d="M11.197 15.698c-.69 .196 -1.43 .302 -2.197 .302a8.008 8.008 0 0 1 -2.612 -.432l-2.388 1.432v-2.801c-1.237 -1.082 -2 -2.564 -2 -4.199c0 -3.314 3.134 -6 7 -6c3.782 0 6.863 2.57 7 5.785l0 .233" /><path d="M10 8h.01" /><path d="M7 8h.01" /><path d="M15 14h.01" /><path d="M18 14h.01" /></svg>
            </a>
            <?php endif; ?>
            <?php if($this->options->authorQQ): ?>
            <!-- QQ -->
            <a rel="external nofollow" target="_blank" title="<?php $this->options->authorQQ() ?>" href="tencent://message/?uin=<?php $this->options->authorQQ() ?>&Site=&Menu=yes">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-qq"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 9.748a14.716 14.716 0 0 0 11.995 -.052c.275 -9.236 -11.104 -11.256 -11.995 .052z" /><path d="M18 10c.984 2.762 1.949 4.765 2 7.153c.014 .688 -.664 1.346 -1.184 .303c-.346 -.696 -.952 -1.181 -1.816 -1.456" /><path d="M17 16c.031 1.831 .147 3.102 -1 4" /><path d="M8 20c-1.099 -.87 -.914 -2.24 -1 -4" /><path d="M6 10c-.783 2.338 -1.742 4.12 -1.968 6.43c-.217 2.227 .716 1.644 1.16 .917c.296 -.487 .898 -.934 1.808 -1.347" /><path d="M15.898 13l-.476 -2" /><path d="M8 20l-1.5 1c-.5 .5 -.5 1 .5 1h10c1 0 1 -.5 .5 -1l-1.5 -1" /><path d="M13.75 7m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M10.25 7m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
            </a>
            <?php endif; ?>
            <?php if($this->options->authorEmail): ?>
            <!-- Email -->
            <a rel="external nofollow" target="_blank" title="<?php $this->options->authorEmail() ?>" href="mailto://<?php $this->options->authorEmail() ?>&subject=我从<?php $this->options->title(); ?>联系到你">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-mail"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" /><path d="M3 7l9 6l9 -6" /></svg>
            </a>
            <?php endif; ?>
            <?php if($this->options->authorGithub): ?>
            <!-- Github -->
            <a rel="external nofollow" target="_blank"  href="https://github.com/<?php $this->options->authorGithub() ?>/">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-github"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5" /></svg>
            </a>
            <?php endif; ?>
            <?php if($this->options->authorWeibo): ?>
            <!-- Weibo -->
            <a rel="external nofollow" target="_blank"  href="https://weibo.com/<?php $this->options->authorWeibo() ?>/">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-weibo"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19 14.127c0 3.073 -3.502 5.873 -8 5.873c-4.126 0 -8 -2.224 -8 -5.565c0 -1.78 .984 -3.737 2.7 -5.567c2.362 -2.51 5.193 -3.687 6.551 -2.238c.415 .44 .752 1.39 .749 2.062c2 -1.615 4.308 .387 3.5 2.693c1.26 .557 2.5 .538 2.5 2.742z" /><path d="M15 4h1a5 5 0 0 1 5 5v1" /></svg>
            </a>
            <?php endif; ?>
            <?php if($this->options->authorTwitter): ?>
            <!-- Twitter -->
            <a rel="external nofollow" target="_blank"  href="https://twitter.com/<?php $this->options->authorTwitter() ?>/">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4l11.733 16h4.267l-11.733 -16z" /><path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" /></svg>
            </a>
            <?php endif; ?>
            <?php if($this->options->authorTelegram): ?>
            <!-- Telegram -->
            <a rel="external nofollow" target="_blank"  href="https://t.me/<?php $this->options->authorTelegram() ?>/">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-telegram"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4" /></svg>
            </a>
            <?php endif; ?>
            <?php if($this->options->authorInstagram): ?>
            <!-- Instagram -->
            <a rel="external nofollow" target="_blank"  href="https://instagram.com/<?php $this->options->authorInstagram() ?>/">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-instagram"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4m0 4a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" /><path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M16.5 7.5l0 .01" /></svg>
            </a>
            <?php endif; ?>
        </div>
    </section>

    <!-- 热门文章 -->
    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowPopularArticles', $this->options->sidebarBlock)): ?>
    <section class="xa-sidebar-item rounded-lg mt-6 dark:bg-gray-700">
        <h2 class="font-bold flex items-center">热门文章<span class="flex"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-right text-gray-400">
  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
  <path d="M9 6l6 6l-6 6" /></svg></span></h2>
        <ul>
            <?php
            $hotPosts = xaGetHotPosts();
            $idxPost = 1;
            if (!empty($hotPosts)):
                foreach ($hotPosts as $post): ?>
                    <li class="line-clamp-2">
                        <?php if($idxPost == 1): ?>
                        <span class="xa-no xa-no-1">1</span>
                        <?php elseif($idxPost == 2): ?>
                        <span class="xa-no xa-no-2">2</span>
                        <?php elseif($idxPost == 3): ?>
                        <span class="xa-no xa-no-3">3</span>
                        <?php else: ?>
                        <span class="xa-no"><?php echo $idxPost; ?></span>
                        <?php endif; ?>
                        <a href="<?php echo $post["permalink"]; ?>" title="<?php echo $post["title"]; ?>" class="text-blue-500"><?php echo $post["title"]; ?></a>
                    </li>
                    <?php $idxPost++; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </section>
    <?php endif; ?>

    <?php  if($this->is('post') || $this->is('page')): ?>
    <!-- 文章导读 -->
    <section class="xa-sidebar-item rounded-lg mt-6 dark:bg-gray-700">
        <h2 class="font-bold flex items-center">文章导读<span class="flex"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-right text-gray-400">
  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
  <path d="M9 6l6 6l-6 6" /></svg></span></h2>
        <div id="xa-toc"></div>
    </section>
    <script type="text/javascript" src="<?php $this->options->themeUrl("assets/js/outline.min.js?v=" . xaGetVersion()); ?>"></script>
    <?php endif; ?>

    <?php if($this->is('post')): ?>
    <!-- 相关推荐 -->
    <section class="xa-sidebar-item rounded-lg mt-6 dark:bg-gray-700">
        <h2 class="font-bold flex items-center">相关推荐<span class="flex"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-right text-gray-400">
  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
  <path d="M9 6l6 6l-6 6" />
</svg></span></h2>
        <?php $this->related(5)->to($relatedPosts); ?>
        <ul>
            <?php while ($relatedPosts->next()): ?>
                <li class="line-clamp-2 pl-4"><a href="<?php $relatedPosts->permalink(); ?>" title="<?php $relatedPosts->title(); ?>"><?php $relatedPosts->title(); ?></a></li>
            <?php endwhile; ?>
        </ul>
    </section>
    <?php endif; ?>

    <?php if(!$this->is('post') && !$this->is('page')): ?>
    <!-- 最新评论 -->
    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentComments', $this->options->sidebarBlock)): ?>
    <section class="xa-sidebar-item rounded-lg mt-6 dark:bg-gray-700">
        <h2 class="font-bold flex items-center">最新评论<span class="flex"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-right text-gray-400">
  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
  <path d="M9 6l6 6l-6 6" /></svg></span></h2>
        <ul>
            <?php $this->widget("Widget_Comments_Recent", [])->to($recentComments); ?>
            <?php if ($recentComments->have()): ?>
                <?php $idxComment = 1; ?>
                <?php while ($recentComments->next()): ?>
                    <li class="line-clamp-2">
                        <?php if($idxComment == 1): ?>
                            <span class="xa-no xa-no-1">1</span>
                        <?php elseif($idxComment == 2): ?>
                            <span class="xa-no xa-no-2">2</span>
                        <?php elseif($idxComment == 3): ?>
                            <span class="xa-no xa-no-3">3</span>
                        <?php else: ?>
                            <span class="xa-no"><?php echo $idxComment; ?></span>
                        <?php endif; ?>
                        <a href="<?php $recentComments->permalink(); ?>" title="<?php $recentComments->excerpt(35, "..."); ?>" class="text-blue-500"><?php $recentComments->excerpt(35, "..."); ?></a>
                    </li>
                    <?php $idxComment++; ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </ul>
    </section>
    <?php endif; ?>

    <!-- 日志存档 -->
    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowArchive', $this->options->sidebarBlock)): ?>
    <section class="xa-sidebar-item rounded-lg mt-6 dark:bg-gray-700">
        <h2 class="font-bold flex items-center">日志存档<span class="flex"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-right text-gray-400">
  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
  <path d="M9 6l6 6l-6 6" /></svg></span></h2>
        <ul class="grid grid-cols-1 lg:grid-cols-3 gap-2">
            <?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=Y年m月')
                ->parse('<li><a href="{permalink}" class="px-4 py-2 rounded-full">{date}</a></li>'); ?>
        </ul>
    </section>
    <?php endif; ?>

    <!-- 热门标签 -->
    <?php if (!empty($this->options->sidebarBlock) && in_array('PopularTags', $this->options->sidebarBlock)): ?>
    <section class="xa-sidebar-item xa-sidebar-tag rounded-lg mt-6 dark:bg-gray-700">
        <h2 class="font-bold flex items-center">热门标签<span class="flex"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-right text-gray-400">
  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
  <path d="M9 6l6 6l-6 6" /></svg></span></h2>
        <ul class="mt-2 flex flex-wrap gap-y-2">
            <?php $this->widget("Widget_Metas_Tag_Cloud", "ignoreZeroCount=1&limit=15")->to($tags); ?>
            <?php if ($tags->have()): ?>
                <?php while ($tags->next()): ?>
                    <li>
                        <a href="<?php $tags->permalink(); ?>"
                           title="<?php $tags->name(); ?>"
                           class="px-4 py-2 rounded-full"><?php $tags->name(); ?></a>
                    </li>
                <?php endwhile; ?>
            <?php endif; ?>
        </ul>
    </section>
    <?php endif; ?>

    <!--其它 -->
    <section class="xa-sidebar-item rounded-lg mt-6 dark:bg-gray-700">
        <h2 class="font-bold flex items-center">其它<span class="flex"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-right text-gray-400">
  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
  <path d="M9 6l6 6l-6 6" /></svg></span></h2>
        <ul class="mt-2 flex-col items-center">
            <li class="line-clamp-2 pl-4 flex items-center space-x-1">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="16"  height="16"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-playstation-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 21a9 9 0 0 0 9 -9a9 9 0 0 0 -9 -9a9 9 0 0 0 -9 9a9 9 0 0 0 9 9z" /><path d="M12 12m-4.5 0a4.5 4.5 0 1 0 9 0a4.5 4.5 0 1 0 -9 0" /></svg>
                <a href="https://www.foreverblog.cn/go.html" target="_blank" title="穿梭虫洞-随机访问十年之约友链博客">虫洞</a>
            </li>
            <li class="line-clamp-2 pl-4 flex items-center space-x-1">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="16"  height="16"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-train"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 13c0 -3.87 -3.37 -7 -10 -7h-8" /><path d="M3 15h16a2 2 0 0 0 2 -2" /><path d="M3 6v5h17.5" /><path d="M3 10l0 4" /><path d="M8 11l0 -5" /><path d="M13 11l0 -4.5" /><path d="M3 19l18 0" /></svg>
                <a href="https://www.travellings.cn/go.html" target="_blank" title="开往">开往</a>
            </li>
			<li class="line-clamp-2 pl-4 flex items-center space-x-1">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="16"  height="16"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-letter-b"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 20v-16h6a4 4 0 0 1 0 8a4 4 0 0 1 0 8h-6" /><path d="M7 12l6 0" /></svg>
                <a href="https://bokelu.suijiboke.gs/" target="_blank" title="随机博客">博客录</a>
            </li>
            <li class="line-clamp-2 pl-4 flex items-center space-x-1">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="16"  height="16"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-packages"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" /><path d="M2 13.5v5.5l5 3" /><path d="M7 16.545l5 -3.03" /><path d="M17 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" /><path d="M12 19l5 3" /><path d="M17 16.5l5 -3" /><path d="M12 13.5v-5.5l-5 -3l5 -3l5 3v5.5" /><path d="M7 5.03v5.455" /><path d="M12 8l5 -3" /></svg>
                <a href="https://cloud.tencent.com/developer/column/99647" target="_blank" title="偷得浮生半日闲">开发者社区</a>
            </li>
        </ul>
    </section>
    <?php endif; ?>
</div>
