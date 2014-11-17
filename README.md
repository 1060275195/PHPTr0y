###如何使用

首先将PHPTr0y.php上传到服务器，Web可访问目录，

例如：将PHPTr0y.php 存储到服务的:

	/wwwroot/sites/example.com/PHPTr0y.php
	
通过Web访问则是

	http://example.com/PHPTr0y.php?get=phptr0y

注意url中的get参数是必须的，否则你访问到的会是空白页。

完成后会看到登录界面，输入用户名，root (默认), 密码：modify_password (默认)

为了使用方面，你可以在源代码中修改用户名和密码。

	$tr0yname="root";
	$tr0ypass="modify_password";
