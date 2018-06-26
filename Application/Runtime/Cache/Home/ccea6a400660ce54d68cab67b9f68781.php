<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="icon" type="image/png" href="/activity/Avatar/logo.png">
	</head>
	<body>
		<div class="login" style="background: salmon;width: 300px;">
			<form  action="<?php echo U('Index/check_login');?>" method="post">
				账号：<input name="snum"/><br />
				密码：<input name="spwd"  type="password"/><br />
				<input type="submit" value="登录"/>
			</form>
		</div>
	</body>
</html>