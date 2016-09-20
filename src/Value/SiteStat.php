<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/20/16
 */

namespace YandexWebmaster\Value;

class SiteStat
{
    /**
     * Site tic
     */
    private $tic;

    /**
     * Pages qty loaded by Yandex robot
     */
    private $downloadedPagesCount;

    /**
     * Pages qty that have been excluded
     */
    private $excludedPagesCount;

    /**
     * Pages qty in search
     */
    private $searchablePagesCount;

    /**
     * Problems with site
     */
    private $siteProblems;

    /**
     * SiteStat constructor.
     * @param $tic
     * @param $downloadedPagesCount
     * @param $excludedPagesCount
     * @param $searchablePagesCount
     * @param $siteProblems
     */
    public function __construct(
        $tic,
        $downloadedPagesCount,
        $excludedPagesCount,
        $searchablePagesCount,
        $siteProblems
    )
    {
        $this->tic = $tic;
        $this->downloadedPagesCount = $downloadedPagesCount;
        $this->excludedPagesCount = $excludedPagesCount;
        $this->searchablePagesCount = $searchablePagesCount;
        $this->siteProblems = $siteProblems;
    }

    /**
     * @param array $data
     * @return SiteStat
     */
    public static function fromArray(array $data)
    {
        return new self(
            isset($data['tic']) ? $data['tic'] : '',
            isset($data['downloaded_pages_count']) ? $data['downloaded_pages_count'] : '',
            isset($data['excluded_pages_count']) ? $data['excluded_pages_count'] : '',
            isset($data['searchable_pages_count']) ? $data['searchable_pages_count'] : '',
            isset($data['site_problems']) ? $data['site_problems'] : []
        );
    }

    /**
     * @return mixed
     */
    public function getTic()
    {
        return $this->tic;
    }

    /**
     * @return mixed
     */
    public function getDownloadedPagesCount()
    {
        return $this->downloadedPagesCount;
    }

    /**
     * @return mixed
     */
    public function getExcludedPagesCount()
    {
        return $this->excludedPagesCount;
    }

    /**
     * @return mixed
     */
    public function getSearchablePagesCount()
    {
        return $this->searchablePagesCount;
    }

    /**
     * @return mixed
     */
    public function getSiteProblems()
    {
        return $this->siteProblems;
    }
}