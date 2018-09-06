<div id="alert_modal" class="modal">
    <div class="modal-content animate">

        <div class="imgcontainer">
            <span onclick="document.getElementById('alert_modal').style.display='none'" class="close" title="Close Modal">&times;</span>
        </div>

        <div id="alert_title">

        </div>
    </div>

</div>

<script>
    function show_alert(title){
        console.log("hello");
        document.getElementById("alert_title").innerHTML = title;
        document.getElementById('alert_modal').style.display='block'
    }
</script>

<style>
    #alert_title{
        margin:10px;
        font-size:20px;
        text-align:center;
        margin-bottom:20px;
    }
</style>
