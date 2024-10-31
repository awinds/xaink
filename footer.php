<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!-- 右下角按钮 -->
<div class="xa-fixed-btn">
    <!-- 返回顶部按钮 -->
    <button class="hidden bg-blue-500 text-white dark:bg-gray-600 px-2 py-1.5 rounded-md hover:focus:outline-none" id="backToTop" title="返回顶部">
        <svg  xmlns="http://www.w3.org/2000/svg"  width="16"  height="16"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-up"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 15l6 -6l6 6" /></svg>
    </button>
</div>

<!-- 页脚 -->
<footer id="footer" class="flex items-center">
    <div class="xa-footer mx-auto w-full flex justify-center flex-col lg:flex-row items-center text-gray-400 dark:bg-gray-900 dark:border-gray-600 lg:justify-between lg:flex lg:px-32">
        <div class="space-x-2 flex flex-col justify-center items-center lg:flex-row lg:justify-start">
            <span>© <?php echo date("Y", time());?> <?php $this->options->title(); ?>.</span>
            <?php if($this->options->siteBeiAn): ?>
            <span><a rel="external nofollow" target="_blank" href="https://beian.miit.gov.cn/"><?php $this->options->siteBeiAn(); ?></a></span>
            <?php endif ?>
            <?php if($this->options->siteFooterHtml): ?>
            <span><?php $this->options->siteFooterHtml(); ?></span>
            <?php endif ?>
        </div>
        <div class="px-2">
            <span>Powered by <a href="http://typecho.org" rel="external nofollow" target="_blank">Typecho</a>. Theme by <a rel="external nofollow" href="https://xiaoa.me" target="_blank">XaInk</a></span>
        </div>
    </div>
</footer>
</body>
<?php $this->footer(); ?>
</html>