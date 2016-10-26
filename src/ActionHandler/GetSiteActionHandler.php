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
use YandexWebmaster\Value\Site;

final class GetSiteActionHandler implements ActionHandlerInterface
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
     * @return Site
     */
    public function handle(Response $response)
    {
        if ($response->getStatusCode() != 200) {
            \Yandex\throwExceptionByResponseCode($this->exceptionsMap, $response);
        }

        $responseData = Json::decode($response->getBody());

        return Site::fromArray([
            'host_id' => Hash::get($responseData, 'host_id'),
            'ascii_host_url' => Hash::get($responseData, 'ascii_host_url'),
            'unicode_host_url' => Hash::get($responseData, 'unicode_host_url'),
            'verified' => Hash::get($responseData, 'verified', false),
            'main_mirror' => Hash::get($responseData, 'main_mirror', []),
            'host_data_status' => Hash::get($responseData, 'host_data_status'),
            'host_display_name' => Hash::get($responseData, 'host_display_name'),
        ]);
    }
}