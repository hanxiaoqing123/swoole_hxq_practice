<?php
$serv=new swoole_server('127.0.0.1',9501);
$serv->set([
    'task_worker_num'=>1,
]);
$serv->on('Connect',function ($serv,$fd){
   echo "new client connected.".PHP_EOL;
});
$serv->on('Receive',function ($serv,$fd,$fromId,$data){
    echo  "worker received data:{$data}".PHP_EOL;
    //投递一个任务到task进程中
    $serv->task($data);
    $serv->send($fd,'This is a message from server');
    //校验task是否为异步的
    echo "worker continue run".PHP_EOL;
});

//注册onTask回调
$serv->on('Task',function ($serv,$taskId,$fromId,$data){
   echo "task start.--- from worker id:{$fromId}.".PHP_EOL;
   //为了模拟是否为异步，task的回调中循环一个耗时任务，另外，task回调内的结尾并没有return任何内容
   for($i=0;$i<5;$i++){
     sleep(1);
     echo "task running.---{$i}".PHP_EOL;
   }
   echo "task end.".PHP_EOL;
});
//注册onFinish回调
$serv->on('Finish',function ($serv,$taskId,$data){
    echo "finish received data '{$data}'".PHP_EOL;
});
//最后，调用server的start方法
$serv->start();
