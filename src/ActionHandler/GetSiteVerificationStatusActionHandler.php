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
use YandexWebmaster\Value\SiteVerificationStatus;

final class GetSiteVerificationStatusActionHandler implements ActionHandlerInterface
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
     * @return SiteVerificationStatus
     */
    public function handle(Response $response)
    {
        $responseData = Json::decode($response->getBody());
        if ($response->getStatusCode() != 200) {
            $exceptionClass = $this->exceptionsMap[$response->getStatusCode()];
            throw new $exceptionClass($responseData['error_message']);
        }

        return SiteVerificationStatus::fromArray([
            'verification_uin' => Hash::get($responseData, 'verification_uin'),
            'verification_state' => Hash::get($responseData, 'verification_state'),
            'verification_type' => Hash::get($responseData, 'verification_type'),
            'latest_verification_time' => Hash::get($responseData, 'latest_verification_time'),
            'fail_info' => Hash::get($responseData, 'fail_info', []),
            'applicable_verifiers' => Hash::get($responseData, 'applicable_verifiers', [])
        ]);
    }
}