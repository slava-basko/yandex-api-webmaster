<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/5/16
 */

namespace YandexWebmaster\Action;

use XMLWriter;
use Yandex\Action\ActionInterface;
use Yandex\Action\DataActionInterface;
use Yandex\Auth\Token;

class AddOriginalTextAction implements ActionInterface, DataActionInterface
{
    /**
     * @var Token
     */
    private $token;
    private $siteId;
    private $text;

    /**
     * AddOriginalText constructor.
     * @param Token $token
     * @param $siteId
     * @param $text
     */
    public function __construct(Token $token, $siteId, $text)
    {
        $this->token = $token;
        $this->siteId = $siteId;
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return '/hosts/' . $this->siteId . '/original-texts';
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return 'post';
    }

    /**
     * @return Token
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        $writer = new XMLWriter();
        $writer->openMemory();
        $writer->setIndent(4);
        $writer->startElement('original-text');
            $writer->writeElement('content', $this->text);
        $writer->endElement();

        return $writer->outputMemory();
    }
}