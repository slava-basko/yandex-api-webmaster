<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/5/16
 */

namespace YandexWebmaster\Action;


use Yandex\Action\ActionInterface;
use Yandex\Auth\Token;

final class DeleteOriginalTextAction implements ActionInterface
{
    /**
     * @var Token
     */
    private $token;

    /**
     * @var string
     */
    private $siteId;

    /**
     * @var string
     */
    private $textId;

    /**
     * DeleteOriginalTextAction constructor.
     * @param Token $token
     * @param $siteId
     * @param $textId
     */
    public function __construct(Token $token, $siteId, $textId)
    {
        $this->token = $token;
        $this->siteId = $siteId;
        $this->textId = $textId;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return '/hosts/' . $this->siteId . '/original-texts/' . $this->textId;
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return 'delete';
    }

    /**
     * @return Token
     */
    public function getToken()
    {
        return $this->token;
    }
}