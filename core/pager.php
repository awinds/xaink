<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!-- 分页 -->
<nav id="pager" class="flex items-center">
    <?php $this->pageNav("&lt;上一页", "下一页&gt;", 1, "...", [
        wrapTag=>"ul",
        wrapClass=>"xa-pager mx-auto w-full flex justify-center space-x-4 mx-4 lg:justify-start lg:pl-32 lg:mr-32",
        itemTag=>"li",
        textTag=>"",
        itemClass=>"",
        currentClass=>"xa-pager-selected",
        prevClass=>"xa-pn",
        nextClass=>"xa-pn",]); ?>
</nav>