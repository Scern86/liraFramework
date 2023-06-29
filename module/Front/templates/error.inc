<?php
use Scern\Lira\Core;
$lang_part = Core::LEXICON()->lang->url_part;
?>
<!doctype html>
<html lang="<?=Core::LEXICON()->lang->code;?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$this->meta_title;?></title>
</head>
<body>
    <h1 style="text-align: center;color:red"><?=$this->header;?></h1>
    <?=$this->content;?>
</body>
</html>