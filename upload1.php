<div id="inbox">
<H2>Upload Profile Picture</H2>
<form action="" method="post" enctype="multipart/form-data">
Upload Picture : <input type="file" name="img"><br><input type="submit" name="up" value="Upload">

<br><br>
  <div id="uploaded">
<H2>Uploaded Picture</H2>

<?php
$file=opendir("include/cover/$id");
while($data=readdir($file))
{
   if($data!="." && $data!=".." && $data!="Thumbs.db" && $data!=$pic)
   {
   echo "<a href='profile.php?new=$data'><img src='include/cover/$id/$data' height='70' width='70' border='1'></a>";
   }
}
?>
  </div>

</form>
</div>