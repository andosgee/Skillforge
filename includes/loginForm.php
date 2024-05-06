<?php 

?>
<div class="login">
    <div class="login__wrapper">
<form action="POST" class="form">
    <fieldset class="form__fieldset">
        <legend class="form__legend">User Login</legend>
        <label for="email" class="form__label">Email: </label>
        <input type="email" id="email" class="form__emailInput" name="email" required>
        <br>
        <label for="password" class="form__label">Password: </label>
        <input type="password" id="password" class="form__textInput" required>
        <br>
        <input name="form__submitInput" type="submit" value="Login" class="form__submitInput">
    </fieldset>
</form>
</div>
</div>