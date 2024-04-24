<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!-- 分页 -->
<nav id="pager" class="flex items-center justify-center">
    <div class="xa-pager mx-auto items-center justify-center lg:pl-32 lg:pr-32">
        <?php $this->pageNav("&lt;上一页", "下一页&gt;", 1, "...", array(
        "wrapTag"=>"ul",
        "wrapClass"=>"flex justify-center space-x-4 lg:justify-start",
        "itemTag"=>"li",
        "textTag"=>"",
        "itemClass"=>"",
        "currentClass"=>"xa-pager-selected",
        "prevClass"=>"xa-pn",
        "nextClass"=>"xa-pn")); ?>
    </div>
</nav>