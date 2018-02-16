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
