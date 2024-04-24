<?php
/**
 * 普通页面
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

if (isset($_POST['action'])
    && isset($_POST['func'])
    && ($_POST['func'] == 'add' or $_POST['func'] == 'reduce')
    && isset($_POST['cid'])
    && $_POST['action'] == 'like') {
    //  判断 POST 请求中的 cid 是否是本篇文章的 cid
    if ($_POST['cid'] == $this->cid) {
        $return = array('result' => 0, 'message' => '点赞成功');
        if ($_POST['func'] == 'add') {
            $flag = xaAddLike($_POST['cid']);
            if (!$flag) {
                $return['result'] = 1;
            }
            exit(json_encode($return));
        } else if ($_POST['func'] == 'reduce') {
            $flag = xaReduceLike($_POST['cid']);
            $return['message'] = '取消成功';
            if (!$flag) {
                $return['result'] = 1;
            }
            exit(json_encode($return));
        }
    }
    exit(array('result' => -1, 'message' => '请求错误'));
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
        <div id="main-center" class="flex-1 mx-1 lg:mr-12 lg:ml-32" itemscope itemtype="https://schema.org/NewsArticle">
            <!-- 我的链接 -->
            <!-- <h2 class="py-4" itemprop="name headline"><?php $this->title(); ?></h2> -->
            <div class="xa-theme xa-post-content" itemprop="articleBody">
                <?php $this->content(); ?>
            </div>
            <!--分隔线-->
            <div class="xa-space-line"></div>
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
                    console.log('add',data.message);
                }
                else if(func == 'reduce') {
                    $('#likeNum').text(parseInt(val) - 1);
                    $('.xa-like').removeClass('xa-left-bar-btn-exist');
                    $('.xa-like').attr('title',"点赞");
                    $('#likeNum').removeClass('xa-left-bar-text-exist');
                    $('#likeExist').val("0");
                    console.log('reduce',data.message);
                }
            }
        }, "json");
    }
</script>
