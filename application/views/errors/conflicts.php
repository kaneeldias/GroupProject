<div class="error">
    <div class="error_header">
        Error Inserting Lecture to Time Table
    </div>
    <div class="error_content column">
        <div class="details row text-center">
            <div class="d_item column col-md-2">
                <div class="d_item_label">Student Group</div>
                <div class="d_item_value"><?=$group->getName()?></div>
            </div>
            <div class="d_item column col-md-2">
                <div class="d_item_label">Semester</div>
                <div class="d_item_value"><?=$semester?></div>
            </div>
            <div class="d_item column col-md-2">
                <div class="d_item_label">Subject</div>
                <div class="d_item_value"><?=$subject->getName()?></div>
            </div>
            <div class="d_item column col-md-1">
                <div class="d_item_label">Start Time</div>
                <div class="d_item_value"><?=$start_time?>:00</div>
            </div>
            <div class="d_item column col-md-1">
                <div class="d_item_label">End Time</div>
                <div class="d_item_value"><?=$end_time?>:00</div>
            </div>
            <div class="d_item column col-md-2">
                <div class="d_item_label">Venue(s)</div>
                <?php foreach($venues as $venue): ?>
                    <div class="d_item_value"><?=$venue->getName()?></div>
                <?php endforeach ?>
            </div>

            <div class="d_item column col-md-2">
                <div class="d_item_label">Staff</div>
                <?php foreach($staff as $s): ?>
                    <div class="d_item_value"><?=$s->getName()?></div>
                <?php endforeach ?>
            </div>
        </div>
        <?php foreach($error_messages as $message):?>
            <div class="error_message"><?=$message?></div>
        <?php endforeach ?>
    </div>

</div>

<style>

    .error_header{
        color:white;
        background-color:#c0392b;
        font-size:25px;
        padding:20px;
        text-align:center;
        font-weight:bold;
        text-transform: uppercase;
    }
    .d_item_label{
        font-weight:bold;
    }

    .d_item{
        font-size:15px;
        display: inline-block;
    }

    .error_message{
        color:#c0392b;
        margin:5px;
        font-size:22px;
    }

    .details{
        margin-bottom:30px;
        float:none;
        text-align:center;
    }

    .error{
        margin:20px;
        border-style:solid;
        border-color:#c0392b;
        border-width:2px;
        border-radius:3px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    }

    .error_content{
        text-align:center;
        margin:20px;
    }
</style>
