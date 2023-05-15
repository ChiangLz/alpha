<?php
session_start();/*inicio de sesion*/
if(isset($_SESSION['login']) && $_SESSION['login']== true){
/*si la sesion es correcta la pagina sigue sin problema*/
}
else{
    header("Location: ../../");/*si no inicia sesion se re-dirige al index*/
}
$now = time();/*variable por tiempo*/

if($now > $_SESSION['expire']){
    echo '
        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  
        <script type="text/javascript" >
            var result=confirm("Su sesión ha expirado, ¿Quieres más tiempo?");
            if(result){
                $.ajax({
                    type:"POST",
                    url:"../model/asigna_mas_tiempo_sesion.php",
                    data: "more_time=0"
                });     
            }else{
                $.ajax({
                    type:"POST",
                    url:"../model/asigna_mas_tiempo_sesion.php",
                    data: "session_destroy=0"
                });
                window.location.href="../../";
            }
        </script>
        ';
}
?>