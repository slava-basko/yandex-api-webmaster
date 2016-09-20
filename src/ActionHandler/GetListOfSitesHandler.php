<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/2/16
 */

namespace YandexWebmaster\ActionHandler;

use Yandex\ActionHandler\ActionHandlerInterface;
use Yandex\Exception\BadResponseException;
use Yandex\Http\Response;
use Yandex\Utils\Hash;
use Yandex\Utils\Json;
use YandexWebmaster\Value\Site;

final class GetListOfSitesHandler implements ActionHandlerInterface
{
    /**
     * @param Response $response
     * @return array
     * @throws BadResponseException
     */
    public function handle(Response $response)
    {
        $responseData = Json::decode($response->getBody());
        if (isset($responseData['hosts']) == false) {
            throw new BadResponseException('Bad response.' . var_export($responseData));
        }

        $sites = [];
        foreach ($responseData['hosts'] as $siteData) {
            $host['host_id'] = Hash::get($siteData, 'host_id');
            $host['ascii_host_url'] = Hash::get($siteData, 'ascii_host_url');
            $host['unicode_host_url'] = Hash::get($siteData, 'unicode_host_url');
            $host['verified'] = Hash::get($siteData, 'verified', false);
            $host['main_mirror'] = Hash::get($siteData, 'main_mirror', []);

            $sites[] = Site::fromArray($host);
        }

        return $sites;
    }
}