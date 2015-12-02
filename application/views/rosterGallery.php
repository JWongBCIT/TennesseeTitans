<!--Links to fix the base_url of pagination breaking our bootstrap/jquery scripts-->
<link rel="stylesheet" href="{basic_url}/assets/css/bootstrap.min.css">
<script src="{basic_url}/assets/js/jquery-1.11.3.min.js"></script>
<script src="{basic_url}/assets/js/bootstrap.min.js"></script>

{table-head}
{add_player}
<br /><br />
<div>
    {players}
    <div class="roster-cell col-md-3">
        <img height = "80" src="../assets/images/players/{mugshot}" title="{surname}"/>
        <p style="margin-bottom: 2em">#{number} -  <a href="/roster/player/{id}">{surname}, {firstname}</a></p>
    </div>
    {/players}
</div>

<div class="pagination_links">
    {links}
</div>