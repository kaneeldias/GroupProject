<div class="row">
    <div class="col-md-10 mx-auto form_container">

        <div class="form_title">
            <div>Make Booking</div>
            <div style="font-size:18px;"><?=$venue->getName();?></div>
        </div>

        <form class="column form_content" method="POST" action="<?=base_url("booking/process")?>">

            <input id="venue" type="hidden" name="venue" value="<?=$venue->getId()?>"/>
            <input id="week" type="hidden" name="week" value="<?=$week?>"/>
            <input id="date_input" type="hidden" name="date"/>
            <input id="start_time_input" type="hidden" name="start_time"/>
            <input id ="end_time_input" type="hidden" name="end_time"/>

            <div class="row">
                <div class="form_item col-md-6">
                    <span class="form_label">Request By<span>
                    <input type="text" class="form_input" name="request"/>
                </div>

                <div class="form_item col-md-6">
                    <span class="form_label">Approved By<span>
                    <select class="form_input" id="approved" name="approved">
                        <?php foreach($lecturers as $lecturer):?>
                            <option value="<?=$lecturer->getId()?>"><?=$lecturer->getName()?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div class="col-md-12 column form_item">
                <span class="form_label">Reason<span>
                    <input type="text" class="form_input" name="reason"/>
            </div>

            <div class="form_item col-md-3">
                <button type="submit">Submit</button>
            </div>

        </form>
    </div>
</div>
