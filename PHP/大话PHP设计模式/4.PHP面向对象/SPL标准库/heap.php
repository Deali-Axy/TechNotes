<?php
/**
 * Created by PhpStorm.
 * User: deali
 * Date: 11/23/2017 0023
 * Time: 14:53
 */

//堆结构

$heap=new SplMinHeap();
$heap->insert("data1");
$heap->insert("data2");

echo $heap->extract();
echo $heap->extract();