<?php

// Data has been sent and should be processed
if(isset($_POST['username'])){
    $username = $_POST['username'];

    // TODO "write $username into the Database";
    echo "Hello $username! You have been registered at blah!";
}
else{
    // Data has NOT been sent - show the form
$form = <<<formdefinition
<form action="registerUser.php" method="POST">
    <input type="text" name="username" />    
    <input type="submit" value="Registrieren" />
</form>
formdefinition;

echo $form;


}

