<?php

namespace SleepingOwl\Admin\KDI;

class Css extends AssetElement
{
    /**
     * @return string
     */
    public function render()
    {
        return (new Html())->style($this->getSrc(), $this->getAttributes());
    }
}
