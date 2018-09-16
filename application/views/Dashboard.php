<div class="row col-md-12 h-100 no-gutters" id="dashboard">
    <div class="column col-md-3 dashboard_links">
        <a href="<?=base_url("signup")?>"><div class="dashboard_link">Register User</div></a>
        <a href="<?=base_url("add-subject")?>"><div class="dashboard_link">Add Subject</div></a>
        <a href="<?=base_url("add-lecturer")?>"><div class="dashboard_link">Add Lecturer</div></a>
        <a href="<?=base_url("add-lecture-hall")?>"><div class="dashboard_link">Add Lecture Hall</div></a>
        <a href="<?=base_url("add-student-group")?>"><div class="dashboard_link">Add Student Group</div></a>
        <a href="<?=base_url("time-table?group=5&semester=1")?>"><div class="dashboard_link">Time Tables</div></a>
    </div>
</div>


<style>
    #content{
        margin-top:57px !important;
        margin-bottom:0px !important;
    }

    #dashboard{
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