<div id="login_modal" class="modal">

    <form class="modal-content animate" action="<?=base_url("login")?>" method="POST">
        <div class="imgcontainer">
            <span onclick="document.getElementById('login_modal').style.display='none'" class="close" title="Close Modal">&times;</span>
            <img src="login.png" alt="Avatar" class="avatar">
        </div>

        <div class="container">
            <label for="uname"><b>Email</b></label>
            <input type="text" placeholder="Enter Username" name="email" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <button type="submit">Login</button>

        </div>
    </form>
</div>

