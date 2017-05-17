<?php
$i=0;
/*
 * int swoole_timer_tick(int $ms, callable $callback, mixed $params);
 * 其中三个参数解释：
   $ms 指时间，单位毫秒
   $callback 回调函数，定时器创建后会调用该函数
   $params 传递给回调函数的参数
 * */
swoole_timer_tick(1000,function ($timeId,$params) use (&$i){
  $i++;
  echo "Hello {$params}---{$i}.\n";
  if($i>=5){
      //删除定时器
      swoole_timer_clear($timeId);
  }
},'world');