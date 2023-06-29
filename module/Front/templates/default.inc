<?php
use Scern\Lira\Core;
$lang_part = Core::LEXICON()->lang->url_part;
?>
<!doctype html>
<html lang="<?=Core::LEXICON()->lang->code;?>">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport"
              content="width=device-width, shrink-to-fit=no, initial-scale=1.0, maximum-scale=2.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?=$this->meta_title;?></title>
        <meta name="description" content="<?=$this->meta_description;?>">
        <meta name="keywords" content="<?=$this->meta_keyword;?>">
        <link rel="icon" href="/favicon.ico">
        <link rel="stylesheet" href="/assets/css/main.min.css">
    </head>
    <body>
        <header>
            <h1 class="header-title">Lira</h1>
        </header>
        <main>
            <?=$this->content;?>
        </main>
        <footer>
            <nav class="lang-select">
                <button type="button" data-lang="ru">RU</button>
                <button type="button" data-lang="en">EN</button>
                <button type="button" data-lang="gr">GR</button>
                <button type="button" data-lang="es">ES</button>
                <button type="button" data-lang="de">DE</button>
            </nav>
        </footer>
        <script type="module">
            import {Application} from "/assets/js/classes/app.min.js";
            window.app = new Application('<?=Core::LEXICON()->lang->code;?>');
        </script>
        <script src="/assets/js/main.min.js" type="module"></script>
    </body>
</html>