<?php
  /** Se agrega la libreria PHPExcel */
  //require '../Classes/PHPExcel.php';
  include ("../model/liga_BD.php");
  $valorsuc= $_GET['ids'];
  $sql="SELECT cliente.nomcli, cliente.celular, unidades.nomuni, unidades.serie, unidades.placas, servicio.tipo, orden_servicio.id, orden_servicio.fecha_inicial, orden_servicio.hora_inicial, orden_servicio.fecha_final, orden_servicio.hora_final, orden_servicio.kilometraje, orden_servicio.marcandia_transportar, orden_servicio.dirrecoleccion, orden_servicio.direntrega, orden_servicio.hrecoleccion, orden_servicio.hrcita, orden_servicio.ciudaddestino, orden_servicio.costo FROM orden_servicio INNER JOIN cliente on cliente.id=orden_servicio.idcli INNER JOIN unidades on unidades.noserie=orden_servicio.iduni INNER JOIN servicio on servicio.id=orden_servicio.idservi WHERE orden_servicio.idsucur=".$valorsuc;
  $resultado=mysqli_query($link,$sql);

 


  if($resultado->num_rows > 0 ){
    date_default_timezone_set('America/Mexico_City');

    if (PHP_SAPI == 'cli')
    die('Este archivo solo se puede ver desde un navegador web');

    /** Se agrega la libreria PHPExcel */
 require_once '../Classes/PHPExcel.php';
  
 // Se crea el objeto PHPExcel
  $objPHPExcel = new PHPExcel();

  // Se asignan las propiedades del libro
$objPHPExcel->getProperties()->setCreator("Codedrinks") // Nombre del autor
->setLastModifiedBy("Codedrinks") //Ultimo usuario que lo modificó
->setTitle("Reporte Excel con PHP y MySQL") // Titulo
->setSubject("Reporte Excel con PHP y MySQL") //Asunto
->setDescription("Reporte de alumnos") //Descripción
->setKeywords("reporte alumnos carreras") //Etiquetas
->setCategory("Reporte excel"); //Categorias

$tituloReporte = "Relación de Servicios ";
$titulosColumnas = array('#','TIPO', 'CLIENTE', 'TELEFONO', 'UNIDAD','NUM. SERIE', 'PLACAS', 'FECHA INICIAL', 'HORA INICIAL', 
'FECHA FINAL', 'HORA FINAL', 'KILOMETRAJE', 'MERCANCIA','DIR. RECOLECCION', 'DIR. ENTREGA', 'HR. RECOLECCION', 'HR. CITA', 'CIUDAD DEST.','COSTO');

// Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A1:S1');
  
// Se agregan los titulos del reporte
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1',$tituloReporte) // Titulo del reporte
    ->setCellValue('A3',  $titulosColumnas[0])  //Titulo de las columnas
    ->setCellValue('B3',  $titulosColumnas[1])
    ->setCellValue('C3',  $titulosColumnas[2])
    ->setCellValue('D3',  $titulosColumnas[3])
    ->setCellValue('E3',  $titulosColumnas[4])
    ->setCellValue('F3',  $titulosColumnas[5])
    ->setCellValue('G3',  $titulosColumnas[6])
    ->setCellValue('H3',  $titulosColumnas[7])
    ->setCellValue('I3',  $titulosColumnas[8])
    ->setCellValue('J3',  $titulosColumnas[9])
    ->setCellValue('K3',  $titulosColumnas[10])
    ->setCellValue('L3',  $titulosColumnas[11])
    ->setCellValue('M3',  $titulosColumnas[12])
    ->setCellValue('N3',  $titulosColumnas[13])
    ->setCellValue('O3',  $titulosColumnas[14])
    ->setCellValue('P3',  $titulosColumnas[15])
    ->setCellValue('Q3',  $titulosColumnas[16])
    ->setCellValue('R3',  $titulosColumnas[17])
    ->setCellValue('S3',  $titulosColumnas[18]);

    //Se agregan los datos de los alumnos
  
 $i = 4; //Numero de fila donde se va a comenzar a rellenar
 while ($fila = $resultado->fetch_array()) {
     $objPHPExcel->setActiveSheetIndex(0)
         ->setCellValue('A'.$i, $fila['id'])
         ->setCellValue('B'.$i, $fila['tipo'])
         ->setCellValue('C'.$i, $fila['nomcli'])
         ->setCellValue('D'.$i, $fila['celular'])
         ->setCellValue('E'.$i, $fila['nomuni'])
         ->setCellValue('F'.$i, $fila['serie'])
         ->setCellValue('G'.$i, $fila['placas'])
         ->setCellValue('H'.$i, $fila['fecha_inicial'])
         ->setCellValue('I'.$i, $fila['hora_inicial'])
         ->setCellValue('J'.$i, $fila['fecha_final'])
         ->setCellValue('K'.$i, $fila['hora_final'])
         ->setCellValue('L'.$i, $fila['kilometraje'])
         ->setCellValue('M'.$i, $fila['marcandia_transportar'])
         ->setCellValue('N'.$i, $fila['dirrecoleccion'])
         ->setCellValue('O'.$i, $fila['direntrega'])
         ->setCellValue('P'.$i, $fila['hrecoleccion'])
         ->setCellValue('Q'.$i, $fila['hrcita'])
         ->setCellValue('R'.$i, $fila['ciudaddestino'])
         ->setCellValue('S'.$i, $fila['costo']);
     $i++;
 }

 $estiloTituloReporte = array(
    'font' => array(
        'name'      => 'Verdana',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>16,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'argb' => 'FF220835')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_NONE
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
  
$estiloTituloColumnas = array(
    'font' => array(
        'name'  => 'Arial',
        'bold'  => true,
        'color' => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
        'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
  'rotation'   => 90,
        'startcolor' => array(
            'rgb' => 'c47cf2'
        ),
        'endcolor' => array(
            'argb' => 'FF431a5d'
        )
    ),
    'borders' => array(
        'top' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            'color' => array(
                'rgb' => '143860'
            )
        ),
        'bottom' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            'color' => array(
                'rgb' => '143860'
            )
        )
    ),
    'alignment' =>  array(
        'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap'      => TRUE
    )
);
  
$estiloInformacion = new PHPExcel_Style();
$estiloInformacion->applyFromArray( array(
    'font' => array(
        'name'  => 'Arial',
        'color' => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
  'type'  => PHPExcel_Style_Fill::FILL_SOLID,
  'color' => array(
            'argb' => 'FFd9b7f4')
  ),
    'borders' => array(
        'left' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN ,
      'color' => array(
              'rgb' => '3a2a47'
            )
        )
    )
));

$objPHPExcel->getActiveSheet()->getStyle('A1:S1')->applyFromArray($estiloTituloReporte);
$objPHPExcel->getActiveSheet()->getStyle('A3:S3')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:S".($i-1));
  
for($i = 'A'; $i <= 'S'; $i++){
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
}

// Se asigna el nombre a la hoja
$objPHPExcel->getActiveSheet()->setTitle('Servicios');
  
// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
$objPHPExcel->setActiveSheetIndex(0);
  
// Inmovilizar paneles
//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);


// Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporteservicios.xlsx"');
header('Cache-Control: max-age=0');
  
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
}
else{
    print_r('No hay resultados para mostrar');
}
  
?>