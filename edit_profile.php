<?php
$f1=$_REQUEST['f1'];
$l1=$_REQUEST['l1'];
$g1=$_REQUEST['g1'];
$c1=$_REQUEST['c1'];
$file=$_REQUEST['file'];
$img=$_FILES['file'];
$name=$img['name'];
$type=$img['type'];
$size=$img['size'];
$tmp=$img['tmp_name'];
$target="database/$id/profile_pic/".$name;

if($_REQUEST['edit_profile'])
{
file_put_contents("database/$id/profile/first name",$f1);
file_put_contents("database/$id/profile/last name",$l1);
file_put_contents("database/$id/profile/gender",$g1);
file_put_contents("database/$id/profile/city",$c1);
file_put_contents("database/$id/pic",$name);
move_uploaded_file($tmp,$target);
}


?>
<form action="" method="post" enctype="multipart/form-data">
<fieldset style="width:70%; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; color:#996600;">
   <legend><h1>User Profile</h1></legend>
   <table width="50%" height="273" border="0">
  <tr>
    <th>First Name </th>
    <th><input type="text" name="f1" value="<?php echo $fname;?>" /></th>
  </tr>
  <tr>
    <th>Last Name </th>
    <th><input type="text" name="l1" value="<?php echo $lname;?>" /></th>
  </tr>
  <tr>
    <th>Gender</th>
    <th><input type="text" name="g1" value="<?php echo $gender;?>" /></th>
  </tr>
  <tr>
    <th height="47">City</th>
    <th><input type="text" name="c1" value="<?php echo $city;?>" /></th>
  </tr>
  <tr>
    <th>Profile Picture </th>
    <th><INPUT type="file" name="file"></th>
  </tr>
  <tr>
    <th><input type="submit" name="edit_profile" value="UPDATE"></th>
  </tr>
</table>

</fieldset>
</form>