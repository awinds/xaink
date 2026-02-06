<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
use Typecho\Plugin;
use Utils\Helper;
use Widget\Options;
use Typecho\Widget;
/**
 * 获取主题版本号
 */
function xaGetVersion()
{
    $info = Plugin::parseInfo(Helper::options()->themeFile(Helper::options()->theme, "index.php"));
    return $info["version"];
}

/**
 * 插件是否激活
 * @param $name
 * @return bool
 */
function xaPluginIsActivated($name)
{
    $plugins = Typecho_Plugin::export();
    $plugins = $plugins["activated"];
    return is_array($plugins) && array_key_exists($name, $plugins);
}

/**
 * 获取配置选项值，无法获取则返回默认值数据
 * @param $name     选项名
 * @param $default 默认值
 */
function xaGetOptionValue($name, $default)
{
    return Helper::options()->$name ? Helper::options()->$name : $default;
}


/**
 * 输出所有分类
 * @return string
 */
function xaGetCategoryies()
{
    $db = Typecho_Db::get();
    $prow = $db->fetchAll(
        $db
            ->select()
            ->from("table.metas")
            ->where("type = ?", "category")
    );
    $text = "";
    foreach ($prow as $item) {
        $text .= $item["name"] . "(" . $item["mid"] . ")" . "&nbsp;&nbsp;&nbsp;&nbsp;";
    }
    return $text;
}


/**
 * 判断是否是定义的列表分类
 * @param $mid
 * @return bool
 */
function xaIsListCategory($mid) {
    $list = Helper::options()->categoryListStyle;
    if (empty($list)) {
        return false;
    }
    $lists = explode(',',$list);
    if (in_array($mid, $lists)) {
        return true;
    }
    return false;
}

/**
 * 获取作者自定义头像
 * @param $authorMail
 */
function xaGetAuthorAvatar($authorMail)
{
    if(Helper::options()->authorAvatar) {
        return Helper::options()->authorAvatar;
    }
    else {
        return xaGetAvatar($authorMail);
    }
}

/**
 * 获取邮箱头像
 * @param $email
 */
function xaGetAvatar($email)
{
    $email = strtolower($email);
    $qq = str_replace('@qq.com','',$email);
    $imgUrl = 'https://cravatar.cn/avatar/none';
    if(stristr($email,'@qq.com') && is_numeric($qq) && strlen($qq)<11 && strlen($qq)>4 ){
        $imgUrl = "https://q1.qlogo.cn/g?b=qq&nk=". $qq."&s=100";
        return $imgUrl;
    }else{
        $email = md5(strtolower($email));
        $url = 'https://cravatar.cn/avatar/';
        if (defined('__TYPECHO_GRAVATAR_PREFIX__')) {
            $url = __TYPECHO_GRAVATAR_PREFIX__;
        }
        $imgUrl = $url.$email;
    }
    return $imgUrl;
}

/**
 * 通过id获取分类的svg图标
 * @param $mid
 * @return string
 */
function xaGetCategorySvg($mid)
{
    $icons = trim(Helper::options()->categoryIconSvg);
    $lines = preg_split('/\r\n|\r|\n/', $icons);
    foreach ($lines as $line) {
        $conts = explode('|',$line);
        if (count($conts) != 2) {
            continue;
        }
        if($conts[0] == $mid && $conts[1] != '') {
            return $conts[1];
        }
    }
    return '';
}

/**
 * 判断当前是菜单否激活
 * @param $self
 * @return string
 */
function xaIsActiveCategory($self, $slug)
{
    if ($self->is("category")) {
        $curSlug = $self->getArchiveSlug();
        if($curSlug === $slug) {
            return true;
        }
        //判断父类
        $db = Typecho_Db::get(); // 获取数据库对象
        // 构造查询语句
        $query = $db->select('A.slug')->from('table.metas as A')
            ->join('table.metas as B','A.mid = B.parent')
            ->where('B.slug = ?', $curSlug)->where('B.type = ?', 'category');
        // 执行查询并获取结果
        $row = $db->fetchRow($query);
        if ($row) {
            if ($row['slug'] === $slug) {
                return true;
            }
        }
    }

    if ($self->is("post") && in_array($slug, array_column($self->categories, "slug"))) {
        return true;
    }

    return false;
}


/**
 * 获取子分类
 * @param $mid
 * @return mixed
 */
function xaGetChildCategory($mid)
{
    $db = Typecho_Db::get(); // 获取数据库对象
    // 构造查询语句
    $query = $db->select()->from('table.metas')
        ->where('type = ?', 'category')
        ->where('parent = ?', $mid);
    // 执行查询并获取结果
    $row = $db->fetchAll($query);
    if ($row) {
        return $row;
    }
    return null;
}

/**
 * 获取数组或对象中的值 1.3.0 新增兼容1.2.1
 */
function xaGetPageRowValue($data, $key, $default = '') {
    if (is_array($data)) {
        return isset($data[$key]) ? $data[$key] : $default;
    } elseif (is_object($data)) {
        return isset($data->$key) ? $data->$key : $default;
    }
    return $default;
}

/**
 * 获取子分类（返回数组）1.3.0 新增
 * @param $parentMid
 */
function xaGetCategoryChildren($parentMid) {
    $children = [];
    $all = Widget::widget('Widget\Metas\Category\Rows');
    
    if ($all) {
        while ($all->next()) {
            if ((int)$all->parent === (int)$parentMid) {
                $children[] = [
                    'mid'   => (int)$all->mid,
                    'name'  => $all->name,
                    'permalink'   => $all->permalink,
                    'count' => (int)$all->count,
                    'description' => $all->description
                ];
            }
        }
    }
    
    return $children;
}

/**
 * 获取文章自定义字段
 * @param $cid            文章id
 * @param $filedNames     字段名
 */
function xaGetPostField($cid, $filedName)
{
    $db = Typecho_Db::get();
    $field = $db->fetchRow(
        $db
            ->select()
            ->from("table.fields")
            ->where("cid = ? and name = ?", $cid, $filedName)
    );
    return $field;
}


/**
 * 获取文章缩略图
 * @param $cid      文章 id
 * @return string   图片 url
 */
function xaGetThumbnail($cid, $defaultThumbnail)
{
    $filed = xaGetPostField($cid, "thumbnail");
    if (empty($filed)) {
        return $defaultThumbnail;
    }
    $thumbnail = $filed[$filed["type"] . "_value"];
    // 使用自定义字段，设置缩略图
    if (!empty($thumbnail)) {
        return $thumbnail;
    }
    return $defaultThumbnail;
}

/**
 * 人性化日期
 * @param int $created 日期
 * @return string   xx 前
 */
function xaGetCustomDate($created)
{
    if (Helper::options()->timeFormat != "") {
        return date(Helper::options()->timeFormat, $created);
    } else {
        //计算时间差
        $diff = time() - $created;
        $d = floor($diff / 3600 / 24);
        $Y = date("Y", $created);
        //输出时间
        if (date("Y-m-d", $created) == date("Y-m-d")) {
            return "今天";
        } elseif ($d <= 1) {
            return "昨天";
        } elseif ($d == 2) {
            return "前天";
        } elseif ($d <= 31) {
            return $d . " 天前";
        } elseif ($Y == date("Y")) {
            return date("m-d", $created);
        } else {
            return date("Y-m-d", $created);
        }
    }
}

/**
 * 获取热门文章
 * @param $limit
 * @return mixed
 */
function xaGetHotPosts($limit = 10)
{
    $db = Typecho_Db::get();
    $select  = $db->select()->from('table.contents')
        ->where("table.contents.password IS NULL OR table.contents.password = ''")
        ->where('table.contents.status = ?','publish')
        ->where('table.contents.created <= ?', time())
        ->where('table.contents.type = ?', 'post')
        ->limit($limit)
        ->order('table.contents.commentsNum', Typecho_Db::SORT_DESC);
    $result = $db->fetchAll($select, array(Typecho_Widget::widget('Widget_Abstract_Contents'), 'push'));
    return $result;
}

/**
 * 该分类下所有文章
 * @param $mid
 * @return mixed
 */
function xaGetAllPostByCategory($mid) {
    $db = Typecho_Db::get();
    $select = $db->select()->from('table.contents')
        ->join('table.relationships', 'table.contents.cid = table.relationships.cid')
        ->where('table.relationships.mid = ?', $mid)
        ->order('table.contents.created', Typecho_Db::SORT_ASC);
    $posts = $db->fetchAll($select, array(Typecho_Widget::widget('Widget_Abstract_Contents'), 'push'));
    return $posts;
}

/**
 * 按年份归档文章（兼容 Typecho 1.2 和 1.3）
 * @return array 归档数据，结构: [年 => [时间戳 => 文章信息]]
 */
function xaGetArchives() {
    $stat = [];
    $total = Widget::widget('Widget\Stat')->publishedPostsNum;
    $posts = Widget::widget('Widget\Contents\Post\Recent', [
        'pageSize' => max(1, $total),
        'limit'    => 0
    ]);

    while ($posts->next()) {
        $categories = [];
        // === 兼容处理：判断 categories 是数组还是对象 ===
        if (is_array($posts->categories)) {
            foreach ($posts->categories as $cat) {
                $categories[] = [
                    'mid'   => isset($cat['mid']) ? (int)$cat['mid'] : 0,
                    'name'  => isset($cat['name']) ? $cat['name'] : '',
                    'slug'  => isset($cat['slug']) ? $cat['slug'] : '',
                    'permalink'   => isset($cat['permalink']) ? $cat['permalink'] : '#'
                ];
            }
        } else {
            while ($posts->categories->next()) {
                $categories[] = [
                    'mid'   => (int)$posts->categories->mid,
                    'name'  => $posts->categories->name,
                    'slug'  => $posts->categories->slug,
                    'permalink'   => $posts->categories->permalink
                ];
            }
            if (method_exists($posts->categories, 'reset')) {
                $posts->categories->reset();
            }
        }

        $arr = [
            'cid'        => $posts->cid,
            'title'      => $posts->title,
            'categorys'  => $categories,
            'permalink'  => $posts->permalink,
            'created'    => $posts->created
        ];

        $year = date('Y', $posts->created);
        $stat[$year][$posts->created] = $arr;
    }

    return $stat;
}

/**
 * 评论作者
 * @param $obj
 * @param $autoLink
 * @param $noFollow
 * @return mixed
 */
function xaGetCommentAuthor($obj, $autoLink = null, $noFollow = null)
{
    $options = Helper::options();
    $autoLink = $autoLink ? $autoLink : $options->commentsShowUrl;
    $noFollow = $noFollow ? $noFollow : $options->commentsUrlNofollow;
    if ($obj->url && $autoLink) {
        $htm = '<a href="'.$obj->url.'"';
        $htm .= $noFollow ? ' rel="external nofollow"' : '';
        $htm .= strstr($obj->url, $options->index) == $obj->url ? '' : ' target="_blank"';
        $htm .= '>' . $obj->author . '</a>';
        return $htm;
    } else {
        return $obj->author;
    }
}

/**
 * 评论添加 @
 * @param $coid
 * @return string
 */
function xaGetCommentReplyAt($coid)
{
    $db = Typecho_Db::get();
    $row = $db->fetchRow(
        $db->select("parent")
            ->from("table.comments")
            ->where("coid = ? AND status = ?", $coid, "approved")
    );
    $parent = $row["parent"];
    if ($row && $parent != "0") {
        $srcRow = $db->fetchRow(
            $db->select("author")
                ->from("table.comments")
                ->where("coid = ? AND status = ?", $parent, "approved")
        );
        return "@".$srcRow["author"];
    }
    return '';
}

/**
 * 表情解析
 * @param $content
 * @param $url
 */
function xsCommentParseContent($content){
    return preg_replace('#\@\((.*?)\)#','<img src="'. Helper::options()->themeUrl.'OwO/$1.png" />',$content);
}

/**
 * 获取搜索结果总数
 * @param $keywords
 * @return mixed
 */
function xaGetSearchTotal($keywords)
{
    $db = Typecho_Db::get();
    $query = $db->select('COUNT(*) as qty')->from('table.contents')
        ->where('title LIKE ? OR text LIKE ?', '%' . $keywords . '%', '%' . $keywords . '%')
        ->where("table.contents.password IS NULL OR table.contents.password = ''")
        ->where('type = ? and status = ?', 'post', 'publish');
    $count = $db->fetchRow($query);
    return $count['qty'];
}


/**
 * 检查是否支持utf8mb4
 */
function xaIsUtf8mb4()
{
    $db = Typecho_Db::get();
    $dbconfig = $db->getConfig(Typecho_Db::WRITE);
    if($dbconfig['charset'] === 'utf8mb4') {
        return 'yes';
    }
    return 'no';
}