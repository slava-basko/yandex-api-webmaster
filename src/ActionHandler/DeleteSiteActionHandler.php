<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/5/16
 */

namespace YandexWebmaster\ActionHandler;

use Yandex\ActionHandler\ActionHandlerInterface;
use Yandex\Http\Response;
use Yandex\Utils\Hash;
use Yandex\Utils\SimpleXMLReader;
use YandexWebmaster\Exception\CanNotDeleteSiteException;

final class DeleteSiteActionHandler implements ActionHandlerInterface
{
    /**
     * @param Response $response
     * @return bool
     * @throws CanNotDeleteSiteException
     */
    public function handle(Response $response)
    {
        if ($response->getStatusCode() != 204) {
            $reasonBody = '';

            $reader = new SimpleXMLReader;
            if ($reader->XML($response->getBody()) == false) {
                throw new \InvalidArgumentException('Invalid XML.');
            }
            $reader->registerCallback('error', function ($reader) use (&$reasonBody) {
                /**
                 * @var SimpleXMLReader $reader
                 */
                $element = $reader->expandSimpleXml();
                $attributes = (array)$element->attributes();
                $reasonBody .= Hash::get($attributes, '@attributes.code', '');
                $reasonBody .= ' : ';
                $reasonBody .= (string)$element->message;
            });
            $reader->parse();
            $reader->close();

            throw new CanNotDeleteSiteException($reasonBody);
        }

        return true;
    }
}