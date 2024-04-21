# 关于
因为想学习响应式布局练练手，所以萌生了开了一个主题的想法，而我正好在使用百度，何不就做个和百度一样的主题  
Github:[https://github.com/awinds/xaink][1] 
Demo:[https://www.xa.ink][2] 
![主题界面][3]

# 特点
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
 - Sticky插件，可置顶文章，需做以下修改配合 
> ```php
> //增加字段,外面可以自定义判断
> $sticky_post['istop'] = 1;
> ```
# 安装 
直接下载 zip 源码->解压后移动到 `Typecho` 主题目录->改名为`xaink`->启用。 

# 设置  
主题设置页面位置：Typecho 后台->控制台->外观->设置外观。 

# 技术栈 
 - 使用[Tailwind CSS](https://www.tailwindcss.cn/) 
 - 使用[JQuery](https://jquery.com/)和相关插件 
 - 使用[jr-qrcode](https://github.com/diamont1001/jrQrcode)生成二维码 
 - 使用[OwO](https://github.com/DIYgod/OwO)表情 
 
# License 
Open sourced under the MIT license. 

# 更新说明 
##1.0 
 1. 手搓typecho主题 
 2. CSS写的有问题，没有规划好，写到哪改到哪，没有做过明亮黑暗CSS，后续有时间再优化 


  [1]: https://github.com/awinds/xaink
  [2]: https://www.xa.ink
  [3]: http://www.xa.ink/usr/uploads/2024/04/1247611939.png
