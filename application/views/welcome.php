<div style="width:545px; margin-left: auto; margin-right: auto;">
    <img src="../assets/images/titans_logo.gif">
</div>
<br>

<div style="width:575px; margin-left: auto; margin-right: auto;" >
    <h4>Check predictions: </h4>
        {dropdown}
        <br>
        <button id="btnI" class="btn btn-default">Check!</button>

    <div id="prediction">

    </div>
</div>

<p style="margin-top: 2em; font-size: 1.5em; width:575px; margin-left: auto; margin-right: auto; ">The Tennessee Titans are a professional American football team and one of the 32 franchises
    of the National Football League (NFL). Based in Nashville, Tennessee, the Titans are members
    of the South Division of the American Football Conference (AFC). Previously known as the 
    Houston Oilers, the team began play in 1960 in Houston as a charter member of the American Football League.
    The Oilers won the first two AFL championships, and joined the NFL as part of the AFL-NFL Merger in 1970.</p>

<script>
    $(document).ready(function () {
        $('#btnI').click(jsFunc);
        var jsFunc = function(){
            $.get("welcome/doAjaxCheck/" + $opponent, function (data) {
                $("#prediction").html(data);
                alert("Load was performed.");
            });
        }
    });
</script>