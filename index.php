<?php
/**
 * 仿百度响应式的 Typecho 主题，支持明暗模式。<br/>
 * Github：<a href="https://github.com/awinds/xaink" target="_blank" title="XaInk Github Repo">https://github.com/awinds/xaink</a>
 *
 * @package XaInk
 * @author XiaoA
 * @version 1.1
 * @link https://www.xa.ink/
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
            <!-- 统计和说明 -->
            <div class="xa-statistics flex items-center justify-between pb-2 mt-2 lg:pt-0">
                <div class="flex items-center">
                    <?php
                    if($this->is('index')) {
                        Typecho_Widget::widget('Widget_Stat')->to($stat);
                        echo "此博客有文章".$stat->publishedPostsNum."篇，评论".$stat->publishedCommentsNum."条，分类".$stat->categoriesNum."个，标签".$stat->tagsNum."个";
                    } elseif ($this->is('archive')) {
                        echo "此分类下文章0篇";
                    } elseif ($this->is('search')) {
                        $widget = new Widget_Contents_Post_Search();
                        echo "为您找到相关文章".count($widget->stack)."篇";
                    }
                    ?>
                </div>
                <div class="flex items-center space-x-4 hidden lg:block"></div>
            </div>
            <!-- 文章列表 -->
            <?php $this->need("core/list.php"); ?>
        </div>
        <!-- 右侧栏 -->
        <?php $this->need('sidebar.php'); ?>
    </div>
</main>
<?php $this->need('core/pager.php'); ?>
<?php $this->need('footer.php'); ?>
