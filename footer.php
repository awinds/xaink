<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!-- 右下角按钮 -->
<div class="xa-fixed-btn">
    <!-- 返回顶部按钮 -->
    <button class="hidden bg-blue-500 text-white dark:bg-gray-600 px-2 py-1.5 rounded-md hover:focus:outline-none" id="backToTop" title="返回顶部"><i class="ti ti-chevron-up"></i></button>
</div>

<!-- 页脚 -->
<footer id="footer" class="flex items-center">
    <div class="xa-footer mx-auto w-full flex justify-center items-center flex-col text-gray-400 dark:bg-gray-900 dark:border-gray-600 md:justify-start md:flex-row md:pl-32">
        <div class="space-x-2">
            <span>© <?php echo date("Y", time());?> <?php $this->options->title(); ?></span>
            <span>Theme by <a href="https://xiaoa.me">XiaoA</a></span>
        </div>
        <div class="px-2">
            <?php if($this->options->siteBeiAn): ?>
            <span><a rel="external nofollow" target="_blank" href="https://beian.miit.gov.cn/"><?php $this->options->siteBeiAn(); ?></a></span>
            <?php endif ?>
        </div>
    </div>
</footer>
</body>
<?php $this->footer(); ?>
</html>