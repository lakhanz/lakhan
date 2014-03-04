<form action="" method="post">
<div id="inbox">
<H2>Innbox(<?php echo $i;?>)</H2>
<table>
<tr>
  <th>Select</th><th>Subject</th><th>Sender</th><th>Date</th><th>Time</th><th>Delete</th>
</tr>
<?php
$file=mysql_query("select * from inbox where rec='$id'");
while($data=mysql_fetch_array($file))
{
   echo "<tr>";
   echo "<td><input type='checkbox' name='inb[]' value='$data[sr]'></td>";
   echo "<td><a href='account.php?inbaccess=$data[sr]'>$data[sub]</a></td>";
   echo "<td>$data[sender]</td>";
   echo "<td>$data[date]</td>";
   echo "<td>$data[time]</td>";
   echo "<td><a href='account.php?inb_single=$data[sr]'><img src='image/close.png' height='16' width='16'></a></td>";
  
   echo "</tr>";
   
}
?>
<tr>
   <td colspan="6" style="background-color:#999999;"><input type="submit" name="inbdelete" value="DELETE" class=""></td>
</tr>
</table>
</div>
</form>