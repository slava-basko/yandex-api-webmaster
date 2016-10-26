<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/28/16
 */

namespace YandexWebmaster\ActionHandler;

use Yandex\ActionHandler\ActionHandlerInterface;
use Yandex\Exception\BadRequestException;
use Yandex\Exception\ForbiddenException;
use Yandex\Exception\NotFoundException;
use Yandex\Http\Response;

final class DeleteSitemapActionHandler implements ActionHandlerInterface
{
    /**
     * @var array
     */
    private $exceptionsMap = array(
        400 => BadRequestException::class,
        403 => ForbiddenException::class,
        404 => NotFoundException::class
    );

    public function handle(Response $response)
    {
        if ($response->getStatusCode() != 204) {
            \Yandex\throwExceptionByResponseCode($this->exceptionsMap, $response);
        }
        return true;
    }
}