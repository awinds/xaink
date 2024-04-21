<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need("header.php"); ?>
<!-- 主体 -->
<main id="main" class="mx-auto">
    <!-- 分类 -->
    <?php $this->need("core/menu.php"); ?>
    <!-- 内容 -->
    <div class="w-full flex justify-between mt-4 px-4 md:px-1">
        <!-- 列表 -->
        <div id="main-center" class="flex-1 mx-1 md:mr-12 md:ml-32">
            <!-- 统计和说明 -->
            <div class="xa-statistics flex items-center justify-between pb-2 mt-2 md:pt-0">
                <div class="flex items-center">
                    <?php
                    if($this->is('category')){
                        echo "分类<span class='mx-2 font-bold'>".$this->pageRow['name'] ." </span>下共有文章". $this->pageRow['count'] ."篇";
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
                <div class="flex items-center space-x-4 hidden md:block"></div>
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
