<?php



///
///
/// WebApp Configs
///
///

Dino\Contents\WebApp::routers(
    array(
        'res',
        'component',
        'page',
        'home',
        'pagenotfound'));

Dino\Contents\WebApp::variables(
    array(
        'theme' =>
            function () {
                return
                Dino\Contents\Page::theme();
            }));



///
///
/// Page Config
///
///

Dino\Contents\Page::home('news');
Dino\Contents\Page::defaultExt('html');
Dino\Contents\Page::useOfExt(true);
Dino\Contents\Page::theme('themes/bluebill');



///
///
/// Res Config
///
///

Dino\Contents\Res::folders('resource|%$THEME%/~res');
Dino\Contents\Res::extensions('css|js|png');