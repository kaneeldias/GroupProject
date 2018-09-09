<div class="row">
    <div class="col-md-4 col-md-offset-4 form_container">

        <div class="form_title">Log In</div>


        <form class="form_content">

            <div class="form_item">
                <span class="form_label">Email</span>
                <input  class="form_input" type="email" placeholder="Email"/>
            </div>

            <div class="form_item">
                <span class="form_label">Password</span>
                <input  class="form_input" type="password" placeholder="Password"/>
            </div>

            <div class="form_item">
                <button type="submit">Submit</button>
            </div>

        </form>
    </div>
</div>

<script src="<?=base_url("assets/libraries/lou-multi-select/js/jquery.multi-select.js")?>" type="text/javascript"></script>

<script>
    $('#my-select').multiSelect();
</script>