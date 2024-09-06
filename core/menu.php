<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div class="xa-categories pt-2 mx-4 hidden lg:block lg:ml-32 lg:px-1">
    <ul class="flex space-x-8">
        <li class="relative flex items-center xa-categories-title <?php if($this->is('index')): ?>xa-selected<?php endif; ?> ">
            <i class="flex items-center"><svg  xmlns="http://www.w3.org/2000/svg"  width="16"  height="16"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-home"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg></i>
            <a href="<?php $this->options->siteUrl(); ?>" title="首页" class="xa-categories-title text-gray-500 hover:text-gray-700">首页</a>
        </li>
        <?php $this->widget('Widget_Metas_Category_List')->to($categorys); ?>
        <?php if ($categorys->have()): ?>
            <?php while ($categorys->next()):
                if($categorys->levels != 0) {
                    continue;
                }
                $childs = $categorys->getAllChildren($categorys->mid);
                $svgicon = xaGetCategorySvg($categorys->mid);
                ?>
                <li class="relative flex items-center xa-categories-title <?php if(xaIsActiveCategory($this,$categorys->slug)): ?>xa-selected<?php endif; ?> ">
                    <?php if($svgicon != ''):?>
                    <i class="flex items-center"><?php echo $svgicon;?></i>
                    <?php endif; ?>
                    <a href="<?php $categorys->permalink(); ?>" title="<?php $categorys->name();?>" class="xa-categories-title text-gray-500 hover:text-gray-700"><?php $categorys->name();?>
                        <!-- 这里增加了功能，列表目录不再显示子目录 -->
                        <?php if (isset($childs) && count($childs) > 0 && !xaIsListCategory($categorys->mid)):  ?>
                            <!-- 图标 -->
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="16"  height="16"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-down"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 9l6 6l6 -6" /></svg>
                        <?php endif; ?>
                    </a>
                    <!-- 这里增加了功能，列表目录不再显示子目录 -->
                    <?php if (isset($childs) && count($childs) > 0 && !xaIsListCategory($categorys->mid)): ?>
                    <!-- 子分类下拉框 -->
                    <div class="xa-categories-sub xa-theme absolute top-full left-0 w-32 bg-white rounded-md shadow-md z-11 hidden">
                        <?php
                            foreach ($childs as $childmid) {
                                $child = $categorys->getCategory($childmid);
                                $childsvgicon = xaGetCategorySvg($child['mid']);
                            ?>
                            <div class="block flex items-center py-2 px-3">
                                <?php if($childsvgicon != ''):?>
                                    <i class="flex items-center"><?php echo $childsvgicon;?></i>
                                <?php endif; ?>
                                <a href="<?php echo $child['permalink']; ?>" class="rounded-full text-gray-500 hover:text-gray-700"><?php echo $child['name']; ?></a>
                            </div>
                        <?php } ?>
                    </div>
                    <?php endif; ?>
                </li>
            <?php endwhile; ?>
        <?php endif; ?>
    </ul>
</div>

<!-- 移动设备上的侧边菜单 -->
<aside class="xa-theme fixed overflow-y-auto top-0 left-0 h-full w-3/5 z-50 transform transition duration-300 ease-in-out -translate-x-full">
    <div class="mt-12">
        <ul class="flex flex-col space-y-4 px-4">
            <a href="<?php $this->options->siteUrl(); ?>">
                <li class="px-4 py-2 rounded-md flex items-center">
                    <i class="flex items-center"><svg  xmlns="http://www.w3.org/2000/svg"  width="16"  height="16"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-home"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg></i>
                    首页
                </li>
            </a>
            <?php $this->widget('Widget_Metas_Category_List')->to($categorys); ?>
            <?php if ($categorys->have()): ?>
                <?php while ($categorys->next()):
                    if($categorys->levels != 0) {
                        continue;
                    }
                    $childs = $categorys->getAllChildren($categorys->mid);
                    $svgicon = xaGetCategorySvg($categorys->mid);
                    ?>
                    <a href="<?php $categorys->permalink(); ?>"><li class="px-4 py-2 rounded-md flex items-center">
                            <?php if($svgicon != ''):?>
                                <i class="flex items-center"><?php echo $svgicon;?></i>
                            <?php endif; ?>
                            <?php $categorys->name();?>
                        </li></a>
                    <?php if (isset($childs) && count($childs) > 0 && !xaIsListCategory($categorys->mid)): ?>
                            <?php
                            foreach ($childs as $childmid) {
                                $child = $categorys->getCategory($childmid);
                                $childsvgicon = xaGetCategorySvg($child['mid']);
                                ?>
                                <a href="<?php echo $child['permalink']; ?>"><li class="px-8 py-2 rounded-md flex items-center">
                                        <?php if($childsvgicon != ''):?>
                                            <i class="flex items-center"><?php echo $childsvgicon;?></i>
                                        <?php endif; ?>
                                        <?php echo $child['name']; ?>
                                    </li></a>
                            <?php } ?>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </ul>
    </div>
    <div class="mt-16 mb-4">
        <ul class="flex flex-col space-y-4 px-4">
            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            <?php while($pages->next()): ?>
                <a href="<?php $pages->permalink(); ?>"><li class="px-4 py-2 rounded-md"><?php $pages->title(); ?></li></a>
            <?php endwhile; ?>
        </ul>
    </div>
</aside>
<div id="xa-aside-mask" class="hidden lg:hidden fixed top-0 left-0 h-full w-full z-40 bg-gray-500 bg-opacity-50"></div>
