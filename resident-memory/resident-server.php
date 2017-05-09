<?php
$serv=new swoole_server('127.0.0.1',9501);
$serv->set([
    'worker_num'=>1,
    'task_worker_num'=>1,
    'max_request'=>3,
    'task_max_request'=>4
]);
$serv->on('Connect',function ($serv,$fd){

});
$serv->on('Receive',function ($serv,$fd,$fromId,$data){
      $serv->task($data);
});
$serv->on('Task',function ($serv,$taskId,$fromId,$data){

});
$serv->on('Finish',function ($serv,$taskId,$data){

});
$serv->on('Close',function ($serv,$fd){

});

$serv->start();