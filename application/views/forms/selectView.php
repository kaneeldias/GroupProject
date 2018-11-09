<div class="row">
    <div class="col-md-6 mx-auto form_container">

        <div class="form_title">Select View Type</div>


        <form class="column form_content" method="POST" action="<?=base_url("generate-time-table-view")?>">



            <div class="row col-md-12">

                <div class="form_item col-md-4">
                    <span class="form_label">View Type</span>
                    <select class="form_input" name="viewType">
                        <option value="" disabled>Type</option>
                        <option value="1"> Student</option>
                        <option value="2"  > Lecturer</option>
                        <option value="3"  > Lecture Hall</option>
                    </select>
                </div>

            </div>

            <div class="form_item col-md-3">
                <button type="submit">Submit</button>
            </div>

        </form>
    </div>
</div>
