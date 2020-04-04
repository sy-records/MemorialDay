# MemorialDay
WordPress &amp; Typecho插件：「特殊节日使用」在国家公祭日、全国哀悼日时网站增加灰色滤镜。

## WordPress

[WordPress](https://github.com/sy-records/MemorialDay/tree/wordpress)

WordPress 后台安装插件页面搜索：`MemorialDay`，安装由`沈唁`提供的插件即可。

![](wordpress-MemorialDay.png)

## Typecho

[Typecho](https://github.com/sy-records/MemorialDay/tree/typecho)

------

也可以直接添加代码给`header`中添加`css`样式

```css
html{filter: grayscale(100%); -webkit-filter: grayscale(100%); -moz-filter: grayscale(100%); -ms-filter: grayscale(100%); -o-filter: grayscale(100%); filter: url("data:image/svg+xml;utf8,#grayscale"); filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1); -webkit-filter: grayscale(1);}
```
