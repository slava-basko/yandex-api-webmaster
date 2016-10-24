<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 10/24/16
 */

namespace YandexWebmaster\ActionHandler;

use Yandex\ActionHandler\ActionHandlerInterface;
use Yandex\Exception\BadRequestException;
use Yandex\Exception\BadResponseException;
use Yandex\Exception\ForbiddenException;
use Yandex\Exception\NotFoundException;
use Yandex\Http\Response;
use Yandex\Utils\Hash;
use Yandex\Utils\Json;
use YandexWebmaster\Value\ExternalLink;
use YandexWebmaster\Value\ExternalLinkCollection;

final class GetExternalLinksActionHandler implements ActionHandlerInterface
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
     * @return ExternalLinkCollection
     * @throws BadResponseException
     */
    public function handle(Response $response)
    {
        $responseData = Json::decode($response->getBody());
        if ($response->getStatusCode() != 200) {
            $exceptionClass = $this->exceptionsMap[$response->getStatusCode()];
            throw new $exceptionClass($responseData['error_message']);
        }
        if (isset($responseData['links']) == false) {
            throw new BadResponseException('Bad response.' . var_export($responseData, true));
        }

        $links = [];
        foreach ($responseData['links'] as $link) {
            $links[] = ExternalLink::fromArray([
                'source_url' => Hash::get($link, 'source_url'),
                'destination_url' => Hash::get($link, 'destination_url'),
                'discovery_date' => Hash::get($link, 'discovery_date'),
                'source_last_access_date' => Hash::get($link, 'source_last_access_date')
            ]);
        }

        return new ExternalLinkCollection($links);
    }
}