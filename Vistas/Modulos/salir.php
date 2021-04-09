<?php 

    session_destroy();
    $urlVendedor = Ruta::ctrRuta();

    echo 
    '<script>

        window.location = "'.$urlVendedor.'";

    </script>';