<?php
extract($_POST);
if(isset($update))
{
   if($op=="" or $np=="" or $cp=="")
   {
    $res="pz enter all required fields";
   }
   else
   {  
   $rpwd=file_get_contents("database/$id/profile/Password");
      if($rpwd!=$op)
	  {
	  $res="plz enter correct old password";
	  }
	  else
	  {
	     if($np!=$cp)
		 {
		   $res="plz enter confirm new password";
		 }
		 else
		 {
		 file_put_contents("database/$id/profile/Password",$np);
		 $res="password is updated";
		 }
	  }
   }
}
?>
<form action="" method="post">
<table width="40%" border="0">
  <tr>
    <td colspan="2" align="center">&nbsp;<?php echo $res;?></td>
    
  </tr>
  <tr>
    <td>Old Pasword </td>
    <td><input type="text" name="op" /></td>
  </tr>
  <tr>
    <td>New Password </td>
    <td><input type="text" name="np" /></td>
  </tr>
  <tr>
    <td>Confirm Password </td>
    <td><input type="text" name="cp" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="update" value="UPDATE" /></td>
    
  </tr>
</table>

</form>