<?php
session_start();
include("config/database.php");
//logout
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
$target="include/cover/$id/".$name;
if($_REQUEST['up'])
{
move_uploaded_file($tmp,$target);
mysql_query("update profile set cover='$name' where id='$id'");
header("location:profile.php?vr=upload");
}

//set pic from uploaded pictures
$new=$_REQUEST['new'];
if($new)
{
mysql_query("update profile set cover='$new' where id='$id'");
header("location:profile.php?vr=upload");
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//fettch user info
$sql=mysql_query("select * from profile where id='$id'");
	   $data=mysql_fetch_array($sql);
$fname=$data['fname'];
$lname=$data['lname'];
$cover=$data['cover'];
$theme=$data['theme'];
$pic=$data['pic'];
?>
<link href="css/profile.css" rel="stylesheet" type="text/css" />
<script>
   function over()
   {
   document.getElementById("edit_cover").style.display="list-item";
   }
   function out()
   {
   document.getElementById("edit_cover").style.display="none";
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
	     <a href="#"><strong>Requests</strong></a>&nbsp;
		 <a href="#"><strong>Notification</strong></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		 <input type="text" name="search" placeholder="Enter name,place or things" class="search">
	  </div>
	  
	  <div id="head_right">
	      <div class="top">
		     <span><a href="profile.php"><img src="include/profile_pic/<?php echo $id;?>/<?php echo $pic;?>" height="20" width="18">&nbsp;<?php echo "$fname $lname";?></a></span>
			 <span><a href="account.php">Home</a></span>
			 <div id="main" onMouseOver="over1()" onMouseOut="out1()"><a href="#">Setting</a>
			     <div id="menu">
				      <div class="item"><a href="#">Edit pwd</a></div>
					  <div class="item"><a href="profile.php?vr=theme">Edit theme</a></div>
					  <div class="item"><a href="profile.php?log=logout">Logout</a></div>
				 </div>
			   
			 </div>
			 
		  </div>
	  </div>
   </div>
   
   
   
   <div id="middle">
   
   
      <div id="middle_left">
	     vbnhm
	  </div>
	  
	  
	  
	  <div id="middle_center">
	     <div onMouseOver="over()" onMouseOut="out()" style=" height:55px; width:97%; background-image:url(include/cover/<?php echo $id;?>/<?php echo $cover;?>); padding-top:245px; padding-right:3%;">
		 
		    <div id="edit_cover"><a href="profile.php?vr=upload">Edit Cover Picture</a></div>
		    <div class="profile">
			   <img src="include/profile_pic/<?php echo $id;?>/<?php echo $pic;?>">
			</DIV>
		 </div>
		 <div id="item">
		     <div class="name"><?php echo "$fname $lname";?></div>
			  <div class="friend"></div>
			   <div class="friend"></div>
			   
			  
		 
		
		 </div>
		 
		 <?php
		    $vr=$_REQUEST['vr'];
		 if($vr=="upload")
		 {
		 include("upload1.php");
		 }
       ?>		 
	  </div>
	  
	  
	  
	  <div id="middle_right"></div>
   </div>

</div>