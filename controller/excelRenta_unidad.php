<?php
  /** Se agrega la libreria PHPExcel */
  //require '../Classes/PHPExcel.php';
    include ("../model/liga_BD.php");
    require_once '../vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Worksheet;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Style\Border;
    use PhpOffice\PhpSpreadsheet\Style\Fill;
    use PhpOffice\PhpSpreadsheet\Style\Style;
   
    $valorsuc= $_GET['suc'];
    $uni= $_GET['uni'];
    #$cliente=$_GET['cliente'];
    $fechaini= $_GET['fechaini'];
    $fechafin= $_GET['fechafin'];
    #echo " --suc: ".$valorsuc." --fechaini: ".$fechaini." --fechafin: ".$fechafin." --unidad: ".$uni;

    $sql="SELECT unidades.nomuni, servicio.tipo, cliente.razonsocial, orden_servicio.fecha_inicial, orden_servicio.fecha_final, 
    orden_servicio.costo, unidades.serie, orden_servicio.iduni
    FROM orden_servicio 
    INNER JOIN cliente on cliente.idsucur=orden_servicio.idsucur
    INNER JOIN unidades ON unidades.noserie=orden_servicio.iduni 
    INNER JOIN servicio on servicio.id=orden_servicio.idservi
    WHERE orden_servicio.idsucur=$valorsuc AND unidades.noserie=$uni 
    AND orden_servicio.fecha_inicial >= '$fechaini' AND orden_servicio.fecha_final <= '$fechafin'";

    $sqlmanto = "SELECT mantenimiento.id, unidades.nomuni, mantenimiento.tipo, mantenimiento.fecha_inicio, 
    mantenimiento.fecha_final, mantenimiento.gastos, mantenimiento.actividad, mantenimiento.descripcion 
    FROM mantenimiento 
    INNER JOIN unidades ON unidades.noserie=mantenimiento.idunid
    WHERE idunid=$uni";
  
    $resultado=mysqli_query($link,$sql);
    $resultmanto=mysqli_query($link,$sqlmanto);

    if($resultado !== false && $resultado->num_rows > 0 ){

        // Se crea el objeto PHPExcel
        $spreadsheet = new Spreadsheet();

        // Se asignan las propiedades del libro
        $spreadsheet
            ->getProperties()
            ->setCreator("Codedrinks") // Nombre del autor
            ->setLastModifiedBy("Codedrinks") //Ultimo usuario que lo modificó
            ->setTitle("Reporte Excel con PHP y MySQL") // Titulo
            ->setSubject("Reporte Excel con PHP y MySQL") //Asunto
            ->setDescription("Reporte de alpha") //Descripción
            ->setKeywords("reporte alpha") //Etiquetas
            ->setCategory("Reporte excel"); //Categorias

        $nombreDelDocumento = "Rentabilidad_Unidad.xlsx";
        $tituloReporte = "Reporte de Rentabilidad - Unidad";
    
        //HOJA DE DETALLE
        //Envabezados
        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()
            ->setTitle('Rentabilidad Unidad')
            ->setCellValue('A1', $tituloReporte)
            ->setCellValue('A3', 'UNIDAD')
            ->setCellValue('B3', 'SERVICIO')
            ->setCellValue('C3', 'RAZÓN SOCIAL')
            ->setCellValue('D3', 'FECHA INICAL')
            ->setCellValue('E3', 'FECHA FINAL')
            ->setCellValue('F3', 'INGRESO')
            ->setCellValue('G3', 'UNIDAD')
            ->setCellValue('H3', 'TIPO')
            ->setCellValue('I3', 'GASTOS')
            ->setCellValue('J3', 'ACTIVIDAD')
            ->setCellValue('K3', 'FECHA INICIAL')
            ->setCellValue('L3', 'FECHA FINAL')
            ->setCellValue('M3', 'COMENTARIOS');
        
        $totalIng=0;
        $i=4;//Numero de fila donde se va a comenzar a rellenar
        //Impresion de datos desde la base
        while ($row1=mysqli_fetch_array($resultado)) {
            $spreadsheet->getActiveSheet()
                ->setCellValue('A'.$i, $row1['nomuni'])
                ->setCellValue('B'.$i, $row1['tipo'])
                ->setCellValue('C'.$i, $row1['razonsocial'])
                ->setCellValue('D'.$i, $row1['fecha_inicial'])
                ->setCellValue('E'.$i, $row1['fecha_final'])
                ->setCellValue('F'.$i, $row1['costo']);


            $spreadsheet->getActiveSheet()->getStyle('A'.$i.'')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('B'.$i.'')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('C'.$i.'')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('D'.$i.'')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('E'.$i.'')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('F'.$i.'')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('F'.$i.'')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER );

            $i++;
            $aux = str_replace(",","",$row1['costo']);
            $totalIng= $totalIng +  floatval($aux);
        }

        $totalGastos = 0;
        $k=4;
        if($resultmanto !== false && $resultmanto->num_rows > 0 ){
            while ($row2=mysqli_fetch_array($resultmanto)) {
                $spreadsheet->getActiveSheet()
                    ->setCellValue('G'.$k, $row2['nomuni'])
                    ->setCellValue('H'.$k, $row2['tipo'])
                    ->setCellValue('I'.$k, $row2['fecha_inicio'])
                    ->setCellValue('J'.$k, $row2['fecha_final'])
                    ->setCellValue('K'.$k, $row2['gastos'])
                    ->setCellValue('L'.$k, $row2['actividad'])
                    ->setCellValue('M'.$k, $row2['descripcion']);


                $spreadsheet->getActiveSheet()->getStyle('G'.$k.'')->getAlignment()->setHorizontal('center');
                $spreadsheet->getActiveSheet()->getStyle('H'.$k.'')->getAlignment()->setHorizontal('center');
                $spreadsheet->getActiveSheet()->getStyle('I'.$k.'')->getAlignment()->setHorizontal('center');
                $spreadsheet->getActiveSheet()->getStyle('J'.$k.'')->getAlignment()->setHorizontal('center');
                $spreadsheet->getActiveSheet()->getStyle('K'.$k.'')->getAlignment()->setHorizontal('center');
                $spreadsheet->getActiveSheet()->getStyle('L'.$k.'')->getAlignment()->setHorizontal('center');
                $spreadsheet->getActiveSheet()->getStyle('M'.$k.'')->getAlignment()->setHorizontal('center');
                $spreadsheet->getActiveSheet()->getStyle('K'.$k.'')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER );
                $k++;
                $aux = str_replace(",","",$row2['gastos']);
                $totalGastos= $totalGastos +  floatval($aux);
            }
        }
        ob_end_clean();
        ob_start();
        $total=$totalIng-$totalGastos;
        $i++;
        $spreadsheet->getActiveSheet()->setCellValue('C'.$i, 'Ingresos del '.$fechaini.' al '.$fechafin);
        $spreadsheet->getActiveSheet()->mergeCells('C'.$i.':E'.$i);
        $spreadsheet->getActiveSheet()->setCellValue('F'.$i,$totalIng,2);
        $spreadsheet->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
        $spreadsheet->getActiveSheet()->getStyle('F'.$i)->getFont()->setBold(true)->setSize(12);

        $spreadsheet->getActiveSheet()->setCellValue('H'.$i, 'Egresos del '.$fechaini.' al '.$fechafin);
        $spreadsheet->getActiveSheet()->mergeCells('H'.$i.':J'.$i);
        $spreadsheet->getActiveSheet()->setCellValue('K'.$i,$totalGastos,2);
        $spreadsheet->getActiveSheet()->getCell('K'.$i)->getCalculatedValue();
        $spreadsheet->getActiveSheet()->getStyle('K'.$i)->getFont()->setBold(true)->setSize(12);
       
    
        $spreadsheet->getActiveSheet()->getStyle('A1:M1')->getFont()->setBold(true)->setSize(16);
        $spreadsheet->getActiveSheet()->getStyle('A1:M3')->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getStyle('A1:M1')->getFont()->getColor()->setRGB('FFFFFF');
        $spreadsheet->getActiveSheet()->getStyle('A1:M1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('E74C3C');
        $spreadsheet->getActiveSheet()->getStyle('A3:M3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR)->getStartColor()->setARGB('B03A2E');
        $spreadsheet->getActiveSheet()->getStyle('A3:M3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR)->getEndColor()->setARGB('641E16');
        $spreadsheet->getActiveSheet()->getStyle('A3:M3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR)->setRotation(90);
        $spreadsheet->getActiveSheet()->getStyle('A3:M3')->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
        $spreadsheet->getActiveSheet()->getStyle('A3:M3')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
        $spreadsheet->getActiveSheet()->getStyle('A3:M3')->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle('A3:M3')->getAlignment()->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle('A3:M3')->getFont()->setBold(true)->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle('A3:M3')->getFont()->getColor()->setRGB('FFFFFF');
        $spreadsheet->getActiveSheet()->mergeCells('A1:M1');
        $spreadsheet->getActiveSheet()->freezePane('A2');
        $spreadsheet->getActiveSheet()->getStyle('F'.$i.'')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
        $spreadsheet->getActiveSheet()->getStyle('K'.$i.'')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);

        $i=$i+2;
        $spreadsheet->getActiveSheet()->setCellValue('H'.$i, 'Rentabilidad:');
        $spreadsheet->getActiveSheet()->getStyle('H'.$i.'')->getFont()->setBold(true)->setSize(12);
        $spreadsheet->getActiveSheet()->setCellValue('K'.$i, $total);
        $spreadsheet->getActiveSheet()->getStyle('K'.$i.'')->getFont()->setBold(true)->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle('K'.$i.'')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);


        $sheetIndex = $spreadsheet->getIndex(
            $spreadsheet->getSheetByName('Worksheet 1')
        );
        $spreadsheet->removeSheetByIndex($sheetIndex);


        // Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
        header('Cache-Control: max-age=0');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }else{
        print_r('No hay resultados para mostrar');
    }
?>