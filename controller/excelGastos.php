<?php
  /** Se agrega la libreria PHPExcel */
  //require '../Classes/PHPExcel.php';
  include ("../model/liga_BD.php");
  $valorsuc= $_GET['suc'];
  $uni= $_GET['uni'];
  $fechaini= $_GET['fechaini'];
  $fechafin= $_GET['fechafin'];
  $total = 0;
  $sql="SELECT mantenimiento.id, mantenimiento.tipo, unidades.serie, unidades.nomuni, mantenimiento.fecha_inicio, 
  mantenimiento.fecha_final, mantenimiento.afec_disponiilidad, mantenimiento.gastos, mantenimiento.actividad, 
  mantenimiento.descripcion FROM mantenimiento INNER JOIN unidades on unidades.noserie=mantenimiento.idunid WHERE 
  mantenimiento.idsucr=5 
  AND mantenimiento.idunid=$uni
  AND mantenimiento.fecha_inicio >= '$fechaini' AND mantenimiento.fecha_final <= '$fechafin'";

  //$sql="SELECT mantenimiento.id, mantenimiento.tipo, unidades.serie, unidades.nomuni, mantenimiento.fecha_inicio, mantenimiento.fecha_final, mantenimiento.afec_disponiilidad, mantenimiento.gastos, mantenimiento.actividad, mantenimiento.descripcion FROM mantenimiento INNER JOIN unidades on unidades.noserie=mantenimiento.idunid WHERE mantenimiento.idsucr=".$valorsuc;
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

$tituloReporte = "Relación de Gasto de Unidades";
$titulosColumnas = array('UNIDAD','TIPO', 'GASTO', 'ACTIVIDAD', 'PROVEEDOR','FECHA', 'COMENTARIOS');

// Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A1:G1');
  
// Se agregan los titulos del reporte
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1',$tituloReporte) // Titulo del reporte
    ->setCellValue('A3',  $titulosColumnas[0])  //Titulo de las columnas
    ->setCellValue('B3',  $titulosColumnas[1])
    ->setCellValue('C3',  $titulosColumnas[2])
    ->setCellValue('D3',  $titulosColumnas[3])
    ->setCellValue('E3',  $titulosColumnas[4])
    ->setCellValue('F3',  $titulosColumnas[5])
    ->setCellValue('G3',  $titulosColumnas[6]);

    //Se agregan los datos de los alumnos
  
 $i = 4; //Numero de fila donde se va a comenzar a rellenar
 while ($fila = $resultado->fetch_array()) {
     $objPHPExcel->setActiveSheetIndex(0)
         ->setCellValue('A'.$i, $fila['nomuni'])
         ->setCellValue('B'.$i, $fila['tipo'])
         ->setCellValue('C'.$i, $fila['gastos'])
         ->setCellValue('D'.$i, $fila['actividad'])
         ->setCellValue('E'.$i, "NA")
         ->setCellValue('F'.$i, $fila['fecha_inicio'])
         ->setCellValue('G'.$i, $fila['descripcion']);
     $i++;
     $aux = str_replace("","",$fila['gastos']);
     $total = $total + floatval($aux);
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
            'argb' => 'E74C3C')
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
            'rgb' => 'B03A2E'
        ),
        'endcolor' => array(
            'argb' => '641E16'
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
            'argb' => 'F9EBEA')
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

$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($estiloTituloReporte);
$objPHPExcel->getActiveSheet()->getStyle('A3:G3')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, 'Total gastos del '.$fechaini.' al '.$fechafin);
$objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':B'.$i);
$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $total, 2);
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFont()->setBold(true)->setSize(12);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getFont()->setBold(true)->setSize(12);
$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:G".($i-1));
  
for($i = 'A'; $i <= 'G'; $i++){
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
}

// Se asigna el nombre a la hoja
$objPHPExcel->getActiveSheet()->setTitle('Gastos Unidades');
  
// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
$objPHPExcel->setActiveSheetIndex(0);
  
// Inmovilizar paneles
//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);


// Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ReporteGastos.xls"');
header('Cache-Control: max-age=0');
  
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
}
else{
    print_r('No hay resultados para mostrar');
}
?>