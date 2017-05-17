<?php
//永久性定时器
//每1000毫秒执行一次回调函数
swoole_timer_tick(1000,function (){
    echo "This is a tick.\n";
});