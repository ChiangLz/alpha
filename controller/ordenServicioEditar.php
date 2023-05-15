<?php
    require('../content/fpdf/fpdf.php');
   include ("../model/liga_BD.php");
    if(!isset($_SESSION["usuario"])){
        session_start();
      }
      $nomUsuActivo = $_SESSION["ids"];
      $nomCol = $_SESSION["idc"];
        $idc1=$_GET['idc'];
        $idu=$_GET['idu'];
        $fi=$_GET['fi'];
  
        $sql="SELECT * FROM cliente WHERE id=".$idc1;
        $result4=mysqli_query($link,$sql);
        while ($row4 = mysqli_fetch_array($result4)) {
           $nomcliente=$row4['nomcli'];
            $contacto=$row4['contacto'];
            $idc=$row4['id'];
        }
   
  
       $sql="SELECT * FROM orden_servicio WHERE idcli=$idc AND iduni= $idu AND fecha_inicial='$fi' AND idsucur= $nomUsuActivo ";
        $result=mysqli_query($link,$sql);
        while ($row = mysqli_fetch_array($result)) {
           $direco=$row['dirrecoleccion'];
            $direntre=$row['direntrega'];
            $hrrec=$row['hrecoleccion'];
            $hrci=$row['hrcita'];
            $cdes=$row['ciudaddestino'];
            $fini=$row['fecha_inicial'];
            $hrini=$row['hora_inicial'];
            $ffin=$row['fecha_final'];
            $hrfin=$row['hora_final'];
            $kmtraje=$row['kilometraje'];
            $folio=$row['folio'];
        }
        $sql="SELECT * FROM sucursal WHERE id=".$nomUsuActivo;
        $result1=mysqli_query($link,$sql);
        while ($row1 = mysqli_fetch_array($result1)) {
           $nomsuc=$row1['nomsuc'];
            $direccion=$row1['dirsuc'];
            $telefono=$row1['telsuc'];
            $cp=$row1['cp'];
            $estado=$row1['estado'];
        }

        
        $sql="SELECT * FROM unidades WHERE noserie=".$idu;
        $result2=mysqli_query($link,$sql);
       
        while ($row2 = mysqli_fetch_array($result2)) {
            $nomuni=$row2['nomuni'];
            $serie=$row2['serie'];
            $fecha_alta=$row2['fecha_alta'];
            $marca=$row2['marca'];
            $modelo=$row2['modelo'];
            $placas=$row2['placas'];
            $caja=$row2['caja'];
            $refrigeracion=$row2['refrigeracion'];
            $capacidadmac=$row2['capasidad_max'];
            $costo=$row2['costo_adquisicion'];
            $descripcion=$row2['descripuni'];
            $foto=$row2['foto'];
            $tipo=$row2['tipo'];
            $idsuc=$row2['idsuc'];
        }

            $nombrePdfPadre = "OrdenServicio-".$nomcliente.".pdf";

            $pdf = new FPDF();
            header("Content-Type: text/html; charset=iso-8859-1 ");
            $pdf->AddPage('P','A4');
 
                
            $pdf->SetFont('Arial','B',16);
            $pdf->SetTextColor(194, 18, 18);
            $pdf->SetFillColor(255,255,255); 
            $pdf->Cell(50,10,'ALFA Logistic Mx',0,'C',true);
            $pdf->SetTextColor(0,0,0); 
            $pdf->Image('../content/imagenes/fotoarchi.png',20,20,30);
            

            $pdf->SetFont('Arial','B',14);
            $pdf->SetTextColor(44, 34, 34 );
            $pdf->SetFillColor(255,255,255); 
           // $pdf->Cell(90,10, utf8_decode($nomsuc),0,'C',true);
           $pdf->setY(10);$pdf->setX(89);
          //  $pdf->Cell(45,10, utf8_decode($nomsuc),0,'C',true);
            $pdf->Cell(5,5,utf8_decode($nomsuc));
            $pdf->setY(17);$pdf->setX(89);
            $pdf->Cell(5,5,utf8_decode($direccion));

            
            $pdf->setY(22);$pdf->setX(89);
            $pdf->Cell(5,5,utf8_decode($estado));
        
            $pdf->setY(27);$pdf->setX(89);
            $pdf->Cell(5,5,"CP:".$cp);

        
            $pdf->setY(32);$pdf->setX(89);
            $pdf->Cell(5,5,"TELS:".$telefono);

            $pdf->SetDrawColor(193, 47, 47);
            $pdf->rect(10,45,193,110);
            $pdf->rect(10,165,193,110);
            $pdf->rect(40,48,50,8);
            $pdf->rect(165,48,35,8);


            $pdf->SetTextColor(193, 47, 47);
            $pdf->SetFont('Arial','B',14);
            $pdf->setY(50);$pdf->setX(15);
            $pdf->Cell(5,5,"Fecha:",0, true);
            $pdf->setY(50);$pdf->setX(40);
            $pdf->Cell(5,5, date("d")." de ".date("m")." del ".date("Y"),0, true);

            $pdf->setY(50);$pdf->setX(150);
            $pdf->Cell(5,5,"Folio:",0, true);
            $pdf->setY(50);$pdf->setX(165);
            $pdf->Cell(5,5,utf8_decode($folio));
        

            $pdf->setY(58);$pdf->setX(15);
            $pdf->Cell(5,5,"Cliente:",0, true);
            $pdf->setY(58);$pdf->setX(40);
            $pdf->Cell(5,5,$nomcliente,0, true);
    
          $pdf->SetTextColor(62, 51, 51);
            $pdf->SetFont('Arial','B',12);
            $pdf->setY(72);$pdf->setX(15);
            $pdf->Cell(5,5,utf8_decode("Dirección de recolección:"),0, true);
            $pdf->setY(78);$pdf->setX(15);
            $pdf->Cell(5,5,utf8_decode("Dirección de entrega:"),0, true);
            $pdf->setY(84);$pdf->setX(15);
            $pdf->Cell(5,5,"Nombre contacto:",0, true);
            $pdf->setY(90);$pdf->setX(15);
            $pdf->Cell(5,5,utf8_decode("Hora de recolección:"),0, true);
            $pdf->setY(96);$pdf->setX(15);
            $pdf->Cell(5,5,"Hora de la cita:",0, true);
            $pdf->setY(108);$pdf->setX(15);
            $pdf->Cell(5,5,"Ciudad destino:",0, true);
            $pdf->setY(114);$pdf->setX(15);
            $pdf->Cell(5,5,"Tipo unidad:",0, true);
            $pdf->setY(120);$pdf->setX(15);
            $pdf->Cell(5,5,"Temperatura del producto:",0, true);
            $pdf->setY(126);$pdf->setX(15);
            $pdf->Cell(5,5,"Hora inicio del servicio:",0, true);
            $pdf->setY(136);$pdf->setX(15);
            $pdf->Cell(5,5,"Hora final del servicio:",0, true);
            $pdf->setY(142);$pdf->setX(15);
            $pdf->Cell(5,5,"Kilometraje inical del servicio:",0, true);
            $pdf->setY(142);$pdf->setX(80);
            $pdf->Cell(5,5,utf8_decode($kmtraje));
            $pdf->setY(148);$pdf->setX(15);
            $pdf->Cell(5,5,"Kilometraje final del servicio:",0, true);
        
           $pdf->setY(170);$pdf->setX(15);
            $pdf->Cell(5,5,"Casetas:",0, true);

            $pdf->setY(170);$pdf->setX(130);
            $pdf->Cell(5,5,"Cantidad Entregada",0, true);

            $pdf->setY(176);$pdf->setX(15);
            $pdf->Cell(5,5,"Transito:",0, true);
            $pdf->setY(182);$pdf->setX(15);
            $pdf->Cell(5,5,"Maniobras:",0, true);
            $pdf->setY(188);$pdf->setX(15);
            $pdf->Cell(5,5,"Comidas:",0, true);
            $pdf->setY(194);$pdf->setX(15);
            $pdf->Cell(5,5,"Hotel:",0, true);
            $pdf->setY(200);$pdf->setX(15);
            $pdf->Cell(5,5,"Gasolina:",0, true);
            $pdf->setY(206);$pdf->setX(15);
            $pdf->Cell(5,5,"Gasolina:",0, true);
            $pdf->setY(212);$pdf->setX(15);
            $pdf->Cell(5,5,"Gasolina:",0, true);
            $pdf->setY(218);$pdf->setX(15);
            $pdf->Cell(5,5,"Gasolina:",0, true);
            $pdf->setY(224);$pdf->setX(15);
            $pdf->Cell(5,5,"Otros:",0, true);
            $pdf->setY(230);$pdf->setX(15);
            $pdf->Cell(5,5,"Otros:",0, true);
            $pdf->setY(236);$pdf->setX(15);
            $pdf->Cell(5,5,"Otros:",0, true);
            $pdf->setY(242);$pdf->setX(15);
            $pdf->Cell(5,5,"Observaciones:",0, true);

            $pdf->setY(200);$pdf->setX(100);
            $pdf->Cell(5,5,"km:",0, true);
            $pdf->setY(206);$pdf->setX(100);
            $pdf->Cell(5,5,"km:",0, true);
            $pdf->setY(212);$pdf->setX(100);
            $pdf->Cell(5,5,"km:",0, true);
            $pdf->setY(218);$pdf->setX(100);
            $pdf->Cell(5,5,"km:",0, true);


            $pdf->SetFont('Arial','',9);
            $pdf->setY(260);$pdf->setX(15);
            $pdf->Cell(5,5,"EL GASTO DE LAS COMIDAD NO DEBE PASAR DE $120.00 POR CADA 8 HORAS, SOLO APLICA EN FORANEOS",0, true);
            $pdf->setY(266);$pdf->setX(15);
            $pdf->Cell(5,5,"MAS DE 300 KM IDA Y VUELTA, FAVOR DE LLENAR TODOS ESTOS DATOS, SIN EXCEPCION.",0, true);


          $pdf->SetFont('Arial','',12);
            $pdf->setY(72);$pdf->setX(68);
            $pdf->Cell(5,5,utf8_decode($direco),0, true);
            $pdf->setY(78);$pdf->setX(60);
            $pdf->Cell(5,5,utf8_decode($direntre),0, true);
            $pdf->setY(84);$pdf->setX(53);
            $pdf->Cell(5,5,utf8_decode($contacto),0, true);
            $pdf->setY(90);$pdf->setX(59);
            $pdf->Cell(5,5,$hrrec,0, true);
            $pdf->setY(96);$pdf->setX(48);
            $pdf->Cell(5,5,$hrci,0, true);
            $pdf->setY(108);$pdf->setX(49);
            $pdf->Cell(5,5,utf8_decode($cdes),0, true);

            $pdf->setY(114);$pdf->setX(110);
            $pdf->Cell(5,5,"Nissan",0, true);
            $pdf->setY(114);$pdf->setX(160);
            $pdf->Cell(5,5,"Camion",0, true);
            $pdf->setY(120);$pdf->setX(110);
            $pdf->Cell(5,5,"Refrigerado",0, true);
            $pdf->setY(120);$pdf->setX(160);
            $pdf->Cell(5,5,"Seco",0, true);
           
            
            $pdf->setY(136);$pdf->setX(63);
            $pdf->Cell(5,5,"",0, true);
            $pdf->setY(126);$pdf->setX(65);
            $pdf->Cell(5,5,"",0, true);
            $pdf->setY(136);$pdf->setX(100);
            $pdf->Cell(5,5,"Total de horas extras del servicio:",0, true);
            $pdf->setY(142);$pdf->setX(78);
            $pdf->Cell(5,5,"",0, true);
            $pdf->setY(148);$pdf->setX(100);
            $pdf->Cell(5,5,"Total de km recorridos:",0, true);

            


            $pdf->SetDrawColor(193, 47, 47);
     
         $pdf->rect(136,114,15,5);
            $pdf->rect(181,114,15,5);
            $pdf->rect(136,120,15,5);
            $pdf->rect(181,120,15,5);
            $pdf->rect(167,136,30,5);
            $pdf->rect(167,148,30,5);

            $pdf->rect(75,148,25,5);
            $pdf->rect(77,142,30,5);
            $pdf->rect(62,136,35,5);
            $pdf->rect(64,126,35,5);
         
            $pdf->rect(50,170,35,5);
            $pdf->rect(50,176,35,5);
            $pdf->rect(50,182,35,5);
            $pdf->rect(50,188,35,5);
            $pdf->rect(50,194,35,5);
            $pdf->rect(50,200,35,5);
            $pdf->rect(50,206,35,5);
            $pdf->rect(50,212,35,5);
            $pdf->rect(50,218,35,5);
            $pdf->rect(50,224,35,5);
            $pdf->rect(50,230,35,5);
            $pdf->rect(50,236,35,5);

           
           $pdf->rect(110,200,35,5);
            $pdf->rect(110,206,35,5);
            $pdf->rect(110,212,35,5);
            $pdf->rect(110,218,35,5);
          
          $pdf->SetFont('Arial','B',12);
            $pdf->setY(156);$pdf->setX(80);
            $pdf->Cell(5,5,"Gastos del Servicios",0, true);

            $extension=".pdf";
            $pdf->output($folio.$extension,'I');
            $pdf->Output();
  
?>