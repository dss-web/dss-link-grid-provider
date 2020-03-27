# Link list provider for [Hogan Content Grid](https://github.com/DekodeInteraktiv/hogan-content-grid)

<img src="assets/add-content.png">

## Generated HTML Code

```html
<div id="module-0" class="hogan-module hogan-module-content_grid hogan-module-0">
    <div class="hogan-module-inner">
        <div class="hogan-content-grid">
            <div class="hogan-grid-inner">
                <div class="hogan-content-grid-item hogan-grid-item-type-linklist">
                    <figure class=""><img width="300" height="125"
                        src="http://dev.local/wp-content/uploads/2/2020/03/img.jpg"
                        class="attachment-medium size-medium" alt=""
                        srcset="http://dev.local/wp-content/uploads/2/2020/03/img.jpg 300w, http://dev.local/wp-content/uploads/2/2020/03/porto-1024x427.jpg 1024w, http://dev.local/wp-content/uploads/2/2020/03/porto-768x320.jpg 768w, http://dev.local/wp-content/uploads/2/2020/03/porto-1536x640.jpg 1536w, http://dev.local/wp-content/uploads/2/2020/03/porto-1130x471.jpg 1130w, http://dev.local/wp-content/uploads/2/2020/03/porto-400x167.jpg 400w, http://dev.local/wp-content/uploads/2/2020/03/porto-800x333.jpg 800w, http://dev.local/wp-content/uploads/2/2020/03/porto.jpg 1920w"
                        sizes="(max-width: 300px) 100vw, 300px" />
                    </figure>
                    <h2 class="hogan-heading">Test</h2>
                    <ul>
                        <li><a href="http://dev.local/test1/">Test 1</a></li>
                        <li><a href="http://dev.local/test2/">Test 2</a></li>
                        <li><a href="http://dev.local/test3/">Test 3</a></li>
                    </ul>
                </div>
                <div class="hogan-content-grid-item hogan-grid-item-type-linklist">
                    <figure class=""><img width="300" height="125"
                        src="http://dev.local/wp-content/uploads/2/2020/03/img.jpg"
                        class="attachment-medium size-medium" alt=""
                        srcset="http://dev.local/wp-content/uploads/2/2020/03/img.jpg 300w, http://dev.local/wp-content/uploads/2/2020/03/porto-1024x427.jpg 1024w, http://dev.local/wp-content/uploads/2/2020/03/porto-768x320.jpg 768w, http://dev.local/wp-content/uploads/2/2020/03/porto-1536x640.jpg 1536w, http://dev.local/wp-content/uploads/2/2020/03/porto-1130x471.jpg 1130w, http://dev.local/wp-content/uploads/2/2020/03/porto-400x167.jpg 400w, http://dev.local/wp-content/uploads/2/2020/03/porto-800x333.jpg 800w, http://dev.local/wp-content/uploads/2/2020/03/porto.jpg 1920w"
                        sizes="(max-width: 300px) 100vw, 300px" />
                    </figure>
                    <h2 class="hogan-heading">Hello</h2>
                    <ul>
                        <li><a href="http://dev.local/hello/">Hello World</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
```

## Hooks

- `hogan/module/content_grid/linklist/image_size/constraints`
- `hogan/module/image/image_size/preview_size`, default is `thumbnail`
- `hogan/module/image/image_size/library`, default is `all`
- `hogan/module/content_grid/linklist/image/args`, same as the args for `wp_get_attachment_image`, default is:
	```php
	[
		'size' => 'medium',
		'icon' => false,
		'attr' => [],
	]
	```
- `hogan/module/content_grid/linklist/image/figure_classes`, default is `[]`
- `hogan/module/content_grid/linklist/label/enabled`, default is `false`
