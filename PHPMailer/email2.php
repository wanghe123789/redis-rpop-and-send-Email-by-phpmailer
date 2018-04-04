<?php  
header("content-type:textml;charset=utf8"); 

    require_once('class.phpmailer.php'); //载入PHPMailer类
    require_once("class.smtp.php");
// POP3/SMTP服务 授权码:     mpdyahqehbbnbhfb
// IMAP/SMTP服务 授权码:     etawulgcnekmbggf

        $mail = new PHPMailer(); //实例化
        $mail->IsSMTP(); // 启用SMTP
        $mail->Host = "smtp.qq.com"; //SMTP服务器 以163邮箱为例子
        $mail->Port =  465; //邮件发送端口
        $mail->SMTPSecure = 'ssl'; ///设置使用ssl加密方式登录鉴权
         //是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth =    true; //启用SMTP认证
        $mail->CharSet =     "UTF-8"; //字符集
        $mail->Encoding =    "base64"; //编码方式
        $mail->Username =   "940120655@qq.com"; //你的邮箱
        $mail->Password =       "fgrgepuqiykdbcei"; //你的邮箱授权密码
        $mail->Subject =    "你好"; //邮件标题
        $mail->From =    "940120655@qq.com"; //发件人地址（也就是你的邮箱）
        $mail->FromName = "海马";  //发件人姓名
        $address = "972218245@qq.com";//收件人email
        $mail->AddAddress($address,  "亲");//添加收件人（地址，昵称）
        // $mail->AddAttachment('xx.xls','我的附件.xls'); // 添加附件,并指定名称
        $mail->IsHTML(true); //支持html格式内容
        // $mail->AddEmbeddedImage("logo.jpg",  "my-attach","logo.jpg"); //设置邮件中的图片
        $mail->Body ='你好,<b>朋友</b>!<br/>这是一封来自<a href="http://www.helloweba.com" target=
        "_blank">helloweba.com</a>的邮件！<br/><img alt="helloweba"src =
        "cid:my-attach">';//邮件主体内容
        //发送
        if(!$mail->Send())
        {
            echo "Mailer  Error: " . $mail->ErrorInfo;
        }
        else
        {
            echo "Message sent!";
        }
