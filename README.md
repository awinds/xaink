# 关于
因为想学习响应式布局练练手，所以萌生了开了一个主题的想法，而我正好在使用百度，何不就做个和百度一样的主题  

Github:[https://github.com/awinds/xaink][1] 

说明：[https://xiaoa.me/archives/theme_xaink.html][5] 

Demo:[https://www.xa.ink][2] 

作者blog:[https://xiaoa.me][6] 

![主题界面][3]

![主题界面][4]

# 特点
 - typecho 1.3
 - 仿百度。
 - 响应式设计，支持明亮和黑暗模式。
 - 文章列表支持缩略图（字定义`thumbnail`），右侧悬停。
 - 支持评论表情`OwO`。
 - 文章和页面直接支持点赞和取消，不使用插件。
 - 支持配置作者个人社交账号显示。
 - 支持配置是否显示文章版权信息。
 - 支持归档页面和友链页面(Links插件支持)。
 
# 插件配合
 - Links插件，可直接生成友链页面
 - Sitemap插件，可生成网站地图
 - Stat插件，可显示文章浏览人数
 - CodeHighlighter插件，可高亮代码
 - Sticky插件，可置顶文章，需做以下修改配合（使用plugins下面带的插件已修改） 
> ```php
> //增加字段,外面可以自定义判断
> $sticky_post['istop'] = 1;
> ```
# 安装 
直接下载 zip 源码->解压后移动到 `Typecho` 主题目录->改名为`xaink`->启用。 

# 设置  
主题设置页面位置：Typecho 后台->控制台->外观->设置外观。 

# 技术栈 
 - 使用[Tailwind CSS](https://www.tailwindcss.cn/) min发布版，不用打包
 - 使用[JQuery](https://jquery.com/)和相关插件 
 - 使用[jr-qrcode](https://github.com/diamont1001/jrQrcode)生成二维码 
 - 使用[OwO](https://github.com/DIYgod/OwO)表情 
 - 使用[tabler](https://tabler.io/icons)图标
 
# License 
Open sourced under the MIT license. 
保留Theme by Xaink，谢谢！

# 更新说明 
## 1.7.0
 1. 支持`Typecho v1.3`。
## 1.6.2
 1. 修改分类页面无法显示分页的`bug`。
## 1.6.1
 1. 修改配置目录数量的`bug`。
## 1.6.0
 1. 增加头部`Open Graph`和`Twitter Card`。
 2. og和twitter Mate信息中，如果有缩略图，则使用缩略图作为image信息。
 3. 增加站点favicon图标地址的配置。
## 1.5.3
 1. 优化文章版权显示效果。
 2. 增加统计代码配置项。
## 1.5.2
 1. 修正page页面无法生成导读的问题。
 2. 友链的a标签rel=nofollow由插件控制。
## 1.5.1
 1. 优化正文内容表格中图片过宽问题和超链接问题。
 2. 优化评论回复和取消回复点击问题。
 3. 优化版权链接换行问题。
## 1.5.0
 1. 修改代码过长没自动换行的问题。
 2. 如果使用高亮插件，要解决换行问题，要改插件中样式`pre[class*="language-"]`中`white-space`值为`pre-wrap`。
 3. 修正暗样式问题。
## 1.4.9
 1. 增加友链的页面插件下载地址。
 2. 打包配套插件到github，目录plugins，可选择使用。
## 1.4.8
 1. 分类目录显示控制数量，增加更多下拉显示一级目录。
 2. 控制台->外观->设置外观->目录显示的分类数。
 3. 优化文章导读的高亮显示颜色。
 4. 优化评论提示显示效果。
## 1.4.7
 1. 分类目录增加自定义设置icon显示(svg)。
 2. 控制台->外观->设置外观->分类对应图标SVG。
## 1.4.6
 1. 评论表情使用Emoji问题修复(在非utf8mb4下不使用Emoji)。
 2. 修改小设备上按钮显示问题。
 3. 调整手机设备上回复评论显示效果。
## 1.4.5
 1. 替换icons的`<i>`直接使用`svg`,省掉字体的加载。
## 1.4.4
 1. 感谢`atk2024`反馈的问题。
 2. 修改网站描述写太长，头像变形问题。
 3. 修改php8环境下，搜索界面500错误的bug。
 4. 修改文章标签显示为换行。
## 1.4.3
 1. 优化tabler字体预加载，用户信息图标直接使用svg。
## 1.4.2
 1. 优化图片懒加载。
## 1.4.1
 1. 优化评论显示效果。
## 1.4
 1. 文章和页面右侧减少了一栏目，增加了文章导读和相关推荐。
 2. 修复了首次点赞时不成功的问题。
## 1.3 
 1. 修复QQ头像显示问题。
 2. 修改个人区域签名和简介显示问题。
## 1.2.1 
 1. 修复移动浏览器上左侧菜单无法滚动的问题。
## 1.2 
 1. 修改归档页面按年显示统计，不再显示文章，只显示按年再按月统计。
 2. 增加时间线页面，按年显示文章，当年显示，其它折叠。
 3. 修复一些小问题。
## 1.1 
 1. 修改在移动适配时的问题，从md设备改到lg设备才为非移动端。
 2. 修改右侧栏标题和评论过长没有换行的问题。
 3. 增加了文章和页面直接支持缩略图和来源页的字段。
 4. 增加了可配置列表分类，类似收藏小说，菜单子分类不下拉，点击进去直接显示分类的列表（小说名），再点列表（小说名）进去直接显示标题目录（小说目录），不配置不影响正常使用。
## 1.0 
 1. 手搓typecho主题。 
 2. CSS写的有问题，没有规划好，写到哪改到哪，没有做过明亮黑暗CSS，后续有时间再优化。 



  [1]: https://github.com/awinds/xaink
  [2]: https://www.xa.ink
  [3]: https://raw.githubusercontent.com/awinds/xaink/main/screenshot.png
  [4]: https://raw.githubusercontent.com/awinds/xaink/main/screenshot2.png
  [5]: https://xiaoa.me/archives/theme_xaink.html
  [6]: https://xiaoa.me
