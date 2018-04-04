<?php 
	//接值
	$abc = $_POST;
	$data = serialize($abc);
	//$res = sendemail($abc);
	$redis = new Redis();
	//连接redis服务器
	$redis->connect('127.0.0.1', '6379');
	$redis->rpush('nemail',$data);
	if ($redis->llen('nemail')>=1) {
		$res = system('D:\phpStudy\php\php-5.6.27-nts\php.exe D:\phpStudy\WWW\phpmailer\sendemail.php');
	}
 ?>