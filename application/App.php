<?php

namespace Scern\Lira\Application;

use Scern\Lira\{Core, Config\PhpArray, Lexicon};
use Scern\Lira\Application\{Interfaces\Controller, MongoDb, Router, View, Lang};
use Scern\Lira\Application\Result\{Result,
    ResultSuccess,
    ResultError,
    ResultJson,
    ResultHttpRedirect,
    ResultInternalRedirect};
use Symfony\Component\HttpFoundation\{Request, Response, RedirectResponse, JsonResponse};

class App implements Controller
{
    protected Response $response;

    private static $was_handled=false;

    public function handle(string $url): Result
    {
        if(self::$was_handled) return new ResultSuccess();
        self::$was_handled = true;
        $url_path = parse_url($url, PHP_URL_PATH) ?? '/';
        $executor = $this->router->handle($url_path);
        $action = 'handle';
        if (is_array($executor)) list($executor, $action) = $executor;
        $controller = new $executor($url_path);
        $result = $controller->handle($action);
        match ($result::class) {
            ResultSuccess::class => $this->onSuccess($result),
            ResultHttpRedirect::class => $this->onHttpRedirect($result),
            ResultInternalRedirect::class => $this->onInternalRedirect($result),
            ResultError::class => $this->onError($result),
            ResultJson::class => $this->onJsonResponse($result),
            default => $this->onError($result)
        };
        return new ResultSuccess();
    }

    private function onSuccess(Result $result): void
    {
        //if(!$this->view->only_content) render widgets
        Core::EVENT()->trigger('App_BeforeRender');
        $render = $this->view->execute();
        $this->response = new Response($render, $result->http_status_code, $result->headers);
        $this->send();
    }

    private function onInternalRedirect(ResultInternalRedirect $result): void
    {
        self::$was_handled=false;
        $this->handle($result->url);
    }

    private function onHttpRedirect(ResultHttpRedirect $result): void
    {
        $this->response = new RedirectResponse($result->url, $result->http_status_code);
        $this->send();
    }

    private function onError(ResultError $result): void
    {
        $this->view->setTemplate(ROOT_DIR . DS . 'templates' . DS . 'error.inc');
        $this->view->content = $result->message;
        Core::EVENT()->trigger('needToLog', 'Error page opened', 0, []);
        $this->onSuccess($result);
    }

    private function onJsonResponse(ResultJson $result)
    {
        $this->response = new JsonResponse($result->content, $result->http_status_code, $result->headers);
        $this->send();
    }

    private function send(): void
    {
        Core::EVENT()->trigger('App_BeforeSend');
        $this->response->send();
        die();
    }

    public function __construct(public readonly Request $request, private Router $router, public readonly View $view)
    {
        Core::CONFIG()->add(new PhpArray(ROOT_DIR . DS . 'config' . DS . 'mongodb.php'), 'mongodb');
        Core::DATABASE()->add(new MongoDb(Core::CONFIG()->get('mongodb')));
        //Core::CONFIG()->add(new Config\PhpArray(ROOT_DIR.DS.'config'.DS.'postgresql.php'),'postgres');
        //Core::DATABASE()->add(new Postgresql(Core::CONFIG()->get('postgres')));
        // add event listeners
    }
}