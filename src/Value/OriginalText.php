<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/5/16
 */

namespace YandexWebmaster\Value;

final class OriginalText
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $link;

    /**
     * @var String
     */
    private $content;

    /**
     * OriginalText constructor.
     * @param string $id
     * @param string $link
     * @param string $content
     */
    public function __construct(
        $id,
        $link,
        $content
    )
    {
        if (!is_string($id) or !is_string($link) or !is_string($content)) {
            throw new \InvalidArgumentException('Invalid params form OriginalText creation.');
        }

        $this->id = $id;
        $this->link = $link;
        $this->content = $content;
    }

    /**
     * @param array $data
     * @return OriginalText
     */
    public static function fromArray(array $data)
    {
        return new self(
            isset($data['id']) ? $data['id'] : null,
            isset($data['link']) ? $data['link'] : null,
            isset($data['content']) ? $data['content'] : null
        );
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @return String
     */
    public function getContent()
    {
        return $this->content;
    }
}