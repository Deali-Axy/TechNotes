<?php

/**
 * Interface IObserver 事件观察者接口
 */
interface IObserver
{
    /**
     * 事件发生后的更新操作
     * @param null $event_info mix 事件信息
     * @return mixed
     */
    function update($event_info = null);
}

/**
 * Class EventGenerator 事件产生者的抽象类
 */
class EventGenerator
{
    private $observers = array();

    function addObserver(IObserver $observer)
    {
        $this->observers[] = $observer;
    }

    /**
     * 通知所有事件观察者
     */
    function notify()
    {
        foreach ($this->observers as $observer)
        {
            $observer->update();
        }
    }
}

class IObserver1 implements IObserver
{
    function update($event_info = null)
    {
        echo "观察者1\n";
    }
}

class IObserver2 implements IObserver
{
    function update($event_info = null)
    {
        echo "观察者2\n";
    }
}

class Event extends EventGenerator
{
    function trigger()
    {
        echo "Event!!!\n";
        $this->notify();
    }
}

$event = new Event();
$event->addObserver(new IObserver1());
$event->addObserver(new IObserver2());
$event->trigger();