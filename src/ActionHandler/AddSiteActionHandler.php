<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/5/16
 */

namespace YandexWebmaster\ActionHandler;

use Yandex\ActionHandler\ActionHandlerInterface;
use Yandex\Exception\BadResponseException;
use Yandex\Http\Response;
use Yandex\Utils\Json;
use YandexWebmaster\Exception\CanNotAddSiteException;

final class AddSiteActionHandler implements ActionHandlerInterface
{
    /**
     * @param Response $response
     * @return string
     * @throws BadResponseException
     * @throws CanNotAddSiteException
     */
    public function handle(Response $response)
    {
        $responseData = Json::decode($response->getBody());
        if ($response->getStatusCode() != 201) {
            throw new CanNotAddSiteException(\Yandex\apiJsonErrorToMessage($response));
        }
        if (isset($responseData['host_id']) == false) {
            throw new BadResponseException('Bad response.' . var_export($responseData, true));
        }
        return $responseData['host_id'];
    }
}