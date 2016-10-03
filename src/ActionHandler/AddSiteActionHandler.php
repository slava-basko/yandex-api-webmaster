<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/5/16
 */

namespace YandexWebmaster\ActionHandler;

use Yandex\ActionHandler\ActionHandlerInterface;
use Yandex\Exception\BadRequestException;
use Yandex\Exception\BadResponseException;
use Yandex\Exception\ConflictException;
use Yandex\Exception\ForbiddenException;
use Yandex\Http\Response;
use Yandex\Utils\Json;
use YandexWebmaster\Exception\CanNotAddSiteException;

final class AddSiteActionHandler implements ActionHandlerInterface
{
    /**
     * @var array
     */
    private $exceptionsMap = array(
        400 => BadRequestException::class,
        403 => ForbiddenException::class,
        409 => ConflictException::class
    );

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
            $extra = [];
            if (isset($responseData['host_id'])) {
                $extra['host_id'] = $responseData['host_id'];
            }
            $exceptionClass = $this->exceptionsMap[$response->getStatusCode()];
            throw new $exceptionClass(\Yandex\apiJsonErrorToMessage($response), 0, null, $extra);
        }

        if (isset($responseData['host_id']) == false) {
            throw new BadResponseException('Bad response.' . var_export($responseData, true));
        }
        return $responseData['host_id'];
    }
}