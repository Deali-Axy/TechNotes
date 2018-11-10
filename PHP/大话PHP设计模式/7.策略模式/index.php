<?php

/**
 * Created by PhpStorm.
 * User: deali
 * Date: 11/23/2017 0023
 * Time: 15:47
 */
class Page
{
    /**
     * @var UserStrategy
     */
    protected $Strategy;

    function index()
    {
        //网页渲染
        $this->Strategy->showAd();

        $this->Strategy->showCategory();
    }

    function setStrategy(UserStrategy $strategy)
    {
        $this->Strategy = $strategy;
    }
}

$page = new Page();

//根据实际传入策略对象
$page->setStrategy($strategy);

$page->index();
