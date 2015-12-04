<!--Links to fix the base_url of pagination breaking our bootstrap/jquery scripts-->
<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
<script src="../../assets/js/jquery-1.11.3.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<div class="form-group" style="width:540px; margin-left: auto; margin-right: auto;">
    <div class="errors"> {message} </div>
    <form action="/roster/update" method="post">
        {fid}
        {fsurname}
        {ffirstname}
        {fnumber}
        {fposition}
        {fmugshot}
        {fsubmit}
    </form>
    <br>
    <span style="display: inline-block">
        <form action="/roster/cancel" method="post">
            {fcancel}
        </form>
    </span>
    <span style="display: inline-block">
        <form action="/roster/delete" method="post">
            {delId}
            {fdelete}
        </form>
    </span>
</div>