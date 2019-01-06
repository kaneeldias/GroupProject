<div class="row">
    <div class="col-md-6 mx-auto form_container">

        <div class="form_title">Edit Rubrics</div>


        <form id="editRubricsForm" class="column form_content" method="POST" action="<?=base_url("rubrics/edit/process")?>">

            <input type="hidden" id="id_field" value="<?=$rubric->getId()?>" name="id"/>

            <div class="row col-md-12">

                <div class="form_item col-md-4">
                    <span class="form_label">Course</span>
                    <select class="form_input" name="code">
                        <?php foreach($subjects as $subject): ?>
                            <option
                                    <?php if($subject->getId() == $rubric->getSubject()->getId()):?>selected<?php endif?>
                                    value="<?=$subject->getId()?>"><?=$subject->getName()?></option>
                        <?php endforeach?>
                    </select>
                </div>


                <div class="form_item col-md-2">
                </div>

                <div class="form_item col-md-4">
                    <span class="form_label">Setter 1</span>
                    <select class="form_input" name="setter1">
                        <?php foreach($staff as $s): ?>
                            <option
                                <?php if($s->getId() == $rubric->getSetter1()->getId()):?>selected<?php endif?>
                                value="<?=$s->getId()?>"><?=$s->getName()?></option>
                        <?php endforeach?>
                    </select>
                </div>

            </div>


            <div class="row col-md-12">
                <div class="form_item col-md-4">
                    <span class="form_label">Sem.Exam Perecentage</span>
                    <select class="form_input" name="semExam">
                        <?php for($i = 0; $i<=10; $i++):?>
                            <option
                                <?php if($rubric->getExam() == $i*10):?>selected<?php endif?>
                                value="<?=$i*10?>"><?=$i*10?></option>
                        <?php endfor?>
                    </select>
                </div>

                <div class="form_item col-md-2">
                </div>
                <div class="form_item col-md-4">
                    <span class="form_label">Setter 2</span>
                    <select class="form_input" name="setter2">
                        <option  value=""></option>
                        <?php foreach($staff as $s): ?>
                            <option
                                <?php if($rubric->getSetter2() != "" && $s->getId() == $rubric->getSetter2()->getId()):?>selected<?php endif?>
                                value="<?=$s->getId()?>"><?=$s->getName()?></option>
                        <?php endforeach?>

                    </select>
                </div>
            </div>

            <div class="row col-md-12">
                <div class="form_item col-md-4">
                    <span class="form_label">Assesment Perecentage</span>
                    <select class="form_input" name="assesment">
                        <?php for($i = 0; $i<=10; $i++):?>
                        <option
                                <?php if($rubric->getAssesments() == $i*10):?>selected<?php endif?>
                                value="<?=$i*10?>"><?=$i*10?></option>
                        <?php endfor?>
                    </select>
                </div>

                <div class="form_item col-md-2">
                </div>
                <div class="form_item col-md-4">
                    <span class="form_label">Moderator</span>
                    <select class="form_input" name="moderator">
                        <?php foreach($staff as $s): ?>
                            <option
                                <?php if($s->getId() == $rubric->getModerator()->getId()):?>selected<?php endif?>
                                value="<?=$s->getId()?>"><?=$s->getName()?></option>
                        <?php endforeach?>
                    </select>
                </div>

            </div>

            <div class="row col-md-12">
                <div class="form_item col-md-10">
                    <span class="form_label">Rubrics of the Semester Exam</span>
                    <input  class="form_input" type="text" placeholder="Code" name="examRubrics" value="<?=$rubric->getRubric()?>"/>
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

<script src="<?=base_url('/assets/js/validation/edit_rubrics_validation.js')?>"></script>

<style>
    label.error{
        color:red;
        font-size:12px;
        margin:0px;
        margin-left:5px;
    }
</style>