<?php
function clean_input($data){
return htmlspecialchars(stripslashes(trim($data)));
}