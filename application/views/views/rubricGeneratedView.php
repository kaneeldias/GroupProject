<div class="row">
    <div class="col-md-11"></div>
    <div class="btn col-md-1" onclick="print()">
        <i class="fa fa-print" aria-hidden="true"></i>
        <style>
            .btn{
                background-color:#062c33;
                color:white;
                font-weight:bold;
                font-size:20px;
                padding:10px;
                padding-left:20px;
                padding-right:20px;
                cursor:pointer;
                transition:all 0.2s;
                margin-bottom:20px;
            }

            .btn:hover{
                background-color: #0a4d59;
            }
        </style>

    </div>
</div>

<div id="table_p">

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
                <?php if($results->getSetter2() != null):?>
                <?=$results->getSetter2()->getName()?>
                <?php endif?>
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

</div>

<?php if(isset($_GET['success']) && $_GET['success'] == true):?>
    <div id="successModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Success</h4>
                </div>
                <div class="modal-body">
                    <p>Rubrics has been generated successfully.</p>
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

//print a report
<script src="<?=base_url("assets/libraries/html2canvas.min.js")?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
<script src="<?=base_url("assets/libraries/html2canvas.min.js")?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
<script>
    function print(){
        const filename = "pdf.pdf";

        html2canvas(document.getElementById("table_p"), {
            allowTaint:true,
            useCORS: true
        })
            .then(function(canvas) {
                //document.body.appendChild(canvas);
                let pdf = new jsPDF('l', 'mm', 'a4');
                if(canvas.height*277/canvas.width > 190){
                    pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 10, 10, canvas.width*190/canvas.height, 190);
                }
                else{
                    pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 10, 10, 277, canvas.height*277/canvas.width);
                }
                pdf.save(filename);
            });
    }

</script>