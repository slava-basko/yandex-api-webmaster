<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 10/24/16
 */

namespace YandexWebmaster\Value;

class ExternalLinkCollection
{
    /**
     * @var ExternalLink[]
     */
    private $links = [];

    /**
     * ExternalLinkCollection constructor.
     * @param array $links
     */
    public function __construct($links = [])
    {
        foreach ($links as $link) {
            if (!($link instanceof ExternalLink)) {
                throw new \InvalidArgumentException('Only ExternalLink allowed.');
            }
            $this->links[] = $link;
        }
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->links);
    }

    /**
     * @return ExternalLink[]
     */
    public function getLinks()
    {
        return $this->links;
    }
}