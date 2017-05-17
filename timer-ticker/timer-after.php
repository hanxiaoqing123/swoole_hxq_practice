<?php
//一次性定时器
swoole_timer_after(3000,function (){
    echo "only once.\n";
});