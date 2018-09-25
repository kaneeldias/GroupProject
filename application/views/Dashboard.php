<div class="row col-md-12" id="dashboard">
    <div class="column col-md-3 dashboard_links" style="padding:0px;">
        <a href="<?=base_url("signup")?>"><div class="dashboard_link">Register User</div></a>
        <a href="<?=base_url("add-subject")?>"><div class="dashboard_link">Add Subject</div></a>
        <a href="<?=base_url("add-lecturer")?>"><div class="dashboard_link">Add Lecturer</div></a>
        <a href="<?=base_url("lecture-halls")?>"><div class="dashboard_link">Lecture Halls</div></a>
        <a href="<?=base_url("add-student-group")?>"><div class="dashboard_link">Add Student Group</div></a>
        <a href="<?=base_url("time-table/group?group=5&semester=1")?>"><div class="dashboard_link">Time Tables</div></a>
    </div>
    <div class="row col-md-9" style="display:flex; align-items:center; text-align:center;">
        <div class="mx-auto">
            <img style="width:700px;" src="https://i.ytimg.com/vi/Zu7pIrl5XbU/maxresdefault.jpg"/>
        </div>
    </div>
</div>


<style>
    #content{

    }

    #dashboard{
        border-color:#22313f;
        border-radius:5px;
        border-style:solid;
        border-width:2px;
        //box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        padding:0px;
    }

    .dashboard_links{
        background-color:#22313f;
    }

    .dashboard_links a{
        text-decoration:none;
    }

    .dashboard_link{
        padding:20px;
        background-color:#22313f;
        color:white;
        text-transform:uppercase;
        font-size:18px;
        transition:all 0.2s;
        cursor:pointer;
    }

    .dashboard_link:hover{
        background-color: #364e64;
    }
</style>