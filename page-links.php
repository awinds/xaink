<?php
/**
 * 友链页面
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<?php $this->need("header.php"); ?>
<!-- 主体 -->
<main id="main" class="mx-auto">
    <!-- 分类 -->
    <?php $this->need("core/menu.php"); ?>
    <!-- 内容 -->
    <div class="w-full flex justify-between mt-4 px-4 lg:px-1">
        <!-- 列表 -->
        <div id="main-center" class="flex-1 mx-1 lg:mr-12 lg:ml-32">
            <!-- 友情链接 -->
            <h2 class="py-4" itemprop="name headline">友情链接</h2>
            <?php if(xaPluginIsActivated("Links")): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php
                Links_Plugin::output('<a rel="external {user}" href="{url}" target="_blank" title="{title}" class="xa-links-item flex items-center justify-center p-4 rounded shadow h-20">
                        <div class="w-12 h-12 mr-2">
                            <img data-original="{image}" class="lazy min-w-fit min-h-fit rounded-full" />
                        </div>
                        <div class="flex flex-1 flex-col justify-between">
                            <h4 class="font-bold text-base">{name}</h4>
                            <p class="line-clamp-1 text-sm">{title}</p>
                        </div>
                    </a>');
                ?>
            </div>
            <?php else: ?>
            <div>Links 插件未启用，若要使用友情链接功能，请先<a href="https://github.com/awinds/xaink/raw/refs/heads/main/plugins/Links.zip" target="_blank" rel="external nofollow">下载</a>安装并启用。</div>
            <?php endif; ?>
            <!--分隔线-->
            <div class="xa-space-line"></div>
            <!-- 我的链接 -->
            <h2 class="py-4" itemprop="name headline">我的链接</h2>
            <div class="xa-theme xa-post-content" itemprop="articleBody">
                <?php $this->content(); ?>
            </div>
            <!--分隔线-->
            <div class="xa-space-line"></div>
            <!-- 评论 -->
            <?php $this->need('comments.php'); ?>
        </div>
        <!-- 右侧栏 -->
        <?php $this->need('sidebar.php'); ?>
    </div>
</main>
<?php $this->need('footer.php'); ?>
