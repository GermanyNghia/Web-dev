<?php
function check_mail($email)
{

  if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$/", $email)) {
    return true;
  } else {
    return false;
  }
}


?>