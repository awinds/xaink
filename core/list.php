<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<ul>
<?php if ($this->have()): ?>
    <?php while ($this->next()): ?>
    <li class="mb-8" itemscope itemtype="http://schema.org/BlogPosting">
        <h3 class="xa-title text-lg mb-2" itemprop="name headline"><a href="<?php $this->permalink(); ?>" title="<?php $this->title(); ?>"><?php $this->title(); ?></a></h3>
        <div class="flex items-center justify-between">
            <?php if ($thumbnail = xaGetThumbnail($this->cid, "")): ?>
            <meta itemprop="image" content="<?php echo $thumbnail; ?>"/>
            <div class="xa-thumb pr-4">
                <img src="<?php echo $thumbnail; ?>" data-original="<?php echo $thumbnail; ?>" alt="<?php $this->title(); ?>" class="lazy object-cover">
            </div>
            <?php endif; ?>
            <div class="xa-content flex-1 flex flex-col justify-between h-full">
                <div class="max-h-16 line-clamp-3 break-all" itemprop="abstract">
                    <span class="pr-2 text-gray-400"><?php echo xaGetCustomDate($this->created) ?></span>
                    <?php $this->excerpt(300, "..."); ?>
                </div>
                <div class="text-sm text-gray-500 mt-1">
                <?php $this->category(" | ", true, "默认"); ?>
                - <a itemprop="discussionUrl" href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('去评论', '1人评论', '%d人评论'); ?></a>
                <?php if(xaPluginIsActivated('Stat')): ?> - <?php $this->stat(); ?>人浏览<?php endif; ?>
                <?php if(xaPluginIsActivated('Sticky') && $this->istop): ?> - 推广 <?php endif; ?>
                </div>
                <div class="hidden" itemprop="author" itemscope itemtype="https://schema.org/Person">
                    <meta itemprop="url" content="<?php $this->author->permalink(); ?>"/>
                     <a itemprop="url" href="<?php $this->author->permalink(); ?>"><span itemprop="name"><?php $this->author->screenName(); ?></span></a>
                </div>
            </div>
        </div>
    </li>
    <?php endwhile; ?>
<?php else: ?>
<li class="mb-8 flex justify-center items-center h-32">博主很懒，当前还没有文章!</li>
<?php endif; ?>
</ul>
