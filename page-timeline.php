<?php
/**
 * 时间线页面
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
    <div class="w-full flex justify-between px-4 lg:px-1">
        <!-- 列表 -->
        <div id="main-center" class="flex-1 mx-1 lg:mr-12 lg:ml-32">
            <!-- 时间线 -->
            <h1 class="py-4" itemprop="headline">时间线</h1>
            <div class="py-2">按年份显示文章的时间线，点击年份可展开/关闭，默认展开本年</div>
            <div class="xa-theme xa-archive-year">
                <?php
                $curyear = date("Y", time());
                $archives = xaGetArchives($this);
                foreach ($archives as $year => $posts) : ?>
                    <div class="relative py-2">
                        <div class="xa-theme xa-link-line"></div>
                        <div class="xa-theme xa-link-circle"></div>
                        <h2 class="ml-4"><a href="javascript:;" year="<?php echo $year;?>" title="展开/关闭" class="xa-archive-year-title"><?php echo $year;?>年</a><span class="xa-theme xa-count-tip"><?php echo count($posts); ?></span></h2>
                    </div>
                    <ul class="ml-4 my-2 flex flex-col space-y-4<?php if($year != $curyear):?> hidden<?php endif; ?>" id="xa-archive-year-item-<?php echo $year;?>">
                    <?php foreach ($posts as $created => $post): ?>
                         <li class="flex items-center justify-between">
                            <div>
                                <span class="font-bold mr-2"><?php echo date("m/d", $created) ?></span>
                                <a class="xa-link" href="<?php echo $post["permalink"]; ?>"><?php echo $post["title"];?></a>
                            </div>
                            <div>
                                <?php $categoryIdx = 0; ?>
                                <?php if(isset($post['categorys']) && count($post['categorys']) > 0): ?>
                                    <?php foreach ($post['categorys'] as $category): ?>
                                        <?php if($categoryIdx > 0): ?> | <?php endif; ?>
                                        <a href="<?php echo $category["permalink"]; ?>"><?php echo $category['name'] ?></a>
                                        <?php $categoryIdx++; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    默认
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- 右侧栏 -->
        <?php $this->need('sidebar.php'); ?>
    </div>
</main>
<?php $this->need('footer.php'); ?>