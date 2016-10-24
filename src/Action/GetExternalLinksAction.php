<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 10/24/16
 */

namespace YandexWebmaster\Action;

use Yandex\Action\ActionInterface;
use Yandex\Auth\Token;
use YandexWebmaster\Auth\User;

final class GetExternalLinksAction implements ActionInterface
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $hostId;

    /**
     * @var int
     */
    private $offset;

    /**
     * @var int
     */
    private $limit;

    /**
     * GetSiteAction constructor.
     * @param User $user
     * @param $hostId
     * @param int $offset
     * @param int $limit
     */
    public function __construct(User $user, $hostId, $offset = 0, $limit = 10)
    {
        $invalidArgs = false;
        if (!is_int($offset) or $offset < 0) {
            $invalidArgs = true;
        }

        if (!is_int($limit) or $limit < 1 or $limit > 100) {
            $invalidArgs = true;
        }

        if ($invalidArgs) {
            throw new \InvalidArgumentException('Offset and Limit must be positive INTEGER only.');
        }

        $this->user = $user;
        $this->hostId = $hostId;
        $this->offset = $offset;
        $this->limit = $limit;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return sprintf(
            '/%s/hosts/%s/links/external/samples/?offset=%s&limit=%s',
            $this->user->getUserId(),
            $this->hostId,
            $this->offset,
            $this->limit
        );
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return 'get';
    }

    /**
     * @return Token
     */
    public function getToken()
    {
        return $this->user->getToken();
    }

    /**
     * Move cursor to the nest page
     */
    public function moveCursorToNextPage()
    {
        $this->offset = $this->offset + $this->limit;
    }
}