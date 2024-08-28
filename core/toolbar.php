<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!-- 左侧功能栏 -->
<div class="xa-left-bar w-32 fixed left-0 top-1/2 transform -translate-y-1/2 hidden lg:block">
    <div class="xa-left-bar-panel flex flex-col justify-center items-center space-y-4" style="display: none;">
        <div class="xa-left-bar-item flex flex-col justify-center items-center">
            <a title="评论" class="xa-button flex justify-center items-center" href="<?php $this->permalink() ?>#<?php $this->respondId(); ?>">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-message"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 9h8" /><path d="M8 13h6" /><path d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z" /></svg>
            </a>
            <div><?php $this->commentsNum('0', '1', '%d'); ?></div>
        </div>
        <div class="xa-left-bar-item flex flex-col justify-center items-center xa-">
            <?php $likeInfo = xaGetLikeExistAndNum($this->cid); ?>
            <?php if($likeInfo['exist']): ?>
                <a title="取消" class="xa-left-bar-btn-exist xa-button xa-like flex justify-center items-center" href="javascript:;" data-cid="<?php $this->cid(); ?>" onclick="doLike('<?php $this->cid(); ?>');">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-thumb-up"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 11v8a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-7a1 1 0 0 1 1 -1h3a4 4 0 0 0 4 -4v-1a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 3 0 0 1 -2 2h-7a3 3 0 0 1 -3 -3" /></svg>
                </a>
                <div id="likeNum" class="xa-left-bar-text-exist"><?php echo $likeInfo['num'] ?></div>
            <?php else: ?>
                <a title="点赞" class="xa-button xa-like flex justify-center items-center" href="javascript:;" data-cid="<?php $this->cid(); ?>" onclick="doLike('<?php $this->cid(); ?>');">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-thumb-up"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 11v8a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-7a1 1 0 0 1 1 -1h3a4 4 0 0 0 4 -4v-1a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 3 0 0 1 -2 2h-7a3 3 0 0 1 -3 -3" /></svg>
                </a>
                <div id="likeNum"><?php echo $likeInfo['num'] ?></div>
            <?php endif; ?>
            <input type="hidden" id="likeExist" value="<?php echo ($likeInfo['exist']) ? "1" : "0"; ?>" />
        </div>
        <div class="xa-left-bar-item flex flex-col justify-center items-center relative">
            <a id="postShare" class="xa-button flex justify-center items-center">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-share-3"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13 4v4c-6.575 1.028 -9.02 6.788 -10 12c-.037 .206 5.384 -5.962 10 -6v4l8 -7l-8 -7z" /></svg>
            </a>
            <div id="qrcodePopup" class="xa-theme xa-post-share hidden absolute top-0 left-12 w-48 h-48 rounded-lg shadow-md p-4" style="z-index: 9999;">
                <img src="" alt="扫码查看" class="w-full h-full object-contain">
            </div>
            <div>分享</div>
        </div>
    </div>
</div>

