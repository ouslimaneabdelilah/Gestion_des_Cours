<?php
function alert_success($message){
    echo "<div class='bg-green-100 border mb-2 border-green-400 text-green-700 px-4 py-3 rounded relative' role='alert'>
            <strong class='font-bold'>Succès !</strong>
            <span class='block sm:inline'> " . htmlspecialchars($message) . "</span>
        </div>";
}
?>