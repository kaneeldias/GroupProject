<link href="<?=base_url("assets/css/table_styles.css")?>" rel="stylesheet" type="text/css"></link>

<div class="row control_panel col-md-12">


    <div class="control_panel_title align-text-bottom"></div>

    <div class="flex-grow-1"></div>


   <div class="control_panel_actions">
        <a href="<?=base_url("rubrics/add")?>"><button>Add Data</button></a>
        <a href="<?=base_url("rubrics/generate")?>"><button>Generate Reports</button></a>
   </div>


    <style>
        .control_panel{
            background-color:#22313f;
            color:white;
            margin-bottom:20px;
            padding:20px;
            border-radius:5px;
        }

        .control_panel_title{
            font-size:25px;
            font-weight:bold;
            display: flex;
            align-items: center;
        }

        .control_panel_actions button{
            background-color:white;
            border:none;
            color:#22313f;
            padding:10px;
            font-size:20px;
            border-radius:3px;
            transition:all 0.2s;
            padding-left:20px;
            padding-right:20px;
            cursor:pointer;
        }

        .control_panel_actions button:hover{
            background-color:#DDDDDD;
            color:#22313f;
        }
    </style>
</div>
<table id="rubricTable" class="custom_table col-md-12">
    <tr class="header">
        <td>Course Code</td>
        <td>Name</td>
        <td>Sem.Exam</td>
        <td>Assesments</td>
        <td>Rubric of the Semester exam</td>
        <td>Setter/1st Examiner</td>
        <td>Moderator/2nd Examiner</td>
        <td></td>
        <td></td>

    </tr>
    <?php foreach($array as $results):?>
        <tr>
            <td><?=$results->getSubject()->getCode()?></td>
            <td><?=$results->getSubject()->getName()?></td>
            <td><?=$results->getExam()?></td>
            <td><?=$results->getAssesments()?></td>
            <td><?=$results->getRubric()?></td>
            <td>
                <?=$results->getSetter1()->getName()?>
                <br>
                <?=$results->getSetter2()->getName()?>
            </td>
            <td><?=$results->getModerator()->getName()?></td>
            <td><a href="<?=base_url("rubrics/edit/?id=".$results->getId())?>"><button class="edit_button">Edit</button></a></td>
            <td><a href="<?=base_url("rubrics/delete/?id=".$results->getId())?>"><button class="delete_button">Delete</button></a></td>
        </tr>
    <?php endforeach?>
</table>


<style>
    td{
        border-width:1px;
        border-style:solid;
        border-color:black;
        padding:10px;
    }
</style>

<?php if(isset($_GET['success']) && $_GET['success'] == true):?>
    <div id="successModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Success</h4>
                </div>
                <div class="modal-body">
                    <p>Rubric has been added successfully.</p>
                </div>
                <div class="modal-footer">
                    <button type="button"  data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <script>
        $('#successModal').modal('show');
    </script>
<?php endif ?>