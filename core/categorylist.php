<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<ul>
    <?php 
    $mid = xaGetPageRowValue($this->pageRow,'mid',0);
    $subCategorys = xaGetCategoryChildren($mid);?>
    <?php foreach ($subCategorys as $child): ?>
    <li class="mb-8" itemscope itemtype="http://schema.org/BlogPosting">
        <h3 class="xa-title text-lg mb-2" itemprop="name headline">
            <a href="<?php echo $child['permalink']; ?>" title="<?php echo $child['name']; ?>"><?php echo $child['name']; ?></a>
        </h3>
        <div class="flex items-center justify-between">
            <div class="xa-content flex-1 flex flex-col justify-between h-full">
                <div class="max-h-16 line-clamp-3 break-all" itemprop="abstract">
                    <?php echo $child['description']; ?>
                </div>
                <div class="text-sm text-gray-500 mt-1">
                    共 <?php echo $child['count']; ?> 章节
                </div>
            </div>
        </div>
    </li>
    <?php endforeach; ?>
</ul>
