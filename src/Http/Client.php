<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/5/16
 */

namespace YandexWebmaster\Http;

use YandexWebmaster\Action\AddOriginalTextAction;
use YandexWebmaster\Action\AddSiteAction;
use YandexWebmaster\Action\DeleteSiteAction;
use YandexWebmaster\Action\GetListOfSitesAction;
use YandexWebmaster\ActionHandler\AddOriginalTextActionHandler;
use YandexWebmaster\ActionHandler\AddSiteActionHandler;
use YandexWebmaster\ActionHandler\DeleteSiteActionHandler;
use YandexWebmaster\ActionHandler\GetListOfSitesHandler;

class Client extends \Yandex\Http\Client
{
    /**
     * @var array
     */
    protected $actionHandlerMap = [
        GetListOfSitesAction::class => GetListOfSitesHandler::class,
        AddSiteAction::class => AddSiteActionHandler::class,
        DeleteSiteAction::class => DeleteSiteActionHandler::class,
        AddOriginalTextAction::class => AddOriginalTextActionHandler::class
    ];
}