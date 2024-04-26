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
            <div class="flex flex-col justify-between space-y-2">
                <!-- 用户名 -->
                <div class="font-bold"><?php $this->author->screenName(); ?></div>
                <!-- 签名 -->
                <div class="text-sm text-gray-500">
                    <?php if($this->options->authorProfile): $this->options->authorProfile(); else: $this->options->description(); endif; ?>
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
                <i class="ti ti-rss"></i>
            </a>
            <?php if(xaPluginIsActivated('Sitemap')): ?>
            <a href="<?php $this->options->siteUrl(); ?>sitemap.xml">
                <i class="ti ti-sitemap"></i>
            </a>
            <?php endif; ?>

            <?php if($this->options->authorWechat): ?>
            <!-- Wechat -->
            <a rel="external nofollow" target="_blank" title="<?php $this->options->authorWechat() ?>" href="javascript:;"><i class="ti ti-brand-wechat"></i></a>
            <?php endif; ?>
            <?php if($this->options->authorQQ): ?>
            <!-- QQ -->
            <a rel="external nofollow" target="_blank" title="<?php $this->options->authorQQ() ?>" href="tencent://message/?uin=<?php $this->options->authorQQ() ?>&Site=&Menu=yes"><i class="ti ti-brand-qq"></i></a>
            <?php endif; ?>
            <?php if($this->options->authorEmail): ?>
            <!-- Email -->
            <a rel="external nofollow" target="_blank" title="<?php $this->options->authorEmail() ?>" href="mailto://<?php $this->options->authorEmail() ?>&subject=我从<?php $this->options->title(); ?>联系到你"><i class="ti ti-mail"></i></a>
            <?php endif; ?>
            <?php if($this->options->authorGithub): ?>
            <!-- Github -->
            <a rel="external nofollow" target="_blank"  href="https://github.com/<?php $this->options->authorGithub() ?>/"><i class="ti ti-brand-github"></i></a>
            <?php endif; ?>
            <?php if($this->options->authorWeibo): ?>
            <!-- Weibo -->
            <a rel="external nofollow" target="_blank"  href="https://weibo.com/<?php $this->options->authorWeibo() ?>/"><i class="ti ti-brand-weibo"></i></a>
            <?php endif; ?>
            <?php if($this->options->authorTwitter): ?>
            <!-- Twitter -->
            <a rel="external nofollow" target="_blank"  href="https://twitter.com/<?php $this->options->authorTwitter() ?>/"><i class="ti ti-brand-x"></i></a>
            <?php endif; ?>
            <?php if($this->options->authorTelegram): ?>
            <!-- Telegram -->
            <a rel="external nofollow" target="_blank"  href="https://t.me/<?php $this->options->authorTelegram() ?>/"><i class="ti ti-brand-telegram"></i></a>
            <?php endif; ?>
            <?php if($this->options->authorInstagram): ?>
            <!-- Instagram -->
            <a rel="external nofollow" target="_blank"  href="https://instagram.com/<?php $this->options->authorInstagram() ?>/"><i class="ti ti-brand-instagram"></i></a>
            <?php endif; ?>
        </div>
    </section>
    <!-- 热门文章 -->
    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowPopularArticles', $this->options->sidebarBlock)): ?>
    <section class="xa-sidebar-item rounded-lg mt-6 dark:bg-gray-700">
        <h2 class="font-bold">热门文章<span><i class="ti ti-chevron-right text-gray-400"></i></span></h2>
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
    <!-- 最新评论 -->
    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentComments', $this->options->sidebarBlock)): ?>
    <section class="xa-sidebar-item rounded-lg mt-6 dark:bg-gray-700">
        <h2 class="font-bold">最新评论<span><i class="ti ti-chevron-right text-gray-400"></i></span></h2>
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
        <h2 class="font-bold">日志存档<span><i class="ti ti-chevron-right text-gray-400"></i></span></h2>
        <ul class="grid grid-cols-1 lg:grid-cols-3 gap-2">
            <?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=Y年m月')
                ->parse('<li><a href="{permalink}" class="px-4 py-2 rounded-full">{date}</a></li>'); ?>
        </ul>
    </section>
    <?php endif; ?>
    <!-- 热门标签 -->
    <?php if (!empty($this->options->sidebarBlock) && in_array('PopularTags', $this->options->sidebarBlock)): ?>
    <section class="xa-sidebar-item xa-sidebar-tag rounded-lg mt-6 dark:bg-gray-700">
        <h2 class="font-bold">热门标签<span><i class="ti ti-chevron-right text-gray-400"></i></span></h2>
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
        <h2 class="font-bold">其它<span><i class="ti ti-chevron-right text-gray-400"></i></span></h2>
        <ul class="mt-2 flex-col items-center">
            <li class="line-clamp-2 flex items-center">
                <i class="ti ti-playstation-circle"></i>
                <a href="https://www.foreverblog.cn/go.html" target="_blank" title="穿梭虫洞-随机访问十年之约友链博客">虫洞</a>
            </li>
            <li class="line-clamp-2 flex items-center">
                <i class="ti ti-train"></i>
                <a href="https://www.travellings.cn/go.html" target="_blank" title="开往">开往</a>
            </li>
        </ul>
    </section>
</div>