<?php
    require('../content/fpdf/fpdf.php');
    include ("../model/liga_BD.php");
    include ("../model/liga_BD.php");
    if(!isset($_SESSION["usuario"])){
        session_start();
      }
      $nomUsuActivo = $_SESSION["ids"];
      $nomCol = $_SESSION["idc"];
        //$idc1=$_GET['idc'];
        $data = explode("-",$_GET['idc']);
        $idu=$_GET['idu'];
        $fi=$_GET['fi'];

        $sql="SELECT * FROM cliente WHERE id=".$data[0];
        $result4=mysqli_query($link,$sql);
        while ($row4 = mysqli_fetch_array($result4)) {
            $nomcliente=$row4['contacto'];
            $razonsocial=$row4['razonsocial'];
            $contacto=$row4['contacto'];
            $rfc=$row4['rfc'];
           
            $tel1=$row4['celular'];
            $correo1=$row4['correocont'];
            $domicilio=$row4['dircli'];
            $represenLegal=$row4['nomcli'];
            $tel2=$row4['telcli'];
            $correo2=$row4['correocli'];
            $domicilio2=$row4['dirsocial'];
            $idc=$row4['id'];
            
        }

        
       $sql="SELECT * FROM orden_servicio WHERE idcli=$idc AND iduni= $idu AND fecha_inicial='$fi' AND idsucur= $nomUsuActivo  AND idcol= $nomCol";
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
           $monto_deposito=$row['monto_deposito'];
           $valor_pagare=$row['valor_pagare'];
           $cantidad=$row['costo'];
           $folio=$row['folio'];
       }

       $sql="SELECT * FROM representante WHERE idsuc=".$nomUsuActivo;
       $result=mysqli_query($link,$sql);
       while ($rowr = mysqli_fetch_array($result)) {
        $nomCol1=$rowr['nomrepre'];
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
       $tofirm = str_split($nomsuc, 26);
       $sql="SELECT * FROM colaboradores INNER JOIN sucursal_colaborador on sucursal_colaborador.idcol=colaboradores.id INNER JOIN sucursal ON sucursal_colaborador.idsuc=sucursal.id WHERE colaboradores.idrol=2 and  sucursal.id=".$nomUsuActivo;
       $result5=mysqli_query($link,$sql);
       while ($row1 = mysqli_fetch_array($result5)) {
          $nomCol=$row1['nomcol'];
          
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
       $fecha = explode("-", $fini);
   // $nomcliente="ana";
    $nombrePdfPadre = "OrdenServicio-".$nomcliente.".pdf";

    $pdf = new FPDF();
    header("Content-Type: text/html; charset=iso-8859-1 ");
    $pdf->AddPage('P','A4');
     
    $pdf->SetFont('Arial','',10);
    $pdf->SetTextColor(44, 34, 34 );
    $pdf->SetFillColor(255,255,255); 

    $pdf->SetFont('Arial','B',10);
    $pdf->setY(20);$pdf->setX(150);
    $pdf->Cell(5,5,"Folio:",0, true);
    $pdf->setY(20);$pdf->setX(160);
    $pdf->Cell(5,5,utf8_decode($folio));

    $pdf->setY(30);$pdf->setX(18);
    $pdf->Multicell(0,5,utf8_decode("CARÁTULA DEL CONTRATO DE ARRENDAMIENTO DE VEHÍCULO QUE CELEBRAN POR UNA PARTE, ".strtoupper($nomsuc).", REPRESENTADA POR EL SEÑOR ".strtoupper($nomCol1).", COMO ARRENDADOR, Y POR LA OTRA PARTE ".strtoupper($nomcliente).", COMO ARRENDATARIO."));
    
    $pdf->SetFont('Arial','B',10);
    $pdf->setY(48);$pdf->setX(18);
    $pdf->Cell(5,5,utf8_decode("I.- ARRENDADOR.- "));
    $pdf->setY(60);$pdf->setX(18);
    $pdf->Cell(5,5,utf8_decode("II.- ARRENDATARIO.- "));
    $pdf->setY(105);$pdf->setX(18);
    $pdf->Cell(5,5,utf8_decode("III.- CARACTERÍSTICAS DEL VEHÍCULO:"));
    $pdf->setY(144);$pdf->setX(18);
    $pdf->Cell(5,5,utf8_decode("IV.-VIGENCIA DEL ARRENDAMIENTO"));

    $pdf->setY(175);$pdf->setX(18);
    $pdf->Cell(5,5,utf8_decode("V.- RENTA DIARIA: ___________________ TOTAL RENTA: _____________________"));
    $pdf->setY(175);$pdf->setX(123);
    $pdf->Cell(5,5,"$ ".$cantidad);

    $pdf->setY(188);$pdf->setX(18);
    $pdf->Cell(5,5,utf8_decode("VI.- MONTO DEL DEPOSITO: _______________"));

    $pdf->setY(188);$pdf->setX(70);
    $pdf->Cell(5,5,"$ ".$monto_deposito);
    $pdf->setY(200);$pdf->setX(18);
    $pdf->Cell(5,5,utf8_decode("TELEFONO SERVICIO A CLIENTES : ". $telefono ."  / WHATSAPP: ".$telefono));
    $pdf->setY(205);$pdf->setX(18);
    $pdf->Cell(5,5,utf8_decode("Email: "));

    $pdf->SetTextColor(133, 193, 233 );
    $pdf->SetFont('Arial','',10);
    $pdf->setY(205);$pdf->setX(30);
    $pdf->Cell(5,5,utf8_decode("clientes@alfalogisticmx.com"));

    $pdf->SetTextColor(44, 34, 34 );
    $pdf->SetFont('Arial','',10);
    
    $pdf->setY(49);$pdf->setX(23);
    $pdf->Multicell(182,4,"                              ".utf8_decode(strtoupper($nomsuc)." con domicilio en calle ".$direccion ." C.P. ".$cp.", ".$estado."."));
 
    $pdf->setY(65);$pdf->setX(18);
    $pdf->Cell(5,5,utf8_decode("Nombre:"));  
    $pdf->setY(65);$pdf->setX(34);
    $pdf->Cell(5,5,utf8_decode($nomcliente));

    $pdf->setY(70);$pdf->setX(18);
    $pdf->Cell(5,5,utf8_decode("Razón Social:"));
    $pdf->setY(70);$pdf->setX(42);
    $pdf->Cell(5,5,utf8_decode($razonsocial));

    $pdf->setY(75);$pdf->setX(18);
    $pdf->Cell(5,5,utf8_decode("Domicilio:"));
    $pdf->setY(75);$pdf->setX(35);
    $pdf->Cell(5,5,utf8_decode($domicilio));


    $pdf->setY(80);$pdf->setX(18);
    $pdf->Cell(5,5,utf8_decode("RFC:"));
    $pdf->setY(80);$pdf->setX(30);
    $pdf->Cell(5,5,utf8_decode($rfc));
    $pdf->setY(80);$pdf->setX(75);
    $pdf->Cell(5,5,utf8_decode("Teléfono:"));
    $pdf->setY(80);$pdf->setX(91);
    $pdf->Cell(5,5,utf8_decode($tel1));
    $pdf->setY(80);$pdf->setX(125);
    $pdf->Cell(5,5,utf8_decode("Correo:"));
    $pdf->setY(80);$pdf->setX(139);
    $pdf->Cell(5,5,utf8_decode($correo1));
    $pdf->setY(85);$pdf->setX(18);
    $pdf->Cell(5,5,utf8_decode("Representante Legal:"));
    $pdf->setY(85);$pdf->setX(58);
    $pdf->Cell(5,5,utf8_decode($represenLegal));
    $pdf->setY(91);$pdf->setX(18);
    $pdf->Cell(5,5,utf8_decode("Contacto:"));
    $pdf->setY(91);$pdf->setX(35);
    $pdf->Cell(5,5,utf8_decode($contacto));
    $pdf->setY(97);$pdf->setX(18); #75
    $pdf->Cell(5,5,utf8_decode("Teléfono:"));
    $pdf->setY(97);$pdf->setX(35); #91
    $pdf->Cell(5,5,utf8_decode($tel2));
    $pdf->setY(97);$pdf->setX(75); #125
    $pdf->Cell(5,5,utf8_decode("Correo:"));
    $pdf->setY(97);$pdf->setX(91); #139
    $pdf->Cell(5,5,utf8_decode($correo2));
    
    $pdf->SetDrawColor(44, 34, 34 );
     
    $pdf->rect(18,110,88,6);
    $pdf->rect(106,110,87,6);
    $pdf->rect(18,116,88,6);
    $pdf->rect(106,116,87,6);
    $pdf->rect(18,122,88,6);
    $pdf->rect(106,122,87,6);
    $pdf->rect(18,128,88,6);
    $pdf->rect(106,128,87,6);

    $pdf->rect(18,152,88,6);
    $pdf->rect(106,152,87,6);
    $pdf->rect(18,158,88,6);
    $pdf->rect(106,158,87,6);

    

  $pdf->setY(111);$pdf->setX(18);
    $pdf->Cell(5,5,utf8_decode("TIPO"));
    $pdf->setY(111);$pdf->setX(28);
    $pdf->Cell(5,5,utf8_decode(strtoupper($tipo)));
     
    $pdf->setY(117);$pdf->setX(18);
    $pdf->Cell(5,5,utf8_decode("MODELO"));
    $pdf->setY(117);$pdf->setX(35);
    $pdf->Cell(5,5,utf8_decode( $modelo));

    $pdf->setY(123);$pdf->setX(18);
    $pdf->Cell(5,5,utf8_decode("PLACAS"));
    $pdf->setY(123);$pdf->setX(34);
    $pdf->Cell(5,5,utf8_decode($placas));

    $pdf->setY(129);$pdf->setX(18);
    $pdf->Cell(5,5,utf8_decode("CAJA"));
    $pdf->setY(129);$pdf->setX(28);
    $pdf->Cell(5,5,utf8_decode(strtoupper($caja)));
    

    
    $pdf->setY(111);$pdf->setX(107);
    $pdf->Cell(5,5,utf8_decode("MARCA"));
    $pdf->setY(111);$pdf->setX(122);
    $pdf->Cell(5,5,utf8_decode(strtoupper($marca)));

    $pdf->setY(117);$pdf->setX(107);
    $pdf->Cell(5,5,utf8_decode("SERIE"));
    $pdf->setY(117);$pdf->setX(121);
    $pdf->Cell(5,5,utf8_decode($serie));

    $pdf->setY(123);$pdf->setX(107);
    $pdf->Cell(5,5,utf8_decode("CAPACIDAD DE CARGA"));
    $pdf->setY(123);$pdf->setX(152);
    $pdf->Cell(5,5,utf8_decode($capacidadmac."KG"));

    $pdf->setY(129);$pdf->setX(107);
    $pdf->Cell(5,5,utf8_decode("EQUIPO DE ENFRIAMIENTO"));
    $pdf->setY(129);$pdf->setX(158);
    $pdf->Cell(5,5,utf8_decode(strtoupper($refrigeracion)));


    $pdf->setY(153);$pdf->setX(18);
    $pdf->Cell(5,5,utf8_decode("FECHA INICIAL"));
    $pdf->setY(153);$pdf->setX(45);
    $pdf->Cell(5,5,utf8_decode($fini));
     
    $pdf->setY(159);$pdf->setX(18);
    $pdf->Cell(5,5,utf8_decode("HORA INICIAL"));
    $pdf->setY(159);$pdf->setX(45);
    $pdf->Cell(5,5,utf8_decode($hrini));

    $pdf->setY(153);$pdf->setX(107);
    $pdf->Cell(5,5,utf8_decode("FECHA FINAL"));
    $pdf->setY(153);$pdf->setX(131);
    $pdf->Cell(5,5,utf8_decode($ffin));
     
    $pdf->setY(159);$pdf->setX(107);
    $pdf->Cell(5,5,utf8_decode("HORA FINAL"));
    $pdf->setY(159);$pdf->setX(130);
    $pdf->Cell(5,5,utf8_decode($hrfin));


     //CONTRATO REDUCIDO

$pdf->AddPage('P','A4');
$pdf->SetFont('Arial','B',5);
$pdf->setY(10);$pdf->setX(5);
$pdf->Multicell(95,3,utf8_decode("CARÁTULA DEL CONTRATO DE ARRENDAMIENTO DE VEHÍCULO QUE CELEBRAN POR UNA PARTE, ".strtoupper($nomsuc).", REPRESENTADA POR EL SEÑOR ".strtoupper($nomCol1).", COMO ARRENDADOR, Y POR LA OTRA PARTE ".strtoupper($nomcliente).", COMO ARRENDATARIO, AL TENOR DE LAS SIGUIENTES:"));
$pdf->SetFont('Arial','B',5);
$pdf->SetTextColor(44, 34, 34 );
$pdf->SetFillColor(255,255,255); 


$pdf->setY(19);$pdf->setX(50);
$pdf->Cell(5,5,utf8_decode("DECLARACIONES"));
$pdf->setY(37);$pdf->setX(50);
$pdf->Cell(5,5,utf8_decode("CLÁUSULAS"));
$pdf->setY(39);$pdf->setX(5);
$pdf->Cell(5,5,utf8_decode("PRIMERA.- Definiciones. "));
$pdf->setY(85);$pdf->setX(5);
$pdf->Cell(5,5,utf8_decode("SEGUNDA.- Objeto.  "));
$pdf->setY(95);$pdf->setX(5);
$pdf->Cell(5,5,utf8_decode("TERCERA.- Renta.- "));
$pdf->setY(117);$pdf->setX(5);
$pdf->Cell(5,4,utf8_decode("CUARTA.- Vigencia. "));

$pdf->SetTextColor(44, 34, 34 );
$pdf->SetFont('Arial','',5);


$pdf->setY(25);$pdf->setX(5);
$pdf->Multicell(95,2,utf8_decode("I.- DECLARA EL ARRENDADOR que su representada es una sociedad mercantil constituida bajo las leyes mexicanas y que su representante legal cuenta con las facultades necesarias para celebrar el presente contrato, cuyo domicilio y clave de Registro Federal de Contribuyentes se especifican en nel CARÁTULA de este contrato."));

$pdf->setY(33);$pdf->setX(5);
$pdf->Multicell(95,2,utf8_decode("II.- DECLARA EL ARRENDATARIO que sus datos de identificación, domicilio y clave de Registro Federal de Contribuyentes se especifican en la CARÁTULA de este contrato."));

$pdf->setY(41);$pdf->setX(26);
$pdf->Multicell(75,2,utf8_decode(" El ARRENDADOR y El ARRENDATARIO acuerdan que para los efectos de este contrato se entenderá por:"));

$pdf->setY(47);$pdf->setX(5);
$pdf->Multicell(95,2,utf8_decode("ARRENDADOR.- La persona que otorga en arrendamiento el VEHÍCULO, cuyos datos de identificación se detallan en la CARÁTULA de este contrato."));
$pdf->setY(53);$pdf->setX(5);
$pdf->Multicell(95,2,utf8_decode("ARRENDATARIO.- La persona que recibe el VEHÍCULO en arrendamiento, cuyos datos de identificación se detallan en la CARÁTULA de este contrato."));
$pdf->setY(58);$pdf->setX(5);
$pdf->Multicell(95,2,utf8_decode("CARÁTULA.- El documento que contiene, en otros, los datos de las partes, las características del VEHÍCULO, el precio de la renta, la vigencia del contrato, el cual  que debe ser firmado por ambas partes  y forma parte integrante del presente contrato."));


$pdf->setY(66);$pdf->setX(5);
$pdf->Multicell(95,2,utf8_decode("ANEXO ÚNICO.- El documento denominado “BITÁCORA DE  LA UNIDAD” en el que se detalla el equipamiento y estado físico del VEHÍCULO, el cual debe ser firmado por ambas partes  y forma parte integrante del presente contrato."));


$pdf->setY(74);$pdf->setX(5);
$pdf->Multicell(95,2,utf8_decode("OPERADOR.- El propio ARRENDATARIO o la persona o personas que éste designe para llevar a cabo la operación del VEHÍCULO."));


$pdf->setY(80);$pdf->setX(5);
$pdf->Multicell(95,2,utf8_decode("VEHÍCULO.- El vehículo automotor cuyas características, equipamiento y estado físico se detallan en la CARÁTULA y ANEXO ÚNICO de este contrato."));

$pdf->setY(87);$pdf->setX(5);
$pdf->Multicell(95,2,utf8_decode("                       El ARRENDADOR da en arrendamiento temporal al ARRENDATARIO el VEHÍCULO cuyas características se detallan en la CARÁTULA del presente contrato, para que éste lo utilice únicamente dentro del territorio nacional para el traslado y/o transportación de bienes y/o mercancías de su propiedad, o que se encuentren bajo su depósito o legal posesión."));


$pdf->setY(97);$pdf->setX(5);
$pdf->Multicell(95,2,utf8_decode("                                 El ARRENDATARIO se obliga a pagar por adelantado al ARRENDADOR, por concepto de  renta, la cantidad señalada en la CARÁTULA del presente contrato. En caso de que las partes acuerden que el pago de la renta será en fecha posterior, o bien, que el ARRENDATARIO solicite la prórroga del contrato y el ARRENDADOR lo autorice, los pagos de renta que se generen deberán ser pagados en el domicilio de éste último, a más tardar al momento de llevar a cabo la entrega del vehículo. En caso de que el ARRENDATARIO no realice el pago oportuno de la renta, se obliga a pagar al ARRENDADOR intereses moratorios a razón de una tasa del 10%-diez por ciento mensual sobre el monto adeudado. El ARRENDATARIO manifiesta que los recursos económicos con los que cubrirá el pago de la renta y demás conceptos generados con motivo del presente contrato provienen únicamente de actividades lícitas."));

$pdf->setY(118);$pdf->setX(5);
$pdf->Multicell(95,2,utf8_decode("                                  Las partes acuerdan que el presente contrato tendrá la vigencia que inicia y termina en las fechas que se señalan en la CARÁTULA, pudiendo ser prorrogado por solicitud del ARRENDATARIO o las personas autorizadas por éste, siempre y cuando el ARRENDADOR así lo autorice por escrito."));


$pdf->SetFont('Arial','B',5);
$pdf->setY(125);$pdf->setX(5);
$pdf->Cell(5,5,utf8_decode("QUINTA.- Entrega-Recepción del VEHÍCULO        "));




$pdf->setY(162);$pdf->setX(5);
$pdf->Cell(5,5,utf8_decode("SEXTA.- Seguro.   "));
$pdf->setY(173);$pdf->setX(5);
$pdf->Cell(5,5,utf8_decode("SÉPTIMA.- Obligaciones de las partes."));

$pdf->SetFont('Arial','',5);
$pdf->setY(127);$pdf->setX(5);
$pdf->Multicell(95,2,utf8_decode("                                                                            EL ARRENDATARIO se obliga a acudir al domicilio del ARRENDADOR para recibir el VEHÍCULO en la fecha inicial indicada en la CARÁTULA, así como para devolverlo al ARRENDADOR en la fecha final que se detalla en la CARÁTULA, misma que podrá ser prorrogada previa autorización del ARRENDADOR por un plazo máximo de 48-cuarenta y ocho horas. "));
$pdf->setY(138);$pdf->setX(5);
$pdf->Multicell(95,2,utf8_decode("En caso que opere la prórroga el ARRENDATARIO se obliga a pagar una renta equivalente a 1.5-uno punto cinco veces el monto señalado en la CARÁTULA, misma que será devengada durante todo el tiempo que el VEHÍCULO se encuentre en su posesión, incluso si rebasa el plazo de la prórroga. La renta deberá ser cubierta diariamente en el domicilio del arrendador o en la cuenta bancaria que éste le indique. Si el ARRENDATARIO no cubre oportunamente el monto antes señalado, cada renta adeudada se acumulará, obligándose el ARRENDATARIO a pagar al ARRENDADOR intereses moratorios a razón de una tasa del 10%-diez por ciento mensual sobre el monto adeudado."));
$pdf->setY(153);$pdf->setX(5);
$pdf->Multicell(95,2,utf8_decode("Si el ARRENDATARIO no devuelve el VEHÍCULO al ARRENDADOR a más tardar dentro del plazo señalado para la prórroga, se entenderá que la posesión del VEHÍCULO es contra la expresa oposición del ARRENDADOR, quedando éste facultado para iniciar las acciones legales que considere pertinentes, tales como demandas, denuncias y/o querellas por los delitos de robo, fraude, abuso de confianza y/o los que resulten. "));

$pdf->setY(163);$pdf->setX(5);
$pdf->Multicell(95,2,utf8_decode("                             Las partes acuerdan que El ARRENDADOR podrá contratar con la compañía que mejor convenga a sus intereses, un seguro de daños y/o responsabilidad civil para el VEHÍCULO. En caso de robo, daños o accidente en el que resulte participante el VEHÍCULO, independientemente de la responsabilidad que resulte, el ARRENDATARIO se obliga a pagar al ARRENDADOR el monto del deducible consignado en la póliza de seguro contratada, mismo que le fue informado por el ARRENDADOR previo a la firma de este contrato."));
  
$pdf->setY(174);$pdf->setX(5);
$pdf->Multicell(112,4,utf8_decode("                                                                     Por medio de este contrato cada una de las partes se obliga a lo siguiente:"));

$pdf->setY(178);$pdf->setX(10);
$pdf->Multicell(112,4,utf8_decode("i)	         El ARRENDADOR:"));

$pdf->setY(183);$pdf->setX(18);
$pdf->Multicell(80,2,utf8_decode("a.	 Entregar el VEHÍCULO al ARRENDATARIO en la fecha pactada y recibirlo una vez terminada la vigencia del contrato. "));
$pdf->setY(188);$pdf->setX(18);
$pdf->Multicell(80,2,utf8_decode("b.  Entregar al ARRENDATARIO una copia de la póliza de seguro de daños del VEHÍCULO. "));
$pdf->setY(190);$pdf->setX(18);
$pdf->Multicell(80,2,utf8_decode("c.  Contratar y mantener vigente un contrato de seguro que garantice la pérdida parcial o total del VEHÍCULO por robo o daño."));
$pdf->setY(195);$pdf->setX(18);
$pdf->Multicell(80,2,utf8_decode("d.	 Entregar el vehículo en las condiciones necesarias para su manejo y operación"));
$pdf->setY(197);$pdf->setX(18);
$pdf->Multicell(80,2,utf8_decode("e.	 Mantener actualizada y en regla la documentación que ampare la propiedad del vehículo así como su tránsito."));


$pdf->setY(202);$pdf->setX(10);
$pdf->Multicell(112,4,utf8_decode("ii)	         El ARRENDATARIO:"));

$pdf->setY(206);$pdf->setX(18);
$pdf->Multicell(80,2,utf8_decode("a.   Acudir oportunamente a recibir el VEHÍCULO en el domicilio del ARRENDADOR y entregarlo inmediatamente después de concluida la vigencia del contrato."));
$pdf->setY(211);$pdf->setX(18);
$pdf->Multicell(80,2,utf8_decode("b.   Pagar oportunamente la renta pactada en el contrato."));
$pdf->setY(214);$pdf->setX(18);
$pdf->Multicell(80,2,utf8_decode("c.   En caso de robo, daño o accidente, cubrir inmediatamente el monto de los deducibles correspondientes de acuerdo a la póliza de seguro del VEHÍCULO."));

$pdf->setY(219);$pdf->setX(18);
$pdf->Multicell(80,2,utf8_decode("d.   Contar con los permisos, licencias y autorizaciones necesarias para la transportación de"));

$pdf->setY(222);$pdf->setX(18);
$pdf->Multicell(35,2,utf8_decode("los bienes y mercancías, así como la operación del vehículo."));


$pdf->setY(226);$pdf->setX(18);
$pdf->Multicell(38,2,utf8_decode("e.   Cerciorarse de que el OPERADOR cuente con las licencias y conocimientos técnicos necesarios para la operación del VEHÍCULO."));

$pdf->setY(235);$pdf->setX(18);
$pdf->Multicell(38,2,utf8_decode("f.   Obedecer y respetar los reglamentos de transito municipal, estatal o federal."));

$pdf->setY(240);$pdf->setX(18);
$pdf->Multicell(38,2,utf8_decode("Utilizar el vehículo únicamente para la transportación de bienes y/o mercancías."));

$pdf->setY(245);$pdf->setX(18);
$pdf->Multicell(38,2,utf8_decode("No exceder las dimensiones y límite de carga del VEHÍCULO. "));

$pdf->setY(250);$pdf->setX(18);
$pdf->Multicell(38,2,utf8_decode("No dañar el VEHÍCULO o cualquiera de sus partes, incluyendo el equipo y herramientas de emergencia con que cuenta."));

$pdf->setY(9);$pdf->setX(121);
$pdf->Multicell(85,2,utf8_decode("Abstenerse y, en su caso, cerciorarse de que el OPERADOR y acompañante se abstengan de fumar y/o"));

$pdf->setY(12);$pdf->setX(121);
$pdf->Multicell(85,2,utf8_decode("ingerir bebidas alcohólicas, así como cualquier medicamento, droga o sustancia ilegal o que no le haya sido prescrita por un médico dentro del VEHICULO, independientemente que se encuentre o no operándolo."));

$pdf->setY(18);$pdf->setX(121);
$pdf->Multicell(85,2,utf8_decode("Revisar de forma periódica y razonable los niveles de aceite en el motor, agua del radiador, así como la presión de las llantas del VEHÍCULO. "));
$pdf->setY(22);$pdf->setX(121);
$pdf->Multicell(85,2,utf8_decode("Notificar inmediatamente al ARRENDADOR de las fallas o daños que llegare a detectar durante las primeras 4-cuatro horas a partir de la entrega del VEHÍCULO. Las fallas o daños que surjan de forma posterior serán reparadas por cuenta del ARRENDATARIO."));
$pdf->setY(29);$pdf->setX(121);
$pdf->Multicell(85,2,utf8_decode("Notificar del mantenimiento de emergencia o reparaciones que realice al VEHÍCULO en un plazo máximo de 24-veinticuatro horas, debiendo especificar el posible daño ocurrido, así como la ubicación del mismo."));
$pdf->setY(33);$pdf->setX(121);
$pdf->Multicell(85,2,utf8_decode("Notificar al ARRENDADOR inmediatamente cualquier accidente, choque, robo o evento que involucre al VEHÍCULO, quedando comprometido el ARRENDATARIO a proporcionar todo el auxilio y apoyo que el ARRENDADOR le requiera en el tramite de cualquier reclamación a sobre seguros que se tengan contratados para el VEHÍCULO."));
$pdf->setY(41);$pdf->setX(121);
$pdf->Multicell(85,2,utf8_decode("Es obligado solidario en cualquier daño que sufra el Vehiculo o Terceros publicos o privados ademas de cubrir los daños a accesorios o ponchaduras que se hayan generado en el o por  VEHÍCULO durante la vigencia del contrato."));

$pdf->setY(47);$pdf->setX(121);
$pdf->Multicell(85,2,utf8_decode("Dar asistencia al ARRENDADOR para realizar la investigación necesaria de cualquier evento dañoso  o riesgo asegurado, así como defender todas las reclamaciones y demandas relacionadas."));
$pdf->setY(52);$pdf->setX(121);
$pdf->Multicell(85,2,utf8_decode("Acudir antes las Autoridades, de cualquier fuero y materia, que le solicite el ARRENDADOR a fin de poder recuperar vehículos, recuperación de daños y cualesquier otro tramite que se requiera para el cumplimiento del objeto social y actividad del arrendador"));


//letras

$pdf->setY(9);$pdf->setX(115);
$pdf->Multicell(85,2,utf8_decode("j."));

$pdf->setY(12);$pdf->setX(115);
$pdf->Multicell(85,2,utf8_decode("k."));

$pdf->setY(18);$pdf->setX(115);
$pdf->Multicell(85,2,utf8_decode("l."));
$pdf->setY(22);$pdf->setX(115);
$pdf->Multicell(85,2,utf8_decode("m."));
$pdf->setY(29);$pdf->setX(115);
$pdf->Multicell(85,2,utf8_decode("n."));
$pdf->setY(33);$pdf->setX(115);
$pdf->Multicell(85,2,utf8_decode("o."));
$pdf->setY(41);$pdf->setX(115);
$pdf->Multicell(85,2,utf8_decode("p."));

$pdf->setY(47);$pdf->setX(115);
$pdf->Multicell(85,2,utf8_decode("q."));
$pdf->setY(52);$pdf->setX(115);
$pdf->Multicell(85,2,utf8_decode("r."));

//letras


//
$pdf->setY(62);$pdf->setX(106);
$pdf->Multicell(100,2,utf8_decode("                                                                El ARRENDATARIO manifiesta su conformidad con las característirísticas del VEHÍCULO, las cuales se detallan en la CARÁTULA y reconoce que le fueron informadas por el ARRENDADOR con anterioridad a la firma de este contrato. Al momento de realizar la entrega, las partes se obligan a llenar y firmar el ANEXO ÚNICO, el cual contiene un inventario del equipamiento con que cuenta el VEHÍCULO, así como su estado físico, mismo que deberá ser revisado y corroborado por ambas partes previo a su firma."));
$pdf->setY(73);$pdf->setX(106);
$pdf->Multicell(100,2,utf8_decode("                                             El ARRENDATARIO se obliga a utilizar y operar el VEHÍCULO únicamente para la transportación de bienes y/o mercancías, quedando estrictamente prohibido utilizarlo para transportar o almacenar lo siguiente:"));

$pdf->setY(80);$pdf->setX(120);
$pdf->Multicell(154,4,utf8_decode("Personas distintas del OPERADOR y/o acompañante. "));
$pdf->setY(83);$pdf->setX(120);
$pdf->Multicell(154,2,utf8_decode("Mascotas y en general cualquier animal vivo."));
$pdf->setY(85);$pdf->setX(120);
$pdf->Multicell(86,2,utf8_decode("Químicos, sustancias peligrosas o inflamables o cualquier producto que dañe permanentemente el VEHÍCULO, o exponga a cualquier persona a un riesgo o un daño."));
$pdf->setY(89);$pdf->setX(120);
$pdf->Multicell(86,2,utf8_decode("Explosivos o armas de fuego."));
$pdf->setY(91);$pdf->setX(120);
$pdf->Multicell(86,2,utf8_decode("Drogas, estupefacientes y en general cualquier sustancia cuya producción, almacenaje, transporte, venta y/o comercialización se encuentren controladas o prohibidas."));
$pdf->setY(95);$pdf->setX(120);
$pdf->Multicell(86,2,utf8_decode("Bienes y mercancías que no pertenezcan al ARRENDATARIO o no se encuentren en depósito o legal posesión de éste."));


$pdf->setY(80);$pdf->setX(115);
$pdf->Multicell(154,4,utf8_decode("i)"));
$pdf->setY(83);$pdf->setX(115);
$pdf->Multicell(154,2,utf8_decode("ii)"));
$pdf->setY(85);$pdf->setX(115);
$pdf->Multicell(86,2,utf8_decode("iii)"));
$pdf->setY(89);$pdf->setX(115);
$pdf->Multicell(86,2,utf8_decode("iv)"));
$pdf->setY(91);$pdf->setX(115);
$pdf->Multicell(86,2,utf8_decode("v)"));
$pdf->setY(95);$pdf->setX(115);
$pdf->Multicell(86,2,utf8_decode("vi)"));

$pdf->setY(105);$pdf->setX(106);
$pdf->Multicell(100,2,utf8_decode("                                                          El ARRENDATARIO se obliga a cubrir por su cuenta todos los gastos relacionados con la operación del VEHÍCULO, tales como combustible, cuotas de peaje o pesaje, y específicamente las multas o sanciones que llegaren a ser impuestas al ARRENDATARIO u OPERADOR con motivo de la operación del vehículo, y aquéllas que surjan hasta 120-ciento veinte días después de la terminación de la vigencia de este contrato. . En tal caso, el ARRENDATARIO se obliga a informar inmediatamente al ARRENDADOR sobre la imposición de la sanción y a cubrir el pago de la misma al momento de devolver la unidad, independientemente de que el ARRENDATARIO decida promover algún medio de defensa legal en  contra de la misma.  "));
$pdf->setY(122);$pdf->setX(106);
$pdf->Multicell(100,2,utf8_decode("                                                            Las partes acuerdan que el presente Contrato es de naturaleza esencial y estrictamente mercantil, por tanto no existe, ni existirá en el futuro relación laboral de naturaleza alguna entre las Partes, ni entre los empleados de cada una de ellas con la otra, por lo que cada una de las Partes será responsable de cualquier obligación laboral derivada de la relación existente con sus respectivos empleados, y en ningún caso y bajo ningún concepto los empleados de cualquiera de las Partes podrán considerar a la otra como patrón directo o substituto, por lo que ambas Partes se obligan a liberar y mantener en paz y a salvo a la otra frente a cualquier reclamación o demanda que su personal pretendiese hacer o hiciere en contra de ésta, así como a indemnizarla para resarcir los daños y perjuicios que por dichos motivos pudiere sufrir."));
$pdf->setY(141);$pdf->setX(106);
$pdf->Multicell(100,2,utf8_decode("                                                                              Cualquiera de las partes podrá por terminado el presente contrato antes del término de su vigencia, dando aviso por escrito a la otra parte con dos días de anticipación, quedando obligadas las partes a cubrir el monto de los servicios que hubiere recibido de la otra parte hasta la fecha en que opere la terminación."));

$pdf->setY(151);$pdf->setX(106);
$pdf->Multicell(100,2,utf8_decode("                                                                                                              Las partes convienen en que toda aquella información  personal que sea proporcionada por cualquiera de las partes, con motivo de la ejecución del presente contrato o de aquellos que se llegaren a celebrar con posterioridad, serán resguardados y conservados con la única finalidad de identificar a la parte que entregue información personal, para dar cumplimiento a las obligaciones contractuales derivadas del presente instrumento o bien, de aquellos que llegaren a celebrar las partes; siempre en observancia de las disposiciones contenidas en la Ley Federal de Protección de Datos Personales en Posesión de los Particulares y su reglamento. Las Partes convienen que el presente Contrato no otorga al ARRENDATARIO licencia alguna o algún tipo de derecho respecto sobre la propiedad intelectual del ARRENDADOR. El ARRENDATARIO se obliga a no usar, comercializar, revelar a terceros, distribuir, regalar, o  de cualquier otro modo disponer de cualquier desarrollo del ARRENDADOR, ni de cualquier material o material excedente que sea resultado de la propiedad intelectual del ARRENDADOR, sin autorización expresa y por escrito del ARRENDADOR."));

$pdf->setY(176);$pdf->setX(106);
$pdf->Multicell(100,2,utf8_decode("                                    Ambas Partes señalan como sus domicilios convencionales para recibir toda clase de avisos, comunicaciones, notificaciones y en general para todo lo relacionado con el presente Contrato, los descritos en la CARÁTULA. Cualquier cambio en el domicilio de alguna de las Partes, deberá ser notificado por escrito a la contraparte para que surta efectos dicho cambio. En caso de no hacerlo, todo aviso, notificación y demás diligencias, ya sean judiciales o extrajudiciales, que se hagan en el domicilio indicado en ésta cláusula, surtirán plenamente los efectos legales a que haya lugar. Las mencionadas notificaciones y/o avisos surtirán sus efectos una vez que se compruebe su recepción. "));
$pdf->setY(197);$pdf->setX(106);
$pdf->Multicell(100,2,utf8_decode("                                                 Las Partes acuerdan someterse expresamente a la Jurisdicción de los Tri bunales competentes del Primer Distrito Judicial del Estado de Nuevo León, con residencia en la ciudad de Monterrey, Nuevo León, y a las Leyes, Reglamentos y demás disposiciones legales vigentes en dicha entidad, para la solución de cualquier controversia que surja con motivo de la interpretación, cumplimiento y/o ejecución de lo pactado en el presente Contrato, renunciando a cualquier otro fuero que por razones de sus domicilios presentes o futuros, o por cualquier otra causa, pudiera corresponderles."));

$pdf->SetFont('Arial','B',5);
$pdf->setY(60);$pdf->setX(106);
$pdf->Cell(5,5,utf8_decode("OCTAVA.- Características del VEHÍCULO."));
$pdf->setY(72);$pdf->setX(106);
$pdf->Cell(5,5,utf8_decode("NOVENA.- Uso del VEHÍCULO. "));
$pdf->setY(103);$pdf->setX(106);
$pdf->Cell(5,5,utf8_decode("DÉCIMA.- Gastos del VEHÍCULO. "));

$pdf->setY(121);$pdf->setX(106);
$pdf->Cell(5,5,utf8_decode("DÉCIMA PRIMERA.- Relación Mercantil. "));

$pdf->setY(140);$pdf->setX(106);
$pdf->Cell(5,5,utf8_decode("DÉCIMA SEGUNDA.- Terminación Anticipada.  "));

$pdf->setY(150);$pdf->setX(106);
$pdf->Cell(5,5,utf8_decode("DÉCIMA TERCERA.- Datos Personales y Propiedad Intelectual. "));

$pdf->setY(174);$pdf->setX(106);
$pdf->Cell(5,5,utf8_decode("VIGÉSIMA.- Notificaciones. "));

$pdf->setY(195);$pdf->setX(106);
$pdf->Cell(5,5,utf8_decode("VIGÉSIMA PRIMERA.- Jurisdicción. "));


$pdf->SetDrawColor(47, 47, 47);
$pdf->rect(60,226,140,45);

$pdf->SetFont('Arial','B',10);
$pdf->setY(230);$pdf->setX(80);
$pdf->Cell(5,5,utf8_decode("EL ARRENDADOR"));

$pdf->setY(235);$pdf->setX(70);
$pdf->Cell(5,5,utf8_decode($tofirm[0]));
//$pdf->Cell(12,12,utf8_decode($tofirm[1]));


$pdf->setY(246);$pdf->setX(65);
$pdf->Cell(5,5,"______________________________");

$pdf->SetFont('Arial','B',8);
$pdf->setY(250);$pdf->setX(67);
$pdf->Cell(5,5,utf8_decode($nomCol1));

$pdf->setY(255);$pdf->setX(70);
$pdf->Cell(5,5,utf8_decode("REPRESENTANTE LEGAL"));


$pdf->setY(230);$pdf->setX(145);
$pdf->Cell(5,5,utf8_decode("EL ARRENDATARIO"));

$pdf->setY(235);$pdf->setX(137);
$pdf->Cell(5,5,utf8_decode($nomcliente));

$pdf->setY(246);$pdf->setX(133);
$pdf->Cell(5,5,"______________________________");

$str = strlen($contacto);
if($str>=29){
    $auxNom = substr($contacto, 0, 29);
    $pdf->setY(250);$pdf->setX(135);
    $pdf->Cell(5,5,utf8_decode($auxNom));
    
    $auxNom2 = substr($contacto, 29, $str);
    $pdf->setY(255);$pdf->setX(140);
    $pdf->Cell(5,5,utf8_decode($auxNom2)); 

    $pdf->setY(260);$pdf->setX(145);
    $pdf->Cell(5,5,utf8_decode("REPRESENTANTE LEGAL"));
}else{
    $auxNom = substr($contacto, 0, 29);
    $pdf->setY(250);$pdf->setX(135);
    $pdf->Cell(5,5,utf8_decode($auxNom)); 

    $pdf->setY(255);$pdf->setX(140);
    $pdf->Cell(5,5,utf8_decode("REPRESENTANTE LEGAL"));
}

//$pdf->setY(250);$pdf->setX(135);
//$pdf->Cell(5,5,utf8_decode($contacto));

//$pdf->setY(255);$pdf->setX(140);
//$pdf->Cell(5,5,utf8_decode("REPRESENTANTE LEGAL"));



    $pdf->AddPage('P','A4');
    
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(44, 34, 34 );
    $pdf->SetFillColor(255,255,255); 

    $pdf->setY(40);$pdf->setX(100);
    $pdf->Cell(5,5,utf8_decode("PAGARÉ"));

    $pdf->SetFont('Arial','B',8);
    $pdf->setY(60);$pdf->setX(130);
    $pdf->Cell(5,5,utf8_decode("Lugar de suscripción:"));
    $pdf->setY(64);$pdf->setX(130);
    $pdf->Cell(5,5,utf8_decode("Fecha de suscripción: "));

    $pdf->SetFont('Arial','B',10);
    $pdf->setY(150);$pdf->setX(94);
    $pdf->Cell(5,5,utf8_decode("SUSCRIPTOR"));


    $pdf->SetFont('Arial','',8);
    $pdf->setY(60);$pdf->setX(160);
    $pdf->Multicell(0,5,utf8_decode($estado));
    /*$pdf->setY(64);$pdf->setX(165);
    $pdf->Cell(5,5,date("d"));
    $pdf->setY(64);$pdf->setX(178);
    $pdf->Cell(5,5,date("m"));
    $pdf->setY(64);$pdf->setX(195);
    $pdf->Cell(5,5,date("y"));*/
    $pdf->setY(64);$pdf->setX(164);
    $pdf->Cell(5,5,utf8_decode($fecha[2]));
    $pdf->setY(64);$pdf->setX(177);
    $pdf->Cell(5,5,utf8_decode($fecha[1]));
    $pdf->setY(64);$pdf->setX(191);
    $pdf->Cell(5,5,utf8_decode($fecha[0]));

    $pdf->SetFont('Arial','',9);
    $pdf->setY(64);$pdf->setX(160);
    $pdf->Cell(5,5,utf8_decode("______de______de______."));

    $pdf->setY(80);$pdf->setX(7);
    $pdf->Multicell(196,5,utf8_decode("Por el presente PAGARÉ, reconocemos adeudar y prometemos pagar incondicionalmente a la orden del beneficiario ".$nomsuc." el día ".$fecha[2]." DE ".$fecha[1]." DE ".$fecha[0].", la cantidad de $ ".$valor_pagare." (_____________________________________________ pesos 00/100 moneda nacional), valor recibido en efectivo a nuestra entera satisfacción. El importe de este pagaré generará intereses ordinarios a razón de una tasa mensual del 2%-dos por ciento. En caso de incumplimiento de pago de la cantidad consignada en la fecha antes indicada, el suscriptor se obliga a pagar intereses moratorios a razón de una tasa mensual del 4%-cuatro por ciento.   El pago deberá efectuarse en el domicilio del beneficiario ubicado en ".$direccion.", C.P. ".$cp.", ".$estado.".")); 

    $pdf->setY(120);$pdf->setX(7);
    $pdf->Multicell(196,5,utf8_decode("En caso de cualquier contorversia que surja con motivo del presente documento, los suscriptores y, en su caso, los avalistas, acuerdan someterse a la jurisdicción de los tribunales competentes de la ciudad de Monterrey, Nuevo León, renunciando a cualquier otro fuero o competencia que pudiera corresponderles en razón de su domicilio o por cualquier otra causa.")); 

    $pdf->setY(167);$pdf->setX(80);
    $pdf->Cell(5,5,utf8_decode("_______________________________"));
    $pdf->setY(171);$pdf->setX(80);
    $pdf->Cell(30,5,utf8_decode( $contacto)); 
    $pdf->setY(175);$pdf->setX(85);
    $pdf->Cell(30,5,utf8_decode(" representado por:")); 
    $pdf->setY(180);$pdf->setX(80);
    $pdf->Cell(30,5,utf8_decode($nomcliente)); 
  
    $extension=".pdf";
    $pdf->output($folio.$extension,'I');
    $pdf->output();
    

?>