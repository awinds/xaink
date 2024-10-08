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
                <div class="xa-theme xa-post-content" id="xa-post-content" itemprop="articleBody">
                    <?php $this->content(); ?>
                </div>
                <div class="xa-post-tag">
                    <h2 class="xa-post-h2">标签</h2>
                    <div class="flex flex-wrap gap-4">
                        <?php $this->tags(" ", true, ""); ?>
                    </div>
                </div>
                <!-- 文章版权说明-->
                <?php if (xaGetOptionValue("enablePostCopyright", "no") === "yes"): ?>
                    <?php if (($this->fields->copy_link) == ''): ?>
                        <div class="xa-post-copy border-gray-200 border rounded-2xl break-words px-5 py-5 flex flex-col space-y-1">
                            <span class="flex items-center break-all"><svg  xmlns="http://www.w3.org/2000/svg"  width="16"  height="16"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg><span class="whitespace-nowrap mr-1">版权属于:</span><?php $this->author(); ?></span>
                            <span class="flex items-center break-all"><svg  xmlns="http://www.w3.org/2000/svg"  width="16"  height="16"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-link"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 15l6 -6" /><path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" /><path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" /></svg><span class="whitespace-nowrap mr-1">本文链接:</span><a href="<?php $this->permalink();?>"><?php $this->permalink();?></a></span>
                            <span class="flex items-center break-all"><svg  xmlns="http://www.w3.org/2000/svg"  width="16"  height="16"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-share"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M18 6m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M8.7 10.7l6.6 -3.4" /><path d="M8.7 13.3l6.6 3.4" /></svg><span class="whitespace-nowrap mr-1">转载申明:</span>转载请保留本文转载地址，著作权归作者所有。</span>
                        </div>
                    <?php else: ?>
                        <div class="post-copyright" style="word-wrap: break-word; border-radius: 10px; border: 1px solid #ddd; padding: 20px;">
                            <span class="flex items-center break-all"><svg  xmlns="http://www.w3.org/2000/svg"  width="16"  height="16"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-link"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 15l6 -6" /><path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" /><path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" /></svg><span class="whitespace-nowrap mr-1">本文链接:</span><a href="<?php $this->permalink();?>"><?php $this->permalink();?></a></span>
                            <span class="flex items-center break-all"><svg  xmlns="http://www.w3.org/2000/svg"  width="16"  height="16"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-description"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 17h6" /><path d="M9 13h6" /></svg><span class="whitespace-nowrap mr-1">免责声明:</span>本文主要内容转载自【<a target="_blank" rel="external noopener noreferrer nofollow" href="<?php echo $this->fields->copy_link;?>" title="文章来源 <?php echo $this->fields->copy_link;?>"><?php echo $this->fields->copy_link;?></a>】，仅用于学习和交流，若有侵权请邮件联系本站！</span>
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
