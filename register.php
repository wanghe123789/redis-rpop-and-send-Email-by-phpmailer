 
<!DOCTYPE html>
 <html>
 <head>
 	<title>注册</title>
 </head>
 <body>
 	<form action="register_do.php" method="post">
 		用户名： <input type="text" name="username"><br>
 		密码： <input type="password" name="password"><br>
 		确认密码： <input type="password" name="pwd"><br>
 		邮箱： <input type="text" name="email"><br>
 		额外信息： <input type="checkbox" id="more"><br>
 		<div id="shadow">
 			密码问题： <input type="text" name="question"><br>
	 		密码答案： <input type="text" name="answer"><br>
	 		性别： 	男<input type="radio" name="sex" value="男">
	 				女<input type="radio" name="sex" value="女"><br>
 		</div>		
 		<input type="submit" value="提交注册信息">
 	</form>
 </body>
 </html>
 <script type="text/javascript" src="jquery-1.8.3.js"></script>
 <script type="text/javascript">
 	$(function() {
  		$("#shadow").css("display","none");
  		$("#more").click(function(){
  			$("#shadow").toggle();
  		})
	});
 </script>
