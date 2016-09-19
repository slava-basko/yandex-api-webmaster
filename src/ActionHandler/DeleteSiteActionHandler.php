<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/5/16
 */

namespace YandexWebmaster\ActionHandler;

use Yandex\ActionHandler\ActionHandlerInterface;
use Yandex\Http\Response;
use Yandex\Utils\Json;
use YandexWebmaster\Exception\CanNotDeleteSiteException;

final class DeleteSiteActionHandler implements ActionHandlerInterface
{
    /**
     * @param Response $response
     * @return bool
     * @throws CanNotDeleteSiteException
     */
    public function handle(Response $response)
    {
        $responseData = Json::decode($response->getBody());
        if ($response->getStatusCode() != 204) {
            throw new CanNotDeleteSiteException(implode(' ', $responseData));
        }
        return true;
    }
}