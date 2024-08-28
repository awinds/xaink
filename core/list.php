<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<ul>
<?php if ($this->have()): ?>
    <?php while ($this->next()): ?>
    <li class="mb-8" itemscope itemtype="http://schema.org/BlogPosting">
        <h3 class="xa-title text-lg mb-2" itemprop="name headline"><a class="underline underline-offset-4" href="<?php $this->permalink(); ?>" title="<?php $this->title(); ?>"><?php $this->title(); ?></a></h3>
        <div class="flex items-center justify-between">
            <?php if ($thumbnail = xaGetThumbnail($this->cid, "")): ?>
            <meta itemprop="image" content="<?php echo $thumbnail; ?>"/>
            <div class="xa-thumb pr-4">
                <img src="<?php echo $thumbnail; ?>" data-original="<?php echo $thumbnail; ?>" alt="<?php $this->title(); ?>" class="lazy object-cover border border-gray-200">
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
                <?php if(xaPluginIsActivated('Sticky') && $this->istop): ?><i class="text-sm" title="置顶"><svg  xmlns="http://www.w3.org/2000/svg"  width="16"  height="16"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-ad-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-10 0a10 10 0 1 0 20 0a10 10 0 1 0 -20 0" /><path d="M7 15v-4.5a1.5 1.5 0 0 1 3 0v4.5" /><path d="M7 13h3" /><path d="M14 9v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" /></svg></i><?php endif; ?>
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
