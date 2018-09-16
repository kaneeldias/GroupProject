<div class="row">
    <div class="col-md-8 mx-auto form_container">

        <div class="form_title">Add Lecturer</div>

        <form class="column form_content" method="POST" action="<?=base_url("add-lecturer/process")?>">

            <div class="row col-md-12">
                <div class="form_item col-md-3">
                    <span class="form_label">Lecturer ID</span>
                    <input class="form_input" type="text" placeholder="ID" name="id"/>
                </div>

                <div class="form_item col-md-6">
                    <span class="form_label">Name</span>
                    <input  class="form_input" type="text" placeholder="Name" name="name"/>
                </div>

                <div class="form_item col-md-3">
                    <span class="form_label">Shortform</span>
                    <input class="form_input" type="text" placeholder="Shortform" name="shortform"/>
                </div>

            </div>


            <div class="form_item col-md-3">
                <button type="submit">Submit</button>
            </div>

        </form>
    </div>
</div>
