<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
if (isset($_POST['action'])
    && isset($_POST['func'])
    && ($_POST['func'] == 'add' or $_POST['func'] == 'reduce')
    && isset($_POST['cid'])
    && $_POST['action'] == 'like') {
    //  判断 POST 请求中的 cid 是否是本篇文章的 cid
    if ($_POST['cid'] == $this->cid) {
        $return = array('result' => 0,'message' => '点赞成功');
        if ($_POST['func'] == 'add') {
            $flag = xaAddLike($_POST['cid']);
            if(!$flag) {
                $return['result'] = 1;
            }
            exit(json_encode($return));
        }
        else if($_POST['func'] == 'reduce') {
            $flag = xaReduceLike($_POST['cid']);
            $return['message'] = '取消成功';
            if(!$flag) {
                $return['result'] = 1;
            }
            exit(json_encode($return));
        }
    }
    exit(array('result' => -1,'message' => '请求错误'));
}
?>
<?php $this->need("header.php"); ?>
<!-- 主体 -->
<main id="main" class="mx-auto">
    <!-- 分类 -->
    <?php $this->need("core/menu.php"); ?>
    <!-- 内容 -->
    <div class="w-full flex justify-between mt-4 px-4 lg:px-1">
        <?php $this->need("core/toolbar.php"); ?>
        <!-- 列表 -->
        <div id="main-center" class="flex-1 mx-1 lg:mr-12 lg:ml-32">
            <!-- 文章 -->
            <div class="xa-post" itemscope itemtype="https://schema.org/NewsArticle">
                <div class="xa-post-title xa-theme" itemprop="name headline">
                    <?php $this->title(); ?>
                </div>
                <div class="xa-post-info justify-start items-center w-full space-x-2">
                    <span><?php $this->category(" | ", true, "默认"); ?></span>
                    <span itemprop="datePublished"><?php echo xaGetCustomDate($this->created) ?></span>
                    <?php if(xaPluginIsActivated('Stat')): ?>
                    <span><?php $this->stat(); ?>人浏览</span>
                    <?php endif; ?>
                    <span class="hidden" itemprop="author" itemscope itemtype="https://schema.org/Person">
                    <meta itemprop="url" content="<?php $this->author->permalink(); ?>"/>
                    <a itemprop="url" href="<?php $this->author->permalink(); ?>">
                        <span itemprop="name"><?php $this->author->screenName(); ?></span>
                    </a>
                    </span>
                </div>
                <div class="xa-theme xa-post-content" itemprop="articleBody">
                    <?php $this->content(); ?>
                </div>
                <div class="xa-post-tag">
                    <h2 class="xa-post-h2">标签</h2>
                    <div class="flex space-x-4">
                        <?php $this->tags(" ", true, ""); ?>
                    </div>
                </div>
                <!-- 文章版权说明-->
                <?php if (xaGetOptionValue("enablePostCopyright", "no") === "yes"): ?>
                    <?php if (($this->fields->copy_link) == ''): ?>
                        <div class="xa-post-copy border-gray-200 border rounded-2xl break-words px-5 py-5 flex flex-col space-y-1">
                            <span><i class="ti ti-user-circle"></i>版权属于：<?php $this->author(); ?></span>
                            <span><i class="ti ti-link"></i>本文链接：<a href="<?php $this->permalink();?>"><?php $this->permalink();?></a></span>
                            <span><i class="ti ti-share"></i>转载申明：转载请保留本文转载地址，著作权归作者所有。</span>
                        </div>
                    <?php else: ?>
                        <div class="post-copyright" style="word-wrap: break-word; border-radius: 10px; border: 1px solid #ddd; padding: 20px;">
                            <span><i class="ti ti-link"></i>本文链接：<a href="<?php $this->permalink();?>"><?php $this->permalink();?></a></span>
                            <span><i class="ti file-description"></i>免责声明：本文主要内容转载自【<a target="_blank" rel="external noopener noreferrer nofollow" href="<?php echo $this->fields->copy_link;?>" title="文章来源 <?php echo $this->fields->copy_link;?>"><?php echo $this->fields->copy_link;?></a>】，仅用于学习和交流，若有侵权请邮件联系本站！</span>
                        </div>
                    <?php endif;?>
                <?php endif; ?>
                <div class="xa-space-line"></div>
            </div>
            <!-- 评论 -->
           <?php $this->need('comments.php'); ?>
        </div>
        <!-- 右侧栏 -->
        <?php $this->need('sidebar.php'); ?>
    </div>
</main>
<?php $this->need('footer.php'); ?>
<script type="text/javascript" src="<?php $this->options->themeUrl("assets/js/jr-qrcode.js?v=" . xaGetVersion()); ?>"></script>
<script type="text/javascript">
$('#qrcodePopup img').attr("src",jrQrcode.getQrBase64('<?php $this->permalink(); ?>',{
    padding: 5,
    width : 200,
    height : 200,
}));
function doLike(cid) {
    var func = "add";
    if($('#likeExist').val() == "1") {
        func = "reduce";
    }
    $.post("<?php $this->permalink(); ?>", {"action":'like',"func":func,"cid": cid},function(data){
        if(data.result == 0){
            var val = $('#likeNum').text();
            if(func == 'add') {
                $('#likeNum').text(parseInt(val) + 1);
                $('.xa-like').addClass('xa-left-bar-btn-exist');
                $('.xa-like').attr('title',"取消");
                $('#likeNum').addClass('xa-left-bar-text-exist');
                $('#likeExist').val("1");
            }
            else if(func == 'reduce') {
                $('#likeNum').text(parseInt(val) - 1);
                $('.xa-like').removeClass('xa-left-bar-btn-exist');
                $('.xa-like').attr('title',"点赞");
                $('#likeNum').removeClass('xa-left-bar-text-exist');
                $('#likeExist').val("0");
            }
        }
    }, "json");
}
</script>
