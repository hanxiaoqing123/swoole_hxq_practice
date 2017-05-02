<?php
$serv=new swoole_server('127.0.0.1',9501);
$serv->set([
    'worker_num'=>2,
]);
$serv->on('Connect',function ($serv,$fd){
    echo "new client connected.".PHP_EOL;
});
$serv->on('Receive',function ($serv,$fd,$fromId,$data){
    $serv->send($fd,'Server'.$data);
});
$serv->on('Close',function ($serv,$fd){
    echo "Client close.".PHP_EOL;
});

//到此，已基本搭建一个高性能的server,启动server
$serv->start();