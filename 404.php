<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need("header.php"); ?>
    <!-- 主体 -->
    <main id="main" class="mx-auto">
        <!-- 分类 -->
        <?php $this->need("core/menu.php"); ?>
        <!-- 内容 -->
        <div class="w-full flex justify-between mt-4 px-4 lg:px-1">
            <!-- 列表 -->
            <div class="flex-1 mx-1 lg:mr-12 lg:ml-32" itemscope itemtype="https://schema.org/NewsArticle">
                <div class="xa-theme xa-post-content" itemprop="articleBody">
                    <p>是不是迷路了?快快跟我去<a href="<?php $this->options->siteUrl(); ?>" title="首页">首页</a>吧!</p>
                </div>
            </div>
            <!-- 右侧栏 -->
            <?php $this->need('sidebar.php'); ?>
        </div>
    </main>
<?php $this->need('footer.php'); ?>