<?php if($_POST['consutla']=="fechames"){
    $ini=$_POST['fmes']."-01";
    

    $numMes = date("m", strtotime($_POST['fmes'])); 
    if($numMes=="01"|| $numMes=="03"|| $numMes=="05" || $numMes=="07" || $numMes=="08"|| $numMes=="10"|| $numMes=="12"){
        $fin=$_POST['fmes']."-31";
    }
    if($numMes=="02"){
        $fin=$_POST['fmes']."-28";
    }
    if($numMes=="04"|| $numMes=="06" || $numMes=="09" || $numMes=="11" ){
        $fin=$_POST['fmes']."-30";
    }
    
    
    
  }
  ?>