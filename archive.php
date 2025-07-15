<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
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
                    if($this->is('category')){
                        $subCategorys = [];
                        $isListCategory = xaIsListCategory($this->pageRow['mid']);
                        if (!$isListCategory && $this->pageRow['parent'] > 0) {
                            $isListCategory = xaIsListCategory($this->pageRow['parent']);
                        }
                        if($isListCategory) {
                            $subCategorys = $this->widget('Widget_Metas_Category_List')->getAllChildren($this->pageRow['mid']);
                            if (isset($subCategorys) && count($subCategorys) > 0) {
                                echo "分类<span class='mx-2 font-bold'>".$this->pageRow['name'] ." </span>子分类(".count($subCategorys).")";
                            }
                            else {
                                //var_dump($this->pageRow);
                                ?>
                            <div class="flex flex-col items-center justify-start">
                                <div class="w-full mb-4"><h2><?php echo $this->pageRow['name']; ?></h2></div>
                                <div class="w-full mb-4"><?php echo $this->pageRow['description']; ?></div>
                                <div class="w-full mb-4">章节数：<?php echo $this->pageRow['count']; ?></div>
                            </div>
                    <?php
                            }
                        }
                        else {
                            echo "分类<span class='mx-2 font-bold'>" . $this->pageRow['name'] . " </span>下共有文章" . $this->pageRow['count'] . "篇";
                        }
                    }
                    elseif($this->is('tag')) {
                        echo "<span class='xa-theme xa-count-tip mr-2' title='标签'>". $this->pageRow['name'] ."</span>相关文章". $this->pageRow['count'] ."篇";
                    }
                    elseif ($this->is('search')) {
                        $count = xaGetSearchTotal($this->keywords);
                        echo "为您找到相关文章".$count."篇";
                    }
                    elseif($this->is('archive')) {
                        if($this->archiveType == 'date') {
                            echo "归档:<span class='mx-2 font-bold'>".$this->archiveTitle ." </span>";
                        }
                    }
                    ?>
                </div>
                <div class="flex items-center space-x-4 hidden lg:block"></div>
            </div>
            <?php if($isListCategory): ?>
                <?php if(isset($subCategorys) && count($subCategorys) > 0) : ?>
                    <!-- 子分类列表 -->
                    <?php $this->need("core/categorylist.php"); ?>
                <?php else: ?>
                    <!-- 章节列表 -->
                    <?php $this->need("core/titlelist.php"); ?>
                <?php endif; ?>
            <?php else: ?>
            <!-- 文章列表 -->
            <?php $this->need("core/list.php"); ?>
            <?php endif;?>
        </div>
        <?php if($isListCategory && isset($subCategorys) && count($subCategorys) == 0): ?>
        <?php else: ?>
            <!-- 右侧栏 -->
            <?php $this->need('sidebar.php'); ?>
        <?php endif;?>
</div>
</main>
<?php if( !$isListCategory ): ?>
<?php $this->need('core/pager.php'); ?>
<?php endif;?>
<?php $this->need('footer.php'); ?>
