<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/20/16
 */

namespace YandexWebmaster\ActionHandler;

use Yandex\ActionHandler\ActionHandlerInterface;
use Yandex\Exception\BadRequestException;
use Yandex\Exception\BadResponseException;
use Yandex\Exception\ForbiddenException;
use Yandex\Exception\NotFoundException;
use Yandex\Exception\YandexException;
use Yandex\Http\Response;
use Yandex\Utils\Hash;
use Yandex\Utils\Json;
use YandexWebmaster\Value\SiteOwner;

class GetSiteOwnersActionHandler implements ActionHandlerInterface
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
     * @return array
     * @throws YandexException
     */
    public function handle(Response $response)
    {
        $responseData = Json::decode($response->getBody());
        if ($response->getStatusCode() != 200) {
            $exceptionClass = $this->exceptionsMap[$response->getStatusCode()];
            throw new $exceptionClass($responseData['error_message']);
        }
        if (isset($responseData['users']) == false) {
            throw new BadResponseException('Bad response.' . var_export($responseData));
        }

        $owners = [];
        foreach ($responseData['users'] as $owner) {
            $owners[] = SiteOwner::fromArray([
                'user_login' => Hash::get($owner, 'user_login'),
                'verification_uin' => Hash::get($owner, 'verification_uin'),
                'verification_type' => Hash::get($owner, 'verification_type'),
                'verification_date' => Hash::get($owner, 'verification_date')
            ]);
        }

        return $owners;
    }
}