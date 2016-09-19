<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/19/16
 */

namespace YandexWebmaster\ActionHandler;

use Yandex\ActionHandler\ActionHandlerInterface;
use Yandex\Http\Response;
use Yandex\Utils\Json;
use YandexWebmaster\Exception\NoUserIdFoundException;

class GetUserIdActionHandler implements ActionHandlerInterface
{
    /**
     * @param Response $response
     * @return int
     * @throws NoUserIdFoundException
     */
    public function handle(Response $response)
    {
        $userData = Json::decode($response->getBody());
        if (isset($userData['user_id']) == false) {
            throw new NoUserIdFoundException();
        }
        return $userData['user_id'];
    }
}