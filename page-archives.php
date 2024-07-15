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
    <div class="w-full flex justify-between mt-4 px-4 lg:px-1">
        <!-- 列表 -->
        <div id="main-center" class="flex-1 mx-1 lg:mr-12 lg:ml-32">
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
            <div>
                <?php
                $dates = $this->widget('Widget_Contents_Post_Date', 'type=month&format=Y-m');
                $arcDates = array();
                if ($dates->have()) {
                    while ($dates->next()) {
                        if(!is_array($arcDates[$dates->year])) {
                            $arcDates[$dates->year] = array();
                        }
                        $item = array(
                            "date"=>$dates->date,
                            "permalink"=>$dates->permalink,
                            "count"=>$dates->count
                        );
                        $arcDates[$dates->year][] = $item;
                    }
                }
                ?>
                <?php if (isset($arcDates) && count($arcDates) > 0): ?>
                    <?php foreach ($arcDates as $year=>$vals): ?>
                    <h2 class="ml-4 py-4" itemprop="headline"><?php echo $year; ?></h2>
                    <ul class="flex flex-wrap ml-4 gap-y-8 gap-x-12">
                    <?php foreach ($vals as $val):  ?>
                        <li>
                            <a href="<?php echo $val['permalink']; ?>" rel="tag" title="<?php echo $val['date']; ?>"><?php echo $val['date']; ?></a>
                            <span class="xa-theme xa-count-tip"><?php echo $val['count']; ?></span>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>这些年，他没有写文章!</li>
                <?php endif; ?>
            </div>
        </div>
        <!-- 右侧栏 -->
        <?php $this->need('sidebar.php'); ?>
    </div>
</main>
<?php $this->need('footer.php'); ?>