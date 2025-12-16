<?php 
spl_autoload_register(fn($class)=>(
    require './app/Controllers'.$class.'.php'
));

?>