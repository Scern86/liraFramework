<?php
require_once ROOT_DIR . DS . 'vendor' . DS . 'autoload.php';

use Scern\Lira\{Core, SessionManager, CacheManager, Config, Logger, Lexicon, EventManager, Event, DatabaseManager};
use Scern\Lira\Application\{App, Router, View, Lang};
use \Monolog\{Logger as MonologLogger, Level, Handler\StreamHandler};
use \Symfony\Component\HttpFoundation\Request;
use Scern\Lira\Module\DefaultController;

Core::SESSION()(new SessionManager());

Core::CONFIG()(new Config\Config());
Core::CONFIG()->add(new Config\PhpArray(ROOT_DIR . DS . 'config' . DS . 'main.php'));

Core::LOG()(new Logger(ROOT_DIR . DS . 'logs'));
Core::LOG()->add(new MonologLogger('Error', [new StreamHandler(Core::LOG()->logs_path . DS . 'error.log', Level::Warning)]));

Core::EVENT()(new EventManager());
Core::EVENT()->listen('needToLog', fn(Event $event) => Core::LOG()->get('Error')->error($event->message, [$event]));

Core::DATABASE()(new DatabaseManager());

Core::CACHE()(new CacheManager());

Core::LEXICON()(new Lexicon(new Lang(Core::CONFIG()->get('default_language'))));

$request = Request::createFromGlobals();
$view = new View();

$router = new Router($request->getRequestUri(),
    DefaultController::class,
    (new Config\PhpArray(ROOT_DIR . DS . 'application' . DS. 'Routes' . DS . 'routes.php'))->getArray()
);

$app = new App($request, $router, $view);

Core::APP()($app);
Core::APP()->handle($request->getRequestUri());