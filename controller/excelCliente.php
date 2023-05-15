<?php
  /** Se agrega la libreria PHPExcel */
  //require '../Classes/PHPExcel.php';
  include ("../model/liga_BD.php");
  $valorsuc= $_GET['suc'];
  $sql="SELECT * FROM cliente WHERE idsucur=".$valorsuc;
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

$tituloReporte = "Relación de Clientes";
$titulosColumnas = array('#','RAZON SOCIAL', 'RFC', 'DIRECCION FISCAL', 'COLONIA','CIUDAD', 'ESTADO', 'CODIGO POSTAL.', 'TELEFONO', 
'REPRESENTANTE LEGAL', 'INE', 'CORREO FACTURACION', 'CONTACTO','CELULAR', 'CORREO CONTACTO');

// Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A1:O1');
  
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
    ->setCellValue('O3',  $titulosColumnas[14]);

    //Se agregan los datos de los alumnos
  
 $i = 4; //Numero de fila donde se va a comenzar a rellenar
 while ($fila = $resultado->fetch_array()) {
     $objPHPExcel->setActiveSheetIndex(0)
         ->setCellValue('A'.$i, $fila['id'])
         ->setCellValue('B'.$i, $fila['razonsocial'])
         ->setCellValue('C'.$i, $fila['rfc'])
         ->setCellValue('D'.$i, $fila['dirsocial'])
         ->setCellValue('E'.$i, $fila['colonia'])
         ->setCellValue('F'.$i, $fila['ciudad'])
         ->setCellValue('G'.$i, $fila['estado'])
         ->setCellValue('H'.$i, $fila['cp'])
         ->setCellValue('I'.$i, $fila['telcli'])
         ->setCellValue('J'.$i, "NA")
         ->setCellValue('K'.$i, $fila['ine'])
         ->setCellValue('L'.$i, $fila['correofac'])
         ->setCellValue('M'.$i, $fila['contacto'])
         ->setCellValue('N'.$i, $fila['celular'])
         ->setCellValue('O'.$i, $fila['correocont']);
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

$objPHPExcel->getActiveSheet()->getStyle('A1:O1')->applyFromArray($estiloTituloReporte);
$objPHPExcel->getActiveSheet()->getStyle('A3:O3')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:O".($i-1));
  
for($i = 'A'; $i <= 'O'; $i++){
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
}

// Se asigna el nombre a la hoja
$objPHPExcel->getActiveSheet()->setTitle('Clientes');
  
// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
$objPHPExcel->setActiveSheetIndex(0);
  
// Inmovilizar paneles
//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);


// Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reportecliente.xlsx"');
header('Cache-Control: max-age=0');
  
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
}
else{
    print_r('No hay resultados para mostrar');
}
?>