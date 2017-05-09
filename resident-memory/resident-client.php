<?php
$client=new swoole_client(SWOOLE_SOCK_TCP,SWOOLE_SOCK_SYNC);
$client->connect('127.0.0.1',9501) || exit("connect failed . Error:{$client_errCode}\n ");
$client->send('Just a test');
$client->close();
