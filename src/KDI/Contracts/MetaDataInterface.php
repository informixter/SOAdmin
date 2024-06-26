<?php

namespace SleepingOwl\Admin\KDI\Contracts;

interface MetaDataInterface
{
    /**
     * @return string
     */
    public function getMetaTitle();

    /**
     * @return string
     */
    public function getMetaKeywords();

    /**
     * @return string
     */
    public function getMetaDescription();

    /**
     * @return string
     */
    public function getMetaRobots();
}
