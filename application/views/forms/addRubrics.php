<div class="row">
    <div class="col-md-6 mx-auto form_container">

        <div class="form_title">Add Rubrics</div>


        <form id="addRubricsForm" class="column form_content" method="POST" action="<?=base_url("rubrics/add/process")?>">

            <div class="row col-md-12">

                <div class="form_item col-md-4">
                    <span class="form_label">Course</span>
                    <select class="form_input" name="code">
                        <option selected disabled></option>
                        <?php foreach($subjects as $subject): ?>
                            <option value="<?=$subject->getId()?>"><?=$subject->getName()?></option>
                        <?php endforeach?>
                    </select>
                </div>


                <div class="form_item col-md-2">
                </div>

                <div class="form_item col-md-4">
                    <span class="form_label">Setter 1</span>
                    <select class="form_input" name="setter1">
                        <option selected disabled></option>
                        <?php foreach($staff as $s): ?>
                            <option value="<?=$s->getId()?>"><?=$s->getName()?></option>
                        <?php endforeach?>
                    </select>
                </div>

            </div>


            <div class="row col-md-12">
                <div class="form_item col-md-4">
                    <span class="form_label">Sem.Exam Perecentage</span>
                    <select id="semP" class="form_input" name="semExam" onchange="autoChange()">
                        <option selected disabled></option>
                        <?php for($i = 0; $i<=10; $i++):?>
                            <option
                                value="<?=$i*10?>"><?=$i*10?></option>
                        <?php endfor?>
                    </select>
                </div>


                <div class="form_item col-md-2">
                </div>
                <div class="form_item col-md-4">
                    <span class="form_label">Setter 2</span>
                    <select class="form_input" name="setter2">
                        <option selected disabled></option>
                        <?php foreach($staff as $s): ?>
                            <option value="<?=$s->getId()?>"><?=$s->getName()?></option>
                        <?php endforeach?>
                    </select>
                </div>
            </div>

            <div class="row col-md-12">
                <div class="form_item col-md-4">
                    <span class="form_label">Assesment Perecentage</span>
                    <select id="assP" class="form_input" name="assesment" onchange="autoChange2()">
                        <option selected disabled></option>
                        <?php for($i = 0; $i<=10; $i++):?>
                            <option
                                    value="<?=$i*10?>"><?=$i*10?></option>
                        <?php endfor?>
                    </select>
                </div>

                <div class="form_item col-md-2">
                </div>
                <div class="form_item col-md-4">
                    <span class="form_label">Moderator</span>
                    <select class="form_input" name="moderator">
                        <option selected disabled></option>
                        <?php foreach($staff as $s): ?>
                            <option value="<?=$s->getId()?>"><?=$s->getName()?></option>
                        <?php endforeach?>
                    </select>
                </div>

            </div>

            <div class="row col-md-12">
                    <div class="form_item col-md-10">
                        <span class="form_label">Rubrics of the Semester Exam</span>
                            <input  class="form_input" type="text" placeholder="Code" name="examRubrics"/>
                        </select>
                    </div>
            </div>
            <div class="row col-md-12">
                <div class="form_item col-md-3">
                    <button type="submit">Submit</button>
                </div>
            </div>

            </div>



        </form>
    </div>
</div>

<?php if(isset($_GET['error']) && $_GET['error'] == true):?>
    <div id="errorModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Error</h4>
                </div>
                <div class="modal-body">
                    <p>There was an error in your form. Please try again.</p>
                </div>
                <div class="modal-footer">
                    <button type="button"  data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <script>
        $('#errorModal').modal('show');
    </script>
<?php endif ?>


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

<script src="<?=base_url('/assets/js/validation/add_rubrics_validation.js')?>"></script>

<style>
    label.error{
        color:red;
        font-size:12px;
        margin:0px;
        margin-left:5px;
    }
</style>

<script>
    function autoChange(){
        var sem = $("#semP").val();
        var ass = 100 - sem;
        $("#assP").val(ass);
    }

    function autoChange2(){
        var sem = $("#assP").val();
        var ass = 100 - sem;
        $("#semP").val(ass);
    }
</script>