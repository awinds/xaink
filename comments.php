<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
/**
 * 评论回调函数
 * @param $comments
 * @param $options
 */
function threadedComments($comments, $options)
{
    $commentClass = "";
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= " comment-by-author";
        } else {
            $commentClass .= " comment-by-user";
        }
    }
    ?>
    <li id="<?php $comments->theId(); ?>" class="flex flex-col<?php
    if ($comments->levels > 0) {
        echo " xa-comment-child";
        $comments->levelsAlt(" comment-level-odd", " comment-level-even");
    } else {
        echo " xa-comment-parent";
    }
    $comments->alt(" comment-odd", " comment-even");
    echo $commentClass;
    ?>">
        <div class="flex items-start space-x-4">
            <!-- 头像 -->
            <div class="flex-shrink-0">
                <?php if ($comments->authorId == $comments->ownerId): ?>
                <img data-original="<?php echo xaGetAuthorAvatar($comments->mail); ?>" title="<?php echo $comments->author; ?>" alt="<?php echo $comments->author; ?>" class="lazy w-12 h-12 rounded-full">
                <?php else: ?>
                <img data-original="<?php echo xaGetAvatar($comments->mail); ?>" title="<?php echo $comments->author; ?>" alt="<?php echo $comments->author; ?>" mail="<?php echo $comments->mail; ?>" class="lazy w-12 h-12 rounded-full">
                <?php endif; ?>
            </div>
            <!-- 评论内容 -->
            <div class="flex-1 space-y-2 items-start">
                <!-- 用户名 -->
                <div class="font-bold flex items-center"><?php echo xaGetCommentAuthor($comments); ?><?php if ($comments->authorId == $comments->ownerId): ?><i title="作者" class="flex"><svg  xmlns="http://www.w3.org/2000/svg"  width="16"  height="16"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" /><path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" /></svg></i><?php endif; ?></div>
                <!-- 内容 -->
                <?php if ($comments->status == "waiting"): ?>
                <div>您的评论正等待审核！</div>
                <?php else: ?>
                <div class="break-all"><?php if($comments->parent != "0"): ?><span class="pr-2 font-bold float-left"><?php echo xaGetCommentReplyAt($comments->coid); ?></span><?php endif; ?><?php echo xsCommentParseContent($comments->content); ?></div>
                <?php endif; ?>
                <!-- 评论时间和回复按钮 -->
                <div class="flex items-center justify-between text-sm text-gray-500">
                    <div>
                        <?php echo xaGetCustomDate($comments->created); ?>
                        <?php if(xaPluginIsActivated('XQLocation')): ?>
                            - <?php XQLocation_Plugin::render($comments->ip); ?>
                        <?php endif; ?>
                    </div>
                    <div id="reply-<?php $comments->theId(); ?>" class="flex justify-end px-0" style="width: 110px;" data-author="<?php echo $comments->author; ?>">
                        <button class="xa-comment-reply" title="取消回复" onclick="TypechoComment.customCancelReply('<?php $comments->theId(); ?>');">
                            <?php $comments->cancelReply("<svg  xmlns=\"http://www.w3.org/2000/svg\"  width=\"16\"  height=\"16\"  viewBox=\"0 0 24 24\"  fill=\"none\"  stroke=\"currentColor\"  stroke-width=\"2\"  stroke-linecap=\"round\"  stroke-linejoin=\"round\"  class=\"icon icon-tabler icons-tabler-outline icon-tabler-message\"><path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"/><path d=\"M8 9h8\" /><path d=\"M8 13h6\" /><path d=\"M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z\" /></svg>取消回复"); ?>
                        </button>
                        <button class="xa-comment-reply" title="回复">
                            <?php $comments->reply("<svg  xmlns=\"http://www.w3.org/2000/svg\"  width=\"16\"  height=\"16\"  viewBox=\"0 0 24 24\"  fill=\"none\"  stroke=\"currentColor\"  stroke-width=\"2\"  stroke-linecap=\"round\"  stroke-linejoin=\"round\"  class=\"icon icon-tabler icons-tabler-outline icon-tabler-message\"><path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"/><path d=\"M8 9h8\" /><path d=\"M8 13h6\" /><path d=\"M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z\" /></svg>回复"); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($comments->children): ?>
            <div class="xa-comment-children">
            <?php $comments->threadedComments($options); ?>
            </div>
        <?php endif; ?>
    </li>
<?php } ?>

<div class="xa-comment" id="comments">
    <h2 class="xa-comment-h2">评论 <span><?php $this->commentsNum('', '1', '%d'); ?></span></h2>
    <?php $this->comments()->to($comments); ?>
    <?php if ($this->allow("comment")): ?>
    <div id="<?php $this->respondId(); ?>" class="py-2">
        <!-- 输入表单开始 -->
        <form method="post" action="<?php $this->commentUrl() ?>">
                <!-- 如果当前用户已经登录 -->
            <?php if($this->user->hasLogin()): ?>
            <div class="flex items-center space-x-4">
                <!-- 头像 -->
                <div>
                    <img src="<?php echo xaGetAuthorAvatar($this->author->mail); ?>" alt="<?php $this->author->screenName(); ?>" class="w-14 h-14 rounded-full">
                </div>
                <div>
                    <?php $this->user->screenName(); ?>
                </div>
            </div>
            <?php else: ?>
            <div class="grid grid-cols-3 space-x-2 py-2">
                <!-- 要求输入名字、邮箱、网址 -->
                <input name="author" required type="text"  class="border-[#ced4da] border rounded px-2 py-2 focus:outline-none" placeholder="昵称(必填)" value="<?php $this->remember('author'); ?>">
                <input name="mail" required type="text" class="border-[#ced4da] border rounded px-2 py-2 focus:outline-none" placeholder="邮箱(必填)" value="<?php $this->remember('mail'); ?>">
                <input name="url" type="text" class="border-[#ced4da] border rounded px-2 py-2 focus:outline-none" placeholder="网址" value="<?php $this->remember('url'); ?>">
            </div>
            <?php endif; ?>
            <div class="xa-theme xa-comment-public">
                <textarea id="commentTextarea" name="text" required contenteditable="true"  placeholder="发表神评妙论" class="focus:outline-none"><?php $this->remember('text'); ?></textarea>
                <?php $security = $this->widget("Widget_Security"); ?>
                <input type="hidden" name="_" value="<?php echo $security->getToken($this->request->getReferer()); ?>" />
                <span class="flex justify-between items-center px-2 space-x-2 py-1">
                    <div id="OwO" class="xa-theme OwO flex-1 w-full" isEmoji="<?php echo xaIsUtf8mb4();?>"></div>
                    <div class="w-16">
                        <button type="submit" id="commentSubmit" class="px-4 py-1 bg-blue-500 text-white rounded-2xl hover:bg-blue-600 focus:outline-none">发表</button>
                    </div>
                </span>
            </div>
        </form>
    </div>
    <?php else: ?>
    <div class="flex justify-center items-center w-full py-12">不能评论哟</div>
    <?php endif; ?>
    <div class="xa-comment-list">
        <?php if ($comments->have()): ?>
            <?php $comments->listComments(); ?>
            <div class="flex justify-center items-center w-full py-12">没有更多啦</div>
        <?php else: ?>
            <?php if ($this->allow("comment")): ?>
                <div class="flex justify-center items-center w-full py-12">等风等雨等你来</div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<!-- 评论脚本 -->
<script type="text/javascript">
var lastCommentId = '';
window.TypechoComment = {
    dom: function (id) {
        return document.getElementById(id)
    }, create: function (tag, attr) {
        var el = document.createElement(tag);
        for (var key in attr) {
            el.setAttribute(key, attr[key])
        }
        return el;
    }, reply: function (cid, coid) {
        //先把之前的取消回复改成回复
        if(lastCommentId != '') {
            $('#reply-'+lastCommentId+' button a').eq(1).show();
            $('#reply-'+lastCommentId+' button a').eq(0).hide();
        }
        //console.log(cid);
        var comment = this.dom(cid), response = this.dom("<?php $this->respondId(); ?>"),
            input = this.dom("comment-parent"),
            form = "form" == response.tagName ? response : response.getElementsByTagName("form")[0],
            textarea = response.getElementsByTagName("textarea")[0];
        if (null == input) {
            input = this.create("input", {"type": "hidden", "name": "parent", "id": "comment-parent"});
            form.appendChild(input)
        }
        input.setAttribute("value", coid);
        //console.log(form);
        if (null == this.dom("comment-form-place-holder")) {
            var holder = this.create("div", {"id": "comment-form-place-holder"});
            response.parentNode.insertBefore(holder, response);
        }
        comment.appendChild(response);

        $('#reply-'+cid+' button a').eq(0).show();
        $('#reply-'+cid+' button a').eq(1).hide();
        lastCommentId = cid;
        //this.dom("cancel-comment-reply-link").style.display = "";
        //this.dom("cancel-comment-reply-link").className += " xa-button px-4 py-1 bg-blue-500 text-white rounded-2xl hover:bg-blue-600 focus:outline-none";
        //this.dom("cancel-comment-reply-link").style.display = "";

        if (null != textarea && "text" == textarea.name) {
            textarea.focus();
            //console.log($('#reply-'+cid).attr("data-author"))
            textarea.placeholder = "回复" + $('#reply-'+cid).attr("data-author");
        }
        return false;
    }, cancelReply: function () {
        var response = this.dom("<?php $this->respondId(); ?>"), holder = this.dom("comment-form-place-holder"),
            input = this.dom("comment-parent");
        if (null != input) {
            input.parentNode.removeChild(input);
        }
        if (null == holder) {
            return true;
        }
        //this.dom("cancel-comment-reply-link").style.display = "none";

        holder.parentNode.insertBefore(response, holder);
        textarea = response.getElementsByTagName("textarea")[0];
        textarea.placeholder = "发表神评妙论";
        lastCommentId = '';
        return false;
    }, customCancelReply: function (cid) {
        $('#reply-'+cid+' button a').eq(0).hide();
        $('#reply-'+cid+' button a').eq(1).show();
    }
};
</script>