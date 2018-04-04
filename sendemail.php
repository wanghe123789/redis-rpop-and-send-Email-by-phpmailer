<?php 
	$pdo = new PDO('mysql:host=127.0.0.1;dbname=bawie','root','root');
	$redis = new Redis();
	$redis->connect('127.0.0.1','6379');
	// $len = $redis->llen('nemail');
	// //var_dump($len);die;
	if ($redis->llen('nemail')>=1) {
		while (true) {
			//队列弹出数据，写入数据库，发送邮件
			$data = $redis->rpop('nemail');
			if ($data) {
				//数据解码，入库
				$data_un = unserialize($data);
				$name = $data_un['username'];
				$email = $data_un['email'];
				$sql = "insert into `reg` (`name`,`email`,`status`) values ('$name','$email','0')";
				$res = $pdo->exec($sql);
				$send = sendemail($email);
				if ($send == 'ok') {
				 	//修改用户邮箱状态
				 	$sql1 = "update `reg` set status=1 where email='$email'";
				 	$res1 = $pdo->exec($sql1);
				 } else {
				 	file_put_contents('log.txt', $name."在".date("Y-m-d H:i:s")."修改数据库失败");
				 }	
			} else {
				break;
			}		
		}
	}
	function sendemail($abc){
		 //发送邮件
	    //引入PHPMailer的核心文件 使用require_once包含避免出现PHPMailer类重复定义的警告
	    require_once("PHPMailer/class.phpmailer.php"); 
	    require_once("PHPMailer/class.smtp.php");
	    //实例化PHPMailer核心类
	    $mail = new PHPMailer(); //实例化
	    $mail->IsSMTP(); // 启用SMTP
	    $mail->Host = "smtp.sina.com"; //SMTP服务器 以163邮箱为例子
	    $mail->Port =  465; //邮件发送端口
	    $mail->SMTPSecure = 'ssl'; ///设置使用ssl加密方式登录鉴权
	     //是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
	    $mail->SMTPDebug = 1;
	    $mail->SMTPAuth =    true; //启用SMTP认证
	    $mail->CharSet =     "UTF-8"; //字符集
	    $mail->Encoding =    "base64"; //编码方式
	    $mail->Username =   "w17600935887@sina.com"; //你的邮箱
	    $mail->Password =       "w294294"; //你的邮箱授权密码
	    $mail->Subject =    "你好"; //邮件标题
	    $mail->From =    "w17600935887@sina.com"; //发件人地址（也就是你的邮箱）
	    $mail->FromName = "XIAOWANG";  //发件人姓名
	    $address = $abc;//收件人email
	    $mail->AddAddress($address,  "亲");//添加收件人（地址，昵称）
	    // $mail->AddAttachment('xx.xls','我的附件.xls'); // 添加附件,并指定名称
	    $mail->IsHTML(true); //支持html格式内容
	    // $mail->AddEmbeddedImage("logo.jpg",  "my-attach","logo.jpg"); //设置邮件中的图片
	    $mail->Body ='你好,邮件！<br/>';//邮件主体内容
	    //发送
	    if(!$mail->Send())
	    {
	        return "Mailer  Error: " . $mail->ErrorInfo;
	    }
	    else
	    {
	        return "ok";
	    }
	}

 ?>