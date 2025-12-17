<?php
//function alert
function alert_success($message){
    echo "<div class='bg-green-100 border mb-2 border-green-400 text-green-700 px-4 py-3 rounded relative' role='alert'>
            <strong class='font-bold'>Succès !</strong>
            <span class='block sm:inline'> " . htmlspecialchars($message) . "</span>
        </div>";
}
function alert_error($message){
    echo "<div class='bg-red-100 border mb-2 border-red-400 text-red-700 px-4 py-3 rounded relative' role='alert'>
            <strong class='font-bold'>Succès !</strong>
            <span class='block sm:inline'> " . htmlspecialchars($message) . "</span>
        </div>";
}
?>