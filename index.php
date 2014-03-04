<?php
session_start();
include("config/database.php");
extract($_POST);
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//uerlogin
if(isset($_REQUEST['login']))
{
  if($aid=="" or $apwd=="")
  {
  $err="please enter uername and password";
  }
  else
  {
   $sql=mysql_query("select * from profile where id='$aid'");
	   $data=mysql_fetch_array($sql);
	   if($data['id']!=$aid)
	{
	$err1="plz enter valid username";
	}
	else
	{
	  if($data['pwd']!=$apwd)
		{
		$mail=$aid;
		$err2="please enter correct password";
		}
		else
		{
		 $_SESSION['sid']=$aid; 
		 header("location:account.php");
		}
	}
  }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//user regitration
 if(isset($_REQUEST['reg']))
 {
    if($fname=="" or $lname=="" or $id=="" or $pwd=="" or $cpwd=="" or $g=="" or $date=="" or $month=="" or $year=="")
	{
	$res="please enter all required fields";
	}
	else
	{
	   $sql=mysql_query("select * from profile where id='$id'");
	   $data=mysql_fetch_array($sql);
	   if($data['id']==$id)
	   {
	     $res="id is already exists";
	   }
	   else
	   {
	      if($pwd!=$cpwd)
		  {
		  $res="please enter confirm pasword";
		  }
		  else
		  {
		    mkdir("include/cover/$id");
			mkdir("include/profile_pic/$id");
		     mysql_query("insert into profile values('','$fname','$lname','$id','$pwd','$g','$date-$month-$year','','','')");
		 $_SESSION['sid']=$id; 
		 header("location:account.php");
		  }
	   }
	}
 }
?>
<head>
  <link href="css/style.css" rel="stylesheet" type="text/css">
</head>


<body>
  <div id="wrap">
       <div id="head">
	       <div id="head_left">
		      <div class="logo">
			      <H2>Friends Network</H2>
			  </div>
			  
		   </div>
		   <div id="head_right">
		      <div class="login">
			  <span style="font-size:12px; color:#FF0000;"><?php echo $err;?></span><br>
			    <form action="" method="post">
			      <input type="text" name="aid" placeholder="plz enter email address" class="login_txt" value="<?php echo $mail;?>"> <span style="font-size:12px; color:#FF0000;"><?php echo $err1;?></span><br>
				  <input type="text" name="apwd" placeholder="plz enter password" class="login_txt"> <span style="font-size:12px; color:#FF0000;"><?php echo $err2;?></span><br>
				  <input type="submit" name="login" value="LOGIN" class="login_button">
				</form>
			  </div>
		   </div>
	   </div>
	   
	   
	   
	   <div id="middle">
	      <div id="middle_left">
		     <h2>Social Netwok</h2>
			 <p><strong>
			 PHP is a programming language primarily used for making dynamic Web applications through server-side scripting. Created by Rasmus Lerdorf in 1994, PHP is now managed by a large collaboration of world-wide developers. 
			 </strong></p>
			 <div class="image">
			    <div class="info">
				    <div class="info_left"><img src="image/social_network.jpg.jpg" height="100%" width="100%"></div>
					<div class="info_right">
					It has become the world's most popular technology for dynamic Web pages (alternatives are ASP.NET, JSP, ColdFusion, and CGI scripting), 
					</div>
				</div>
				
				<div class="info">
				    <div class="info_left"><img src="image/social-networking-package.jpg" height="100%" width="100%"></div>
					<div class="info_right">
					It has become the world's most popular technology for dynamic Web pages (alternatives are ASP.NET, JSP, ColdFusion, and CGI scripting), 
					</div>
				</div>
				
				<div class="info">
				    <div class="info_left"><img src="image/HiRes.jpg" height="100%" width="100%"></div>
					<div class="info_right">
					It has become the world's most popular technology for dynamic Web pages (alternatives are ASP.NET, JSP, ColdFusion, and CGI scripting), 
					</div>
				</div>
			 </div>
		  </div>
		  
		  
		  <div id="middle_right">
		    <form action="" method="post">
		     <fieldset>
			     <legend> <h3>Create New  Account</h3></legend>
				    <div style="color:#FF0000;"><?php echo $res;?></div>
				 <div class="reg">
				    First Name<br><input type="text" name="fname" class="reg_txt" placeholder="Enter First Name">
				 </div>
				 <div class="reg">
				      Last Name<br><input type="text" name="lname" class="reg_txt" placeholder="Enter Last Name">
				 </div>
				 <div class="reg">
				       id<br><input type="text" name="id" class="reg_txt" placeholder="Enter id">
				 </div>
				 <div class="reg">
				        Password<br><input type="password" name="pwd" class="reg_txt" placeholder="Enter Password">
				 </div>
				 <div class="reg">
				         Re-enter Password<br><input type="password" name="cpwd" class="reg_txt" placeholder="Re-enter Password">
				 </div>
				 <div class="reg">
				          Gender<br>Male<input type="radio" name="g" value="male">
						            Female<input type="radio" name="g" value="female">
				 </div>
				 <div class="reg">
				       Date Of Birth<br>
					   <select name="date" class="reg_select" >
					       <option value="">date</option>
					       <?php
						   for($i=1;$i<=31;$i++)
						   {
						   echo "<option>$i</option>";
						   }
						   ?>
					   </select>
					   <select name="month" class="reg_select">
					       <option value="">Month</option>
					       <option>januaryt</option>
						   <option>february</option>
						   <option>march</option>
						   <option>april</option>
						   <option>may</option>
					   </select>
					   <select name="year" class="reg_select">
					       <option value="">Year</option>
					        <?php
						   for($i=1960;$i<=2000;$i++)
						   {
						   echo "<option>$i</option>";
						   }
						   ?>
					   </select>
					   
				 </div>
				  <div class="end">
				          <input type="submit" name="reg" value="Register nnow!" class="login_button">
				 </div>
			 </fieldset>
		   </form>
		  </div>
	   </div>
	   
	   <div id="footer"></div>
	   
	   
  </div>
</body>