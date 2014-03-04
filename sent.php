<form action="" method="post">
<div id="inbox">
<H2>Sent(<?php echo $i;?>)</H2>
<table>
<tr>
  <th>Select</th><th>Subject</th><th>TO</th><th>Date</th><th>Time</th><th>Delete</th>
</tr>
<?php
$file=mysql_query("select * from sent where rec='$id'");
while($data=mysql_fetch_array($file))
{
   echo "<tr>";
   echo "<td><input type='checkbox' name='sent[]' value='$data[sr]'></td>";
   echo "<td><a href='account.php?sentaccess=$data[sr]'>$data[sub]</a></td>";
   echo "<td>$data[to]</td>";
   echo "<td>$data[date]</td>";
   echo "<td>$data[time]</td>";
   echo "<td><a href='account.php?sent_single=$data[sr]'><img src='image/close.png' height='16' width='16'></a></td>";
  
   echo "</tr>";
   
}
?>
<tr>
   <td colspan="6" style="background-color:#999999;"><input type="submit" name="sentdelete" value="DELETE" class=""></td>
</tr>
</table>
</div>
</form>