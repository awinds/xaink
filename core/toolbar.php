<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!-- 左侧功能栏 -->
<div class="xa-left-bar w-32 fixed left-0 top-1/2 transform -translate-y-1/2 hidden md:block">
    <div class="xa-left-bar-panel flex flex-col justify-center items-center space-y-4" style="display: none;">
        <div class="xa-left-bar-item flex flex-col justify-center items-center">
            <a title="评论" class="xa-button flex justify-center items-center" href="<?php $this->permalink() ?>#<?php $this->respondId(); ?>">
                <i class="ti ti-message"></i>
            </a>
            <div><?php $this->commentsNum('0', '1', '%d'); ?></div>
        </div>
        <div class="xa-left-bar-item flex flex-col justify-center items-center xa-">
            <?php $likeInfo = xaGetLikeExistAndNum($this->cid); ?>
            <?php if($likeInfo['exist']): ?>
                <a title="取消" class="xa-left-bar-btn-exist xa-button xa-like flex justify-center items-center" href="javascript:;" data-cid="<?php $this->cid(); ?>" onclick="doLike('<?php $this->cid(); ?>');">
                    <i class="ti ti-thumb-up"></i>
                </a>
                <div id="likeNum" class="xa-left-bar-text-exist"><?php echo $likeInfo['num'] ?></div>
            <?php else: ?>
                <a title="点赞" class="xa-button xa-like flex justify-center items-center" href="javascript:;" data-cid="<?php $this->cid(); ?>" onclick="doLike('<?php $this->cid(); ?>');">
                    <i class="ti ti-thumb-up"></i>
                </a>
                <div id="likeNum"><?php echo $likeInfo['num'] ?></div>
            <?php endif; ?>
            <input type="hidden" id="likeExist" value="<?php echo ($likeInfo['exist']) ? "1" : "0"; ?>" />
        </div>
        <div class="xa-left-bar-item flex flex-col justify-center items-center relative">
            <a id="postShare" class="xa-button flex justify-center items-center">
                <i class="ti ti-share-3"></i>
            </a>
            <div id="qrcodePopup" class="xa-theme xa-post-share hidden absolute top-0 left-12 w-48 h-48 rounded-lg shadow-md p-4" style="z-index: 9999;">
                <img src="" alt="扫码查看" class="w-full h-full object-contain">
            </div>
            <div>分享</div>
        </div>
    </div>
</div>

