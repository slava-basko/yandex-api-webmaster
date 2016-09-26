<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/20/16
 */

namespace YandexWebmaster\ActionHandler;

use Yandex\ActionHandler\ActionHandlerInterface;
use Yandex\Exception\BadRequestException;
use Yandex\Exception\ForbiddenException;
use Yandex\Exception\NotFoundException;
use Yandex\Http\Response;
use Yandex\Utils\Hash;
use Yandex\Utils\Json;
use YandexWebmaster\Value\SiteStat;

final class GetSiteStatActionHandler implements ActionHandlerInterface
{
    /**
     * @var array
     */
    private $exceptionsMap = [
        400 => BadRequestException::class,
        403 => ForbiddenException::class,
        404 => NotFoundException::class
    ];

    /**
     * @param Response $response
     * @return SiteStat
     */
    public function handle(Response $response)
    {
        $responseData = Json::decode($response->getBody());
        if ($response->getStatusCode() != 200) {
            $exceptionClass = $this->exceptionsMap[$response->getStatusCode()];
            throw new $exceptionClass($responseData['error_message']);
        }

        return SiteStat::fromArray([
            'tic' => Hash::get($responseData, 'tic', 0),
            'downloaded_pages_count' => Hash::get($responseData, 'downloaded_pages_count', 0),
            'excluded_pages_count' => Hash::get($responseData, 'excluded_pages_count', 0),
            'searchable_pages_count' => Hash::get($responseData, 'searchable_pages_count', 0),
            'main_mirror' => Hash::get($responseData, 'site_problems')
        ]);
    }
}