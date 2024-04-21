<?php
/**
 * 归档页面
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
    <div class="w-full flex justify-between mt-4 px-4 md:px-1">
        <!-- 列表 -->
        <div id="main-center" class="flex-1 mx-1 md:mr-12 md:ml-32">
            <!-- 标签归档 -->
            <h1 class="py-4" itemprop="headline">标签</h1>
            <ul class="flex flex-wrap gap-y-8 gap-x-12">
                <?php
                $this->widget("Widget_Metas_Tag_Cloud", "sort=mid&ignoreZeroCount=1&desc=0")->to($tags);
                if ($tags->have()): ?>
                        <?php while ($tags->next()): ?>
                            <li>
                                <a rel="tag" href="<?php $tags->permalink(); ?>" title="<?php $tags->name(); ?>"><?php $tags->name(); ?></a>
                                <span class="xa-theme xa-count-tip"><?php $tags->count(); ?></span>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <li>还没有任何标签留下!</li>
                <?php endif; ?>
            </ul>
            <!-- 分类归档 -->
            <h1 class="py-4 mt-8" itemprop="headline">分类</h1>
            <ul class="flex flex-wrap gap-y-8 gap-x-12">
                <?php $this->widget("Widget_Metas_Category_List")->to($categories); ?>
                <?php if ($categories->have()): ?>
                    <?php while ($categories->next()): ?>
                        <li>
                            <a href="<?php $categories->permalink(); ?>" rel="tag" title="<?php $categories->name(); ?>"> <?php $categories->name(); ?></a>
                            <span class="xa-theme xa-count-tip"><?php $categories->count(); ?></span>
                        </li>
                    <?php endwhile; ?>
                <?php else: ?>
                    <li>还没有任何分类留下!</li>
                <?php endif; ?>
            </ul>
            <!-- 年份归档 -->
            <h1 class="py-4 mt-8" itemprop="headline">按年</h1>
            <div class="xa-theme xa-archive-year">
                <?php
                $archives = xaGetArchives($this);
                foreach ($archives as $year => $posts) : ?>
                    <div class="relative py-2">
                        <div class="xa-theme xa-link-line"></div>
                        <div class="xa-theme xa-link-circle"></div>
                        <h2 class="ml-4"><a href="javascript:;" year="<?php echo $year;?>" title="展开/关闭" class="xa-archive-year-title"><?php echo $year;?>年</a><span class="xa-theme xa-count-tip"><?php echo count($posts); ?></span></h2>
                    </div>
                    <ul class="ml-4 my-2 flex flex-col space-y-4 hidden" id="xa-archive-year-item-<?php echo $year;?>">
                    <?php foreach ($posts as $created => $post): ?>
                         <li class="flex items-center justify-between">
                            <div>
                                <span class="font-bold mr-2"><?php echo date("m/d", $created) ?></span>
                                <a class="xa-link" href="<?php echo $post["permalink"]; ?>"><?php echo $post["title"];?></a>
                            </div>
                            <div>
                                <?php $categoryIdx = 0; ?>
                                <?php if(count($post['categorys']) > 0): ?>
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