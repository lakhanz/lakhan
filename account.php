<?php
session_start();
include("config/database.php");
//logout//////////lakhan
$log=$_REQUEST['log'];
if($log=="logout")
{
unset($_SESSION['sid']);
header("location:index.php");
}
//////////////////////////////////////////////////
$id=$_SESSION['sid'];
if($id=="")
{
header("location:index.php");
}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//sset profile picture
$img=$_FILES['img'];
$name=$img['name'];
$type=$img['type'];
$size=$img['size'];
$tmp=$img['tmp_name'];
$target="include/profile_pic/$id/".$name;
if($_REQUEST['up'])
{
move_uploaded_file($tmp,$target);
mysql_query("update profile set pic='$name' where id='$id'");
header("location:account.php?vr=upload");
}

//set pic from uploaded pictures
$new=$_REQUEST['new'];
if($new)
{
mysql_query("update profile set pic='$new' where id='$id'");
header("location:account.php?vr=upload");
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//set theme
$con=$_REQUEST['con'];
if($con)
{
mysql_query("update profile set theme='$con' where id='$id'");
header("location:account.php?vr=theme");
}

///////////////////////////////////////////////////////////////////////////////////////////////
//msg delete
/////////////////
//multiple delete from inbox
$inb=$_REQUEST['inb'];
if($_REQUEST['inbdelete'])
{
    for($i=0;$i<count($inb);$i++)
	{
	$inb1=$inb[$i];
	 $sql=mysql_query("select * from inbox where sr='$inb1'");
	   $data=mysql_fetch_array($sql);
	   mysql_query("insert into trash values('','$data[sender]','$data[rec]','$data[sub]','$data[msg]','$data[date]','$data[time]','inbox')");
	   mysql_query("delete from inbox where sr='$inb1'");
	   header("location:account.php?vr=inbox");
	}
}
/////////////////////////////////////////////////////////////////////////////////

//multiple delete from ent
$sent=$_REQUEST['sent'];
if($_REQUEST['sentdelete'])
{
    for($i=0;$i<count($sent);$i++)
	{
	$sent1=$sent[$i];
	 $sql=mysql_query("select * from sent where sr='$sent1'");
	   $data=mysql_fetch_array($sql);
	   mysql_query("insert into trash values('','$data[to]','$data[rec]','$data[sub]','$data[msg]','$data[date]','$data[time]','sent')");
	   mysql_query("delete from sent where sr='$sent1'");
	   header("location:account.php?vr=sent");
	}
}
/////////////////////////////////////////////////////////////////////////////////


//restore msg from trash
$trash=$_REQUEST['trash'];
if($_REQUEST['restore'])
{
    for($i=0;$i<count($trash);$i++)
	{
	$trash1=$trash[$i];
	 $sql=mysql_query("select * from trash where sr='$trash1'");
	   $data=mysql_fetch_array($sql);
	   mysql_query("insert into $data[path] values('','$data[sender]','$data[rec]','$data[sub]','$data[msg]','$data[date]','$data[time]')");
	   mysql_query("delete from trash where sr='$trash1'");
	   header("location:account.php?vr=trash");
	}
}
/////////////////////////////////////////////////////////////////////////////////



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//fettch user info
 $sql=mysql_query("select * from profile where id='$id'");
	   $data=mysql_fetch_array($sql);
$fname=$data['fname'];
$lname=$data['lname'];
$pic=$data['pic'];
$theme=$data['theme'];
?>
<link href="css/account.css" rel="stylesheet" type="text/css" />
<script>
  function over()
  {
   document.getElementById("pic").style.display="list-item";
  }
  
  function out()
  {
   document.getElementById("pic").style.display="none";
  }
  
  
   //function for dropdown menu
   function over1()
   {
   document.getElementById("menu").style.display="list-item";
   }
   function out1()
   {
   document.getElementById("menu").style.display="none";
   }
   
   ////
    //function for dropdown menu
   function over2()
   {
   document.getElementById("menu1").style.display="list-item";
   }
   function out2()
   {
   document.getElementById("menu1").style.display="none";
   }
</script>
<body background="theme/<?php echo $theme;?>">
<div id="wrap">
   <div id="head">
      <div id="head_left">
	      <div class="logo">
		     <h2>Friends Network</h2>
		  </div>
	  </div>
	  
      <div id="head_center">
	     <div style="float:left; padding-left:20px;" onMouseOver="over2()" onMouseOut="out2()"><strong>Requests</strong>
		      <div id="menu1">
			        <?php
					 $sql=mysql_query("select * from request where rec='$id'");
	                 while($data=mysql_fetch_array($sql))
					 {
					     $sql1=mysql_query("select * from profile where id='$data[sender]'");
	                     $data1=mysql_fetch_array($sql1);
				      echo "<div class='item' style='border-bottom:black solid 1px;'>
					  <img src='include/profile_pic/$data[sender]/$data1[pic]' height='16' width='16'>&nbsp;$data1[fname] $data1[lname]&nbsp;
					  <a href='account.php?vr=accept'>confirm</a>&nbsp;<a href='account.php?vr=reject'>reject</a></div>";
					  
					 }
					  ?>
				</div>	 
		 </div>&nbsp;
		 <div style="float:left; padding-left:10px;"><strong>Notification</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
		 <div style="float:right"><input type="text" name="search" placeholder="Enter name,place or things" class="search"></div>
	  </div>
	  <div id="head_right">
	      <div class="top">
		     <span><a href="profile.php"><img src="include/profile_pic/<?php echo $id;?>/<?php echo $pic;?>" height="20" width="18">&nbsp;<?php echo "$fname $lname";?></a></span>
			 <span><a href="account.php">Home</a></span>
			 <div id="main" onMouseOver="over1()" onMouseOut="out1()"><a href="#">Setting</a>
			     <div id="menu">
				      <div class="item"><a href="#">Edit pwd</a></div>
					  <div class="item"><a href="account.php?vr=theme">Edit theme</a></div>
					  <div class="item"><a href="account.php?log=logout">Logout</a></div>
				 </div>
			   
			 </div>
		  </div>
	  </div>
   </div>
   
   
   
   <div id="middle">
   
   
      <div id="middle_left">
	     <div id="profile" onMouseOver="over()" onMouseOut="out()">
		   <img src="include/profile_pic/<?php echo $id;?>/<?php echo $pic;?>" class="image" >
		     <div id="pic"><a href="account.php?vr=upload">Edit Picture</a></div>
			<div class="name"><?php echo "$fname $lname";?></div>
		 </div>
		 
		 <div id="info">
		     <h2>Mail</h2>
			 <ul>
			    <li><a href="account.php?vr=compose">Compose</a></li>
				<li><a href="account.php?vr=inbox">Inbox</a></li>
				<li><a href="#">Draft</a></li>
				<li><a href="account.php?vr=sent">Sent</a></li>
				<li><a href="account.php?vr=trash">Trash</a></li>
			 </ul>
			  <h2>Mail</h2>
			 <ul>
			    <li><a href="#">Compose</a></li>
				<li><a href="#">Inbox</a></li>
				<li><a href="#">Draft</a></li>
				
			 </ul>
			  <h2>Friend Area</h2>
			 <ul>
			    <li><a href="#">Friend Requests</a></li>
				<li>
				  <?php
				  $date=date("d-m-y");
				   $time=date("h:i:s");
				  $req=$_REQUEST['req'];
				  if($_REQUEST['req_sent'])
				  {
				      if($req=="")
					  {
					  echo "<span class='err'>plz enter user id</span>";
					  }
					  else
					  {
					     $sql=mysql_query("select * from profile where id='$req'");
	                     $data=mysql_fetch_array($sql);
	                     if($data['id']!=$req)
						 {
						 echo "<span class='err'>plz enter valid user id</span>";
						 }
						 else
						 {
						     $sql=mysql_query("select sender as frnd from friend where acceptor='$id' and sender='$req' union select acceptor as frnd from friend where acceptor='$req' and sender='$id'");
	                         $data=mysql_fetch_array($sql);
	                         if($data['frnd']==$req)
							 {
							  echo "<span class='err'>already friends</span>";
							 }
							 else
							 {
							     $sql=mysql_query("select * from request where rec='$req' and sender='$id'");
	                            $data=mysql_fetch_array($sql);
	                            if($data['rec']==$req)
								{
								 echo "<span class='err'>request already sent</span>";
								}
								else
								{
								mysql_query("insert into request values('','$id','$req','$date','$time')");
								echo "<span class='err1'>request sent</span>";
								}
							 }
						 }
					  }
				  }
				  ?>
				</li>
				<form action="" method="post">
				<li><input type="text" name="req" class="txt"></li>
				<li><input type="submit" name="req_sent" value="Send" class="button"></li>
				</form>
			 </ul>
		 </div>
	  </div>
	  
	  
	  
	  <div id="middle_center">
	     <div id="data">
	     <?php
		 $vr=$_REQUEST['vr'];
		 if($vr=="compose")
		 {
		 include("compose.php");
		 }
		 if($vr=="inbox")
		 {
		 include("inbox.php");
		 }
		 
		  if($vr=="sent")
		 {
		 include("sent.php");
		 }
		  if($vr=="trash")
		 {
		 include("trash.php");
		 }
		 
		  if($vr=="upload")
		 {
		 include("upload.php");
		 }
		 
		  if($vr=="theme")
		 {
		 include("theme.php");
		 }
		 
		 
		  if($vr=="accept")
		{
		
		 $sql=mysql_query("select * from request where rec='$id'");
	     $data=mysql_fetch_array($sql);
		 $req=$data['sender'];
		 mysql_query("insert into friend values('','$req','$id')");
		 
		 mysql_query("delete from request where rec='$id'");
		 }
		 
		 
		  if($vr=="reject")
		{
		 $sql=mysql_query("select * from request where rec='$id'");
	     $data=mysql_fetch_array($sql);
		 $req=$data['sender'];
		 mysql_query("delete from request where sender='$req'");
		 }
		 ?>
	    </div> 
	  </div>
	  
	  
	  
	  <div id="middle_right"><?php echo $err; ?></div>
   </div>

</div>
