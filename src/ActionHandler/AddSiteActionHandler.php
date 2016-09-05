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
use YandexWebmaster\Exception\CanNotAddSiteException;

class AddSiteActionHandler implements ActionHandlerInterface
{
    /**
     * @param Response $response
     * @return bool
     * @throws CanNotAddSiteException
     */
    public function handle(Response $response)
    {
        if ($response->getStatusCode() != 201) {
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

            throw new CanNotAddSiteException($reasonBody);
        }

        return true;
    }
}