<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/2/16
 */

namespace YandexWebmaster\ActionHandler;

use Yandex\ActionHandler\ActionHandlerInterface;
use Yandex\Http\Response;
use Yandex\Utils\Hash;
use Yandex\Utils\SimpleXMLReader;
use YandexWebmaster\Value\Crawling;
use YandexWebmaster\Value\Site;
use YandexWebmaster\Value\Verification;

final class GetListOfSitesHandler implements ActionHandlerInterface
{
    /**
     * @param Response $response
     * @return Site[]
     */
    public function handle(Response $response)
    {
        $sites = [];
        $reader = new SimpleXMLReader;

        if ($reader->XML($response->getBody()) == false) {
            throw new \InvalidArgumentException('Invalid XML.');
        }

        $reader->registerCallback('host', function ($reader) use (&$sites) {
            $host = [];
            /**
             * @var SimpleXMLReader $reader
             */
            $element = $reader->expandSimpleXml();
            $attributes = $element->attributes();
            $host['selfLink'] = Hash::get((array)$attributes, '@attributes.href');
            $host['name'] = (string)$element->name;

            $host['verification'] = new Verification(Hash::get((array)$element->verification, '@attributes.state'));
            $host['crawling'] = new Crawling(Hash::get((array)$element->crawling, '@attributes.state'));

            $host['virused'] = (string)$element->virused;
            $host['lastAccess'] = (string)$element->{'last-access'};
            $host['tic'] = (string)$element->tcy;
            $host['urlCount'] = (int)$element->{'url-count'};
            $host['indexCount'] = (int)$element->{'index-count'};

            $sites[] = Site::fromArray($host);
        });
        $reader->parse();
        $reader->close();

        return $sites;
    }
}