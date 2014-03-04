<?php
$date=date("d-m-y");
$time=date("h:i:s");
$to=$_REQUEST['to'];
$sub=$_REQUEST['sub'];
$msg=$_REQUEST['msg'];
//send msg

if($_REQUEST['send'])
{
    if($to=="")
	{
	$res="<font color='red'>plz enter user id</font>";
	}
	else
	{
	      $sql=mysql_query("select * from profile where id='$to'");
	   $data=mysql_fetch_array($sql);
	    if($data['id']!=$to)
		{
		mysql_query("insert into inbox values('','$id','$id','msg failed-$sub','$msg','$date','$time')");
		$res="<font color='red'>msg failed</font>";
		}
		else
		{
		   if($sub=="")
		   {
		  mysql_query("insert into inbox values('','$id','$to','no-subject','$msg','$date','$time')");
		   mysql_query("insert into sent values('','$to','$id','no-subject','$msg','$date','$time')");
		  $res="<font color='green'>msg sent</font>";
		   }
		   else
		   {
		   mysql_query("insert into inbox values('','$id','$to','$sub','$msg','$date','$time')");
		   mysql_query("insert into sent values('','$to','$id','$sub','$msg','$date','$time')");
		  $res="<font color='green'>msg sent</font>";
		   }
		}
	}
}


//save msg
if($_REQUEST['save'])
{
   if($sub=="")
   {
   file_put_contents("database/$id/draft/no-subject",$msg);
   $res="msg saved";
   }
   else
   {
    file_put_contents("database/$id/draft/$sub",$msg);
   $res="msg saved";
   }
}
?>
<form action="" method="post">
<div id="compose">
    <h2>Compose</h2>
	  <div style=" font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; text-align:center;"><?php echo $res;?></div>
    <div class="box">
	   TO <BR>
	   <INPUT type="text" name="to">
	</div>
	<div class="box">
	   SUBJECT <BR>
	   <INPUT type="text" name="sub">
	</div>
	<div class="box">
	    MESSAGE <BR>
	   <textarea name="msg">
	   </textarea>
	</div>
	<div class="box">
	   <input type="submit" name="send" value="Send"><input type="submit" name="save" value="Save">
	</div>
</div>


</form>