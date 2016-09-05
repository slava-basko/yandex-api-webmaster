<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/5/16
 */

namespace YandexWebmaster\ActionHandler;

use Yandex\ActionHandler\ActionHandlerInterface;
use Yandex\Http\Response;
use YandexWebmaster\Exception\CanNotDeleteOriginalTextException;

final class DeleteOriginalTextActionHandler implements ActionHandlerInterface
{
    /**
     * @param Response $response
     * @return bool
     * @throws CanNotDeleteOriginalTextException
     */
    public function handle(Response $response)
    {
        if ($response->getStatusCode() != 204) {
            throw new CanNotDeleteOriginalTextException(\Yandex\apiErrorToMessage($response));
        }

        return true;
    }
}