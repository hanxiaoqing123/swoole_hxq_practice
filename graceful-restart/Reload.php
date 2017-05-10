<?php
class Reload{
    private  $_serv;
    private  $_test;
    public  function  __construct()
    {
        $this->_serv=new swoole_server('127.0.0.1',9501);
        $this->_serv->set([
            'worker_num'=>1,
            'daemonize'=>true,
            'log_file'=>__DIR__."/server.log",
        ]);
        $this->_serv->on('Receive',[$this,'onReceive']);
        $this->_serv->on('WorkerStart',[$this,'onWorkerStart']);
    }

    public function start()
    {
        $this->_serv->start();

    }

    public function  onWorkerStart($serv,$workerId)
    {

        require_once("Test.php");
        $this->_test=new Test();
        
    } 
    public function onReceive($serv,$fd,$fromId,$data)
    {
        $this->_test->run($data);
    }

}

$noReload=new Reload();
$noReload->start();