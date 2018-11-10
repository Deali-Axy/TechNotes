<?php
/**
 * Created by PhpStorm.
 * User: deali
 * Date: 11/23/2017 0023
 * Time: 14:52
 */

//队列结构

$queue=new SplQueue();
$queue->enqueue("入队1");
$queue->enqueue("入队2");

echo $queue->dequeue();
echo $queue->dequeue();