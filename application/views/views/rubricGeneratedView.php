<link href="<?=base_url("assets/css/table_styles.css")?>" rel="stylesheet" type="text/css"></link>

<table id="rubricTable" class="custom_table col-md-12">
    <tr class="header">
        <td>Course Code</td>
        <td>Name</td>
        <td>Sem.Exam</td>
        <td>Assesments</td>
        <td>Rubric of the Semester exam</td>
        <td>Setter/1st Examiner</td>
        <td>Moderator/2nd Examiner</td>
    </tr>
    <?php foreach($array as $results):?>
        <tr>
            <td><?=$results->getSubject()->getCode()?></td>
            <td><?=$results->getSubject()->getName()?></td>
            <td><?=$results->getExam()?></td>
            <td><?=$results->getAssesments()?></td>
            <td><?=$results->getRubric()?></td>

            <?php if($results->getSetter1() != ""):?>
            <td>
                <?=$results->getSetter1()->getName()?>
                <br>
                <?=$results->getSetter2()->getName()?>
            </td>
            <td><?=$results->getModerator()->getName()?></td>
            <?php else:?>
                <td></td>
                <td></td>
            <?php endif?>
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
                    <p>Subject has been added successfully.</p>
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