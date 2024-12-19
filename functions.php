<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
error_reporting(0);

use \Typecho\Widget\Helper\Form\Element\Text;
use \Typecho\Widget\Helper\Form\Element\Checkbox;
use \Typecho\Widget\Helper\Form\Element\Radio;
use \Typecho\Widget\Helper\Form\Element\Textarea;

require_once('core/utils.php');
require_once('core/like.php');

function themeConfig($form)
{
    $logoUrl = new Text(
        'logoUrl',
        null,
        null,
        _t('站点LOGO地址'),
        _t('站点LOGO地址, 建议大小比例为202*66, 为空则显示asset/images/logo.png')
    );

    $form->addInput($logoUrl);

    $faviconUrl = new Text(
        'faviconUrl',
        null,
        null,
        _t('站点favicon图标地址'),
        _t('站点favicon图标, 为空则不显示')
    );

    $form->addInput($faviconUrl);

    $authorAvatar = new Text(
        'authorAvatar',
        null,
        null,
        _t('自定义头像'),
        _t('作者显示的头像，为空则使用email显示头像')
    );
    $form->addInput($authorAvatar);

    $authorSign = new Text(
        'authorSign',
        null,
        null,
        _t('签名'),
        _t('作者签名，为空则显示博客站点描述')
    );
    $form->addInput($authorSign);

    $authorProfile = new Text(
        'authorProfile',
        null,
        null,
        _t('作者简介'),
        _t('作者自我简介')
    );
    $form->addInput($authorProfile);

    $authorWechat = new Text(
        'authorWechat',
        null,
        null,
        _t('微信'),
        _t('微信用户名')
    );
    $form->addInput($authorWechat);

    $authorQQ = new Text(
        'authorQQ',
        null,
        null,
        _t('QQ'),
        _t('QQ号')
    );
    $form->addInput($authorQQ);

    $authorEmail = new Text(
        'authorEmail',
        null,
        null,
        _t('联系Email'),
        _t('联系Email')
    );
    $form->addInput($authorEmail);


    $authorGithub = new Text(
        'authorGithub',
        null,
        null,
        _t('Github'),
        _t('Github用户名')
    );
    $form->addInput($authorGithub);

    $authorWeibo = new Text(
        'authorWeibo',
        null,
        null,
        _t('微博'),
        _t('微博用户名')
    );
    $form->addInput($authorWeibo);

    $authorTwitter = new Text(
        'authorTwitter',
        null,
        null,
        _t('Twitter'),
        _t('Twitter用户名')
    );
    $form->addInput($authorTwitter);

    $authorTelegram = new Text(
        'authorTelegram',
        null,
        null,
        _t('Telegram'),
        _t('Telegram用户名')
    );
    $form->addInput($authorTelegram);

    $authorInstagram = new Text(
        'authorInstagram',
        null,
        null,
        _t('Instagram'),
        _t('Instagram用户名')
    );
    $form->addInput($authorInstagram);

    $siteBeiAn = new Text(
        'siteBeiAn',
        null,
        null,
        _t('网站备案号'),
        _t('网站备案号')
    );
    $form->addInput($siteBeiAn);


    $sidebarBlock = new Checkbox(
        'sidebarBlock',
        [
            'ShowPopularArticles' => _t('显示最热文章'),
            'ShowRecentComments' => _t('显示最新评论'),
            'ShowArchive' => _t('显示归档'),
            'PopularTags' => _t('显示热门标签'),
        ],
        ['ShowPopularArticles', 'ShowRecentComments', 'ShowArchive', 'PopularTags'],
        _t('侧边栏显示'),
        _t('默认显示最热文章,最新评论,归档,热门标签')
    );
    $form->addInput($sidebarBlock->multiMode());

    $enablePostCopyright = new Radio(
        "enablePostCopyright",
        [
            "yes" => _t("开启"),
            "no" => _t("关闭"),
        ],
        "no",
        _t("启用文章版权显示，转载文章请添加来源url到自定义copy_link字段"),
        _t("默认关闭")
    );
    $form->addInput($enablePostCopyright);

    $siteFooterHtml = new Textarea(
        'siteFooterHtml',
        null,
        null,
        _t('底部自定义html'),
        _t('底部自定义html')
    );
    $form->addInput($siteFooterHtml);

    $menuCategoryNum = new Text(
        'menuCategoryNum',
        null,
        6,
        _t('目录显示的分类数(包括首页)，超过使用更多下拉，更多只显示一级分类'),
        _t('太多的分类显示不好看，默认6个')
    );
    $form->addInput($menuCategoryNum);

    $categoryIconSvg = new Textarea(
        'categoryIconSvg',
        null,
        null,
        _t('分类对应图标SVG，每行一个，id|svg，svg的宽高设置为16'),
        _t('所有分类：'.xaGetCategoryies())
    );
    $form->addInput($categoryIconSvg);

    $categoryListStyle = new Text(
        'categoryListStyle',
        null,
        null,
        _t('有子目录则显示子目录的列表，没子目录则显示文章的标题列表，列表ID(多个用半角,分隔)：1,2'),
        _t('一般用于小说目录页，所有分类：'.xaGetCategoryies())
    );
    $form->addInput($categoryListStyle);

    $headerStatJs = new Textarea(
        'headerStatJs',
        null,
        null,
        _t('头部统计JS'),
        _t('头部统计JS，不用带script标签')
    );
    $form->addInput($headerStatJs);
}

/**
 * 文章与独立页自定义缩略图字段
 */
function themeFields(Typecho_Widget_Helper_Layout $layout)
{
    $thumbnail = new Typecho_Widget_Helper_Form_Element_Text(
        "thumbnail",
        null,
        null,
        _t("缩略图"),
        _t("输入一个图片 url，作为缩略图显示在文章列表，没有则不显示")
    );
    $layout->addItem($thumbnail);

    $copy_link = new Typecho_Widget_Helper_Form_Element_Text(
        "copy_link",
        null,
        null,
        _t("转发来源"),
        _t("输入转发来源的 url，原创则保持为空")
    );
    $layout->addItem($copy_link);
}