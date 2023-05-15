
<?php
include '../model/liga_BD.php';
if(!empty($_POST)){
    if($_POST['accion']=='editarunidad'){
        $sqlArTra='SELECT * FROM unidades WHERE noserie='.$_POST['valor'];
        $query=mysqli_query($link,$sqlArTra);
        mysqli_close($link);
        $result=mysqli_num_rows($query);
        if($result>0){
            $data = mysqli_fetch_assoc($query);
             echo json_encode($data,JSON_UNESCAPED_UNICODE);
             exit;
        }
        echo 'error';
        exit;
     }

}
exit;

?>


    
