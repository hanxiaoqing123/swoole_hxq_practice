<?php
$serv=new swoole_server('127.0.0.1',9501);
$serv->set([
    'worker_num'=>2,
    'task_worker_num'=>1,
]);
$serv->on('Connect',function ($serv,$fd){

});
$serv->on('Receive',function ($serv,$fd,$formId,$data){

});
$serv->on('Close',function ($serv,$fd){

});
$serv->on('Task',function ($serv,$taskId,$fromId,$data){

});
$serv->on('Finish',function ($serv,$taskId,$data){

});
$serv->on('start',function ($serv){
    swoole_set_process_name('server-process:master');
});
$serv->on('ManagerStart',function ($serv){
    swoole_set_process_name('server-process:manager');
});
$serv->on('WorkerStart',function ($serv,$workerId){
    if($workerId>=$serv->setting['worker_num']){
        swoole_set_process_name('server-process:task');
    }else{
        swoole_set_process_name('server-process:worker');
    }
});
$serv->start();