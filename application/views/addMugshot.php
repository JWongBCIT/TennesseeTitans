<!--Links to fix the base_url of pagination breaking our bootstrap/jquery scripts-->
<link rel="stylesheet" href="{basic_url}/assets/css/bootstrap.min.css">
<script src="{basic_url}/assets/js/jquery-1.11.3.min.js"></script>
<script src="{basic_url}/assets/js/bootstrap.min.js"></script>
<Br>
{message}
<form action="{basic_url}roster/do_upload" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="Upload Image" />

</form>