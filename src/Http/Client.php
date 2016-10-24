<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/5/16
 */

namespace YandexWebmaster\Http;

use Yandex\Http\Curl;
use Yandex\Http\CurlInterface;
use YandexWebmaster\Action\AddOriginalTextAction;
use YandexWebmaster\Action\AddSiteAction;
use YandexWebmaster\Action\AddSitemapAction;
use YandexWebmaster\Action\DeleteOriginalTextAction;
use YandexWebmaster\Action\DeleteSiteAction;
use YandexWebmaster\Action\DeleteSitemapAction;
use YandexWebmaster\Action\GetExternalLinksAction;
use YandexWebmaster\Action\GetListOfSitesAction;
use YandexWebmaster\Action\GetSiteAction;
use YandexWebmaster\Action\GetSiteOwnersAction;
use YandexWebmaster\Action\GetSiteStatAction;
use YandexWebmaster\Action\GetUserIdAction;
use YandexWebmaster\Action\GetSiteVerificationStatusAction;
use YandexWebmaster\Action\VerifySiteAction;
use YandexWebmaster\ActionHandler\AddOriginalTextActionHandler;
use YandexWebmaster\ActionHandler\AddSiteActionHandler;
use YandexWebmaster\ActionHandler\AddSitemapActionHandler;
use YandexWebmaster\ActionHandler\DeleteOriginalTextActionHandler;
use YandexWebmaster\ActionHandler\DeleteSiteActionHandler;
use YandexWebmaster\ActionHandler\DeleteSitemapActionHandler;
use YandexWebmaster\ActionHandler\GetExternalLinksActionHandler;
use YandexWebmaster\ActionHandler\GetListOfSitesActionHandler;
use YandexWebmaster\ActionHandler\GetSiteActionHandler;
use YandexWebmaster\ActionHandler\GetSiteOwnersActionHandler;
use YandexWebmaster\ActionHandler\GetSiteStatActionHandler;
use YandexWebmaster\ActionHandler\GetUserIdActionHandler;
use YandexWebmaster\ActionHandler\GetSiteVerificationStatusActionHandler;
use YandexWebmaster\ActionHandler\VerifySiteActionHandler;

class Client
{
    /**
     * @var array
     */
    private static $actionHandlerMap = [
        GetUserIdAction::class => GetUserIdActionHandler::class,
        GetListOfSitesAction::class => GetListOfSitesActionHandler::class,
        AddSiteAction::class => AddSiteActionHandler::class,
        DeleteSiteAction::class => DeleteSiteActionHandler::class,
        GetSiteAction::class => GetSiteActionHandler::class,
        GetSiteStatAction::class => GetSiteStatActionHandler::class,
        GetSiteVerificationStatusAction::class => GetSiteVerificationStatusActionHandler::class,
        VerifySiteAction::class => VerifySiteActionHandler::class,
        GetSiteOwnersAction::class => GetSiteOwnersActionHandler::class,
        AddSitemapAction::class => AddSitemapActionHandler::class,
        DeleteSitemapAction::class => DeleteSitemapActionHandler::class,
        AddOriginalTextAction::class => AddOriginalTextActionHandler::class,
        DeleteOriginalTextAction::class => DeleteOriginalTextActionHandler::class,
        GetExternalLinksAction::class => GetExternalLinksActionHandler::class
    ];

    /**
     * @param $clientId
     * @param $clientPassword
     * @param CurlInterface $curl
     * @return \Yandex\Http\Client
     */
    public static function create($clientId, $clientPassword, CurlInterface $curl = null)
    {
        if (is_null($curl)) {
            $curl = new Curl();
        }

        $client = new \Yandex\Http\Client(
            'https://api.webmaster.yandex.net/v3/user',
            $clientId,
            $clientPassword,
            $curl
        );

        foreach (static::$actionHandlerMap as $action => $handler) {
            $client->addActionHandler($action, $handler);
        }

        $client->addHeader('Content-type', 'application/json');

        return $client;
    }
}