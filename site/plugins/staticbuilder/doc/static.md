Recommendations for static sites
================================


Kirby is not originally a static site generator, so some things that work on a dynamic Kirby-powered website might not work in a static HTML export. This guide helps you avoid common issues.


Knowing when we’re rendering a static page
------------------------------------------

From your templates and controllers, you can look for the `STATIC_BUILD` constant to see if we are making a static build of the page:

```php
if (defined('STATIC_BUILD')) {
    echo 'Yup, we are making a static build of this page.';
}
```

Ideally you shouldn’t need this, so the next tips won’t use it. But know that it’s an option if you need it.


Hardcoded URLs and file references
----------------------------------

StaticBuilder tries to generate correct URLs (absolute or relative, depending on options) for links and file references, but it can only work with URLs that go through Kirby or the `url()` helper function.

Avoid hardcoded URLs such as:

```php
<link rel="stylesheet" href="/assets/css/styles.css">
```

You could use the `url()` helper instead:

```php
<link rel="stylesheet" href="<?= url('assets/css/styles.css') ?>">
```

Similarly, when linking to pages, use the `url()` method:

```php
<!-- Bad :( -->
<a href="/blog">Blog Archive</a>

<!-- Better :) -->
<a href="<?= page('blog')->url() ?>">Blog Archive</a>
```


Dynamic features
----------------

If you plan to export your site as static HTML files, like you would do with a [static site generator](https://www.staticgen.com/) (Jekyll, Hugo, Sculptin, Pelican…), you should know that not all features will be doable on a static site. A few common pain points:

-   search results;
-   contact forms;
-   advanced routing;
-   logged-in users;
-   redirects!
-   etc.

You should list all the features of your website and try to determine if they need to be dynamic:

-   Do you need to process user input (e.g. a form), and show different content depending on what the user entered?
-   Do you need to connect to a database to show always up-to-date content?
-   Etc.

For each dynamic feature, you could try to find a workaround. But if you have many such features, then a static site generator (including this plugin) is probably not for you. ;)

Possible workarounds:

-   Search: JSON index generated by Kirby + custom JS code, or using a third-party such as Algolia ([Kirby plugin](https://github.com/getkirby-plugins/algolia-plugin)).
-   Forms: [Google Forms](https://www.google.com/forms/about/) or other third-party services.


HTTP redirections
-----------------

In dynamic websites, it’s fairly common to automatically redirect users from one page or URL to some other page (e.g. the home page, or the parent page).

For instance you may have this code in your template:

```php
// site/templates/article.php

if ($page->isInvisible()) {
    go($page->parent()->url());
}
```

The problem is that this code *will* be executed when building the pages’ HTML code, and it will halt the build script because it contains an `exit();` statement.

One solution is to tell StaticBuilder to ignore this kind of page, for instance:

```
// site/config/config.localhost.php

c::set('staticbuilder.filter', function($page) {
    if ($page->template() == 'article' && $page->isInvisible()) {
        return false;
    }
    return KirbyStaticBuilder\Plugin::defaultFilter($page);
});
```

See the [options documentation](options.md) for details.

Another solution is to move all your code that sends HTTP headers to Kirby’s `'headers'` config array:

```php
// site/config/config.php

c::set('headers', [
    // Template name
    'article' => function($page) {
        if ($page->isInvisible()) {
            go($page->parent()->url());
        }
    }
]);
```

This code will be executed when visiting a page using the `'article'` template, but not when rendering it with StaticBuilder. From the documentation:
 
> ### [Options > headers](https://getkirby.com/docs/cheatsheet/options/headers)
> An array with template names as keys and HTTP headers as values. Those headers will be sent before the template is rendered.