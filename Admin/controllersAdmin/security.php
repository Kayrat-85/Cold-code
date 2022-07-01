<?php
//Контроль входа в Административную панель
function isLoggedIn()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['role'] == "Admin") {
		return true;
	}
    else if(isset($_SESSION['user']) && $_SESSION['user']['role'] == "User"){
		return false;
	}
    else{
        return false;
    }
}

?>