<!--Links to fix the base_url of pagination breaking our bootstrap/jquery scripts-->
<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
<script src="../../assets/js/jquery-1.11.3.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<div style="width:30em; margin-left: auto; margin-right: auto;">
    {player}
    <div class="roster-cell col-md-3">
        <a href="/roster/player/{id}"><img height="300"  src="../../assets/images/players/{mugshot}" title="{surname}"/></a>
        <p style="margin-bottom: 2em;">#{number} - {surname}, {firstname}</p>
    </div>
    {/player}
</div>