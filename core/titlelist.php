<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php if ($this->have()): ?>
<?php
$posts = xaGetAllPostByCategory($this->mid);
$postIdx = 1;
?>
    <ul class=" grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <?php foreach ($posts as $post): ?>
        <li itemscope itemtype="http://schema.org/BlogPosting">
            <div class="xa-title" itemprop="name headline">
                <a href="<?php echo $post['permalink']; ?>" title="<?php echo $post['title']; ?>"><?php echo $postIdx; $postIdx++; ?> . <?php echo $post['title']; ?></a>
            </div>
        </li>
    <?php endforeach; ?>
    </ul>
<?php else: ?>
    <ul><li class="mb-8 flex justify-center items-center h-32">博主很懒，当前还没有文章!</li></ul>
<?php endif; ?>
