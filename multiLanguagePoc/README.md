# Introduction
I had an event registration project, where the site had to support 3 languages. The requirement was only that one page is needed (So only the homepage will exist.). In this PoC I checked how this can be achived.

# The implementation
The implementation is minimal, because I found a good plugin:
https://wordpress.org/plugins/polylang/

The only problematic thing was the browser detection, but that can be fixed with a little code:
```
function redirect()
{
    ob_clean();
    ob_start();
    $languageCode = Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
    $homeUrl = get_home_url();
    $currentUrl = $_SERVER['REQUEST_URI'];
    if (strpos($currentUrl, "/en/") == false && strpos($currentUrl, "/de/") == false)
    {
        if ($languageCode == "en")
        {
            wp_redirect($homeUrl . "/index.php/en/", 302);
            exit;
        } else if ($languageCode == "de") {
            wp_redirect($homeUrl . "/index.php/de/", 302);
            exit;
        }
    }
}

add_action( 'init', 'redirect');
```

For translated constants:
```
load_theme_textdomain( 'test', get_template_directory().'/languages' );
_e("welcome", "test");
```

# Useful Links
* https://premium.wpmudev.org/blog/how-to-localize-a-wordpress-theme-and-make-it-translation-ready/
* https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/
* https://codex.wordpress.org/I18n_for_WordPress_Developers
* https://developer.wordpress.org/themes/functionality/localization/
* https://developer.wordpress.org/themes/functionality/internationalization/
* https://codex.wordpress.org/Function_Reference
* https://premium.wpmudev.org/blog/how-to-localize-a-wordpress-theme-and-make-it-translation-ready/
