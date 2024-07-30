
<?php
$toasts = [];

function successMsg($msg){ 
    array_push($toasts, 
    "<div class=\"toast-container position-fixed bottom-30 end-0 p-3\">
        <div id=\"filterMsg\" class=\"toast align-items-center bg-success\" role=\"toast\" aria-live=\"assertive\" aria-atomic=\"true\">
            <div class=\"d-flex text-light\">
                <div class=\"toast-body\">
                    <div class=\"container\">
                        <div class=\"row\">
                            <div class=\"col-lg-auto\">
                            <span class=\"material-symbols-outlined fs-5\">
                                check_circle
                            </span>
                            </div>
                            <div class=\"col-lg-auto\">
                                $msg
                            </div>
                        </div>
                    </div>
                </div>
                <button type=\"button\" class=\"btn-close me-2 m-auto\" data-bs-dismiss=\"toast\" aria-label=\"Close\"></button>
            </div>
        </div>
    </div>"
    );   
} 

foreach ($toasts as $toast) {
    echo $toast;
}

unset($toast);

?>