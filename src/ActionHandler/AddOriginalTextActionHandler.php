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
use YandexWebmaster\Exception\CanNotAddOriginalTextException;
use YandexWebmaster\Value\OriginalText;

final class AddOriginalTextActionHandler implements ActionHandlerInterface
{
    /**
     * @param Response $response
     * @return OriginalText
     * @throws CanNotAddOriginalTextException
     */
    public function handle(Response $response)
    {
        if ($response->getStatusCode() != 201) {
            throw new CanNotAddOriginalTextException(\Yandex\apiErrorToMessage($response));
        }

        $originalText = [];
        $reader = new SimpleXMLReader;

        if ($reader->XML($response->getBody()) == false) {
            throw new \InvalidArgumentException('Invalid XML.');
        }

        $reader->registerCallback('id', function ($reader) use (&$originalText) {
            /**
             * @var SimpleXMLReader $reader
             */
            $element = $reader->expandSimpleXml();
            $originalText['id'] = (string)$element;

            return true;
        });
        $reader->registerCallback('link', function ($reader) use (&$originalText) {
            /**
             * @var SimpleXMLReader $reader
             */
            $element = $reader->expandSimpleXml();
            $attributes = $element->attributes();
            $originalText['link'] = Hash::get((array)$attributes, '@attributes.href');

            return true;
        });
        $reader->registerCallback('content', function ($reader) use (&$originalText) {
            /**
             * @var SimpleXMLReader $reader
             */
            $element = $reader->expandSimpleXml();
            $originalText['content'] = (string)$element;

            return true;
        });
        $reader->parse();
        $reader->close();

        return OriginalText::fromArray($originalText);
    }
}