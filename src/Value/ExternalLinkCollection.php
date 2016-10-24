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
     * @var int
     */
    private $total;

    /**
     * ExternalLinkCollection constructor.
     * @param $total
     * @param array $links
     */
    public function __construct($total, $links = [])
    {
        if (!is_int($total)) {
            throw new \InvalidArgumentException('Total can be only INTEGER.');
        }

        foreach ($links as $link) {
            if (!($link instanceof ExternalLink)) {
                throw new \InvalidArgumentException('Only ExternalLink allowed.');
            }
            $this->links[] = $link;
        }
        $this->total = $total;
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

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }
}