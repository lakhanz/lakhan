<form action="" method="post">
<H2>Trash(<?php echo $l;?>)</H2>
<table>
<?php
$file=opendir("database/$id/draft");
while($data=readdir($file))
{
   if($data!="." && $data!=".." && $data!="Thumbs.db")
   {
   echo "<tr>";
   echo "<td><input type='checkbox' name='draft[]' value='$data'></td>";
     echo "<td><a href='account.php?draftaccess=$data'>$data</a></td>";
   echo "<td><a href='account.php?draft_single=$data'><img src='close.png' height='16' width='16'></a></td>";
   echo "</tr>";
   }
}
?>
<tr>
   <td colspan="3"><input type="submit" name="draftdelete" value="DELETE"></td>
</tr>
</table>
</form>