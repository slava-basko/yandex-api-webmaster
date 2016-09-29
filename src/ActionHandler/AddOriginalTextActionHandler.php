<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/29/16
 */

namespace YandexWebmaster\ActionHandler;

use Yandex\ActionHandler\ActionHandlerInterface;
use Yandex\Exception\BadRequestException;
use Yandex\Exception\BadResponseException;
use Yandex\Exception\ConflictException;
use Yandex\Exception\ForbiddenException;
use Yandex\Exception\NotFoundException;
use Yandex\Exception\TooManyRequestsException;
use Yandex\Exception\UnprocessableEntityException;
use Yandex\Http\Response;
use Yandex\Utils\Json;
use YandexWebmaster\Value\OriginalText;

final class AddOriginalTextActionHandler implements ActionHandlerInterface
{
    /**
     * @var array
     */
    private $exceptionsMap = array(
        400 => BadRequestException::class,
        403 => ForbiddenException::class,
        404 => NotFoundException::class,
        409 => ConflictException::class,
        422 => UnprocessableEntityException::class,
        429 => TooManyRequestsException::class
    );

    /**
     * @param Response $response
     * @return OriginalText
     * @throws BadResponseException
     */
    public function handle(Response $response)
    {
        if ($response->getStatusCode() != 201) {
            $exceptionClass = $this->exceptionsMap[$response->getStatusCode()];
            throw new $exceptionClass(\Yandex\apiJsonErrorToMessage($response));
        }

        $responseData = Json::decode($response->getBody());
        if (isset($responseData['text_id']) == false) {
            throw new BadResponseException('Bad response.' . var_export($responseData, true));
        }

        return OriginalText::fromArray($responseData);
    }
}