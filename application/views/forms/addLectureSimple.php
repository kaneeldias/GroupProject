<div class="row">
    <div class="col-md-10 mx-auto form_container">

        <div class="form_title">
            <div>Add Lecture</div>
            <div style="font-size:18px;"><?=$group->getName()." Semester ".$semester?></div>
        </div>


        <form class="column form_content" method="POST" action="<?=base_url("lecture/process")?>">

            <input type="hidden" name="original_group" value="<?=$group->getGroupId()?>"/>
            <input type="hidden" name="semester" value="<?=$semester?>"/>
            <input id="day_input" type="hidden" name="day"/>
            <input id="start_time_input" type="hidden" name="start_time"/>
            <input id ="end_time_input" type="hidden" name="end_time"/>

            <div class="row col-md-12">
                <div class="form_item col-md-6">
                    <span class="form_label">Subject</span>
                    <select class="form_input" name="subject">
                        <option value="" disabled selected>Subject</option>
                        <?php foreach($subjects as $subject): ?>
                            <option value="<?=$subject->getID()?>"><?= $subject->getName()?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="form_item col-md-6">
                    <span class="form_label">Type</span>
                    <select class="form_input" id="type" name="type">
                        <option value="" disabled selected>Type</option>
                        <option value="lecture">Lecture</option>
                        <option value="lab">Lab Practical</option>
                        <option value="tute">Tutorial</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>

            <!--<div class="row col-md-12">

                <div class="form_item col-md-4">
                    <span class="form_label" style="margin-bottom:0px;">Student Group</span>
                    <select class="form_input">
                        <option value="" disabled selected>Student Group</option>
                        <option value="lecture_hall">CS Year 1 Group 1</option>
                        <option value="lecture_hall">CS Year 1 Group 2</option>
                    </select>
                </div>

                <div class="form_item col-md-4">
                    <span class="form_label">Venue<span>
                    <select class="form_input">
                        <option value="" disabled selected>Venue</option>
                        <option value="lecture_hall">W002</option>
                        <option value="lecture_hall">S104</option>
                    </select>
                </div>
            </div>-->

            <link href="<?=base_url("assets/libraries/multiple-select/multiple-select.css")?>" rel="stylesheet">

                <div class="form_item col-md-12">
                    <span class="form_label">Venue(s)<span>
                    <select multiple id="venues" name="venues[]">
                        <?php foreach($venues as $venue):?>
                            <option value="<?=$venue->getId()?>"><?=$venue->getName()?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <style>
                    .ms-choice{
                        background-color:white !important;
                        font-size:16px !important;
                        color:black !important;
                        padding:10px !important;
                        height:40px;
                        line-height:40px;
                    }

                    .ms-choice span{
                        font-size:16px !important;
                    }
                </style>

                <div class="form_item col-md-12">
                    <span class="form_label">Staff<span>
                    <select multiple id="staff" name="staff[]">
                        <?php foreach($staff as $s):?>
                            <option value="<?=$s->getId()?>"><?=$s->getName()?></option>
                        <?php endforeach ?>
                    </select>
                </div>

            <div class="form_item col-md-12">
                    <span class="form_label">Student Group<span>
                    <select class="form_input" name="group">
                        <option selected value="<?=$group->getGroupId()?>"><?=$group->getName()?></option>
                        <?php foreach($groups as $g):?>
                            <option value="<?=$g->getGroupId()?>"><?=$g->getName()?></option>
                        <?php endforeach ?>
                    </select>
            </div>

            <div class="form_item col-md-3">
                <button type="submit">Submit</button>
            </div>

        </form>
    </div>
</div>

<script src="<?=base_url("assets/libraries/multiple-select/multiple-select.js")?>" type="text/javascript"></script>

<script>
    $(function() {
        $('#staff').change(function() {
            console.log($(this).val());
        }).multipleSelect({
            width: '100%',
            selectAll:false
        });

        $('#venues').change(function() {
            console.log($(this).val());
        }).multipleSelect({
            width: '100%',
            selectAll:false
        });

        $('body').find('.ms-choice').addClass('form_input');


    });
</script>