<?php

return [
    '#^/(ru|en|gr|es|de)($|/)#'=>Scern\Lira\Module\Lang::class,
    '#^/admin($|/)#'=>Scern\Lira\Module\Admin\Admin::class,
    '#^/test($|/)#'=>Scern\Lira\Module\Test::class,
    '#^/catalog($|/)#'=>Scern\Lira\Module\Catalog::class,
    '#^/lang/change$#'=>[Scern\Lira\Module\Lang::class,'change'],
    '#^/$#'=>Scern\Lira\Module\Front\Front::class,
];