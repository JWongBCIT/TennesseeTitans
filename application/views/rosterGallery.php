<!--Links to fix the base_url of pagination breaking our bootstrap/jquery scripts-->
<link rel="stylesheet" href="{basic_url}/assets/css/bootstrap.min.css">
<script src="{basic_url}/assets/js/jquery-1.11.3.min.js"></script>
<script src="{basic_url}/assets/js/bootstrap.min.js"></script>

{table-head}

<!--<a href="/Player/add" id="player_add_button" class="btn btn-info" role="button">Add Player</a>-->

<br /><br />
<div>
    {players}
    <div class="roster-cell col-md-3">
        <a href="/player/view/{id}"><img height = "80" src="../assets/images/players/{mugshot}" title="{surname}"/></a>
        <p style="margin-bottom: 2em">#{number} - {surname}, {firstname}</p>
    </div>
    {/players}
</div>

<div class="pagination_links">
    {links}
</div>