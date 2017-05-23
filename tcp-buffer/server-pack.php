<?php
class ServerPack{
  private $_serv;

    public function __construct()
    {
        $this->_serv=new swoole_server('127.0.0.1',9502);
        $this->_serv->set([
            'worker_num'=>1,
            'open_length_check'=>true, //开启固定包头协议解析
            'package_length_type'=>'N',
            'package_length_offset'=>0,
            'package_body_offset'  =>4,
            'package_max_length'   =>81920,
        ]);
        $this->_serv->on('receive',[$this,'onReceive']);
        
    }

    public function onReceive($serv,$fd,$fromId,$data){
        //在onReceive回调对数据解包，然后从包头中取出包体长度，再从接收到的数据中截取真正的包体。
        $info=unpack('N',$data);
        $len=$info[1];
        $body=substr($data,-$len);
        echo "server received data:{$body}\n";

    }

    public function start()
    {
        $this->_serv->start();
    }

}
$reload=new ServerPack();
$reload->start();