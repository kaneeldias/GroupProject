<div class="row">
    <div class="col-md-4 mx-auto form_container">

        <div class="form_title">Log In</div>


        <form class="column form_content" method="POST" action="<?=base_url("login")?>">

            <div class="form_item col-md-12">
                <span class="form_label">Email</span>
                <input  class="form_input" type="email" placeholder="Email" name="email"/>
            </div>

            <div class="form_item col-md-12">
                <span class="form_label">Password</span>
                <input  class="form_input" type="password" placeholder="Password" name="password"/>
            </div>

            <div class="form_item col-md-3">
                <button type="submit">Submit</button>
            </div>

        </form>
    </div>
</div>

<script src="<?=base_url("assets/libraries/lou-multi-select/js/jquery.multi-select.js")?>" type="text/javascript"></script>

<script>
    $('#my-select').multiSelect();
</script>