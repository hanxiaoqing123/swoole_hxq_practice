<?php
$client=new swoole_client(SWOOLE_SOCK_TCP,SWOOLE_SOCK_SYNC);
$client->connect('127.0.0.1',9501) || exit("connect failed .Error:{$client->errCode}\n");
$client->send("hello server.");
$response=$client->recv();
echo $response.PHP_EOL;
$client->close();