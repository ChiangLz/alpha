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
    #$uni= $_GET['uni'];
    $cliente=$_GET['cliente'];
    $fechaini= $_GET['fechaini'];
    $fechafin= $_GET['fechafin'];
    #echo " --suc: ".$valorsuc." --cliente: ".$cliente." --fechaini: ".$fechaini." --fechafin: ".$fechafin;

    $sql="SELECT unidades.nomuni, servicio.tipo, cliente.nomcli, cliente.razonsocial, orden_servicio.fecha_inicial, 
    orden_servicio.fecha_final, orden_servicio.costo, unidades.serie, orden_servicio.iduni 
    FROM orden_servicio 
    INNER JOIN cliente on cliente.id=orden_servicio.idcli 
    INNER JOIN unidades ON unidades.noserie=orden_servicio.iduni 
    INNER JOIN servicio on servicio.id=orden_servicio.idservi
    WHERE orden_servicio.idcli=$cliente 
    AND orden_servicio.idsucur=$valorsuc 
    AND orden_servicio.fecha_inicial  
    AND orden_servicio.fecha_inicial >= '$fechaini' AND orden_servicio.fecha_final <= '$fechafin'";

    $sqlmanto = "SELECT mantenimiento.id, unidades.nomuni, mantenimiento.tipo, mantenimiento.fecha_inicio, 
    mantenimiento.fecha_final, mantenimiento.gastos, mantenimiento.actividad, mantenimiento.descripcion 
    FROM mantenimiento 
    INNER JOIN unidades ON unidades.noserie=mantenimiento.idunid
    WHERE mantenimiento.fecha_inicial BETWEEN '$fechaini' AND '$fechafin' AND mantenimiento.fecha_final BETWEEN '$fechaini' AND '$fechafin'";
  
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

        $nombreDelDocumento = "Rentabilidad_Cliente.xlsx";
        $tituloReporte = "Reporte de Rentabilidad - Cliente";
    
        //HOJA DE DETALLE
        //Envabezados
        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()
            ->setTitle('Rentabilidad Cliente')
            ->setCellValue('A1', $tituloReporte)
            ->setCellValue('A3', 'NOMBRE CLIENTE')
            ->setCellValue('B3', 'RAZÓN SOCIAL')
            ->setCellValue('C3', 'TIPO')
            ->setCellValue('D3', 'FECHA INICAL')
            ->setCellValue('E3', 'FECHA FINAL')
            ->setCellValue('F3', 'INGRESO')
            ->setCellValue('G3', 'UNIDAD')
            ->setCellValue('H3', 'SERIE')
            ->setCellValue('I3', 'UNIDAD')
            ->setCellValue('J3', 'TIPO')
            ->setCellValue('K3', 'GASTOS')
            ->setCellValue('L3', 'ACTIVIDAD')
            ->setCellValue('M3', 'FECHA INICIAL')
            ->setCellValue('N3', 'FECHA FINAL')
            ->setCellValue('O3', 'COMENTARIOS');
        
        $totalIng=0;
        $i=4;//Numero de fila donde se va a comenzar a rellenar
        //Impresion de datos desde la base
        while ($row1=mysqli_fetch_array($resultado)) {
            $spreadsheet->getActiveSheet()
                ->setCellValue('A'.$i, $row1['nomcli'])
                ->setCellValue('B'.$i, $row1['razonsocial'])
                ->setCellValue('C'.$i, $row1['tipo'])
                ->setCellValue('D'.$i, $row1['fecha_inicial'])
                ->setCellValue('E'.$i, $row1['fecha_final'])
                ->setCellValue('F'.$i, $row1['costo'])
                ->setCellValue('G'.$i, $row1['nomuni'])
                ->setCellValue('H'.$i, $row1['serie']);


            $spreadsheet->getActiveSheet()->getStyle('A'.$i.'')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('B'.$i.'')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('C'.$i.'')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('D'.$i.'')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('E'.$i.'')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('F'.$i.'')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('G'.$i.'')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('H'.$i.'')->getAlignment()->setHorizontal('center');
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
                    ->setCellValue('I'.$k, $row2['nomuni'])
                    ->setCellValue('J'.$k, $row2['tipo'])
                    ->setCellValue('K'.$k, $row2['fecha_inicio'])
                    ->setCellValue('L'.$k, $row2['fecha_final'])
                    ->setCellValue('M'.$k, $row2['gastos'])
                    ->setCellValue('N'.$k, $row2['actividad'])
                    ->setCellValue('O'.$k, $row2['descripcion']);


                $spreadsheet->getActiveSheet()->getStyle('I'.$k.'')->getAlignment()->setHorizontal('center');
                $spreadsheet->getActiveSheet()->getStyle('J'.$k.'')->getAlignment()->setHorizontal('center');
                $spreadsheet->getActiveSheet()->getStyle('K'.$k.'')->getAlignment()->setHorizontal('center');
                $spreadsheet->getActiveSheet()->getStyle('L'.$k.'')->getAlignment()->setHorizontal('center');
                $spreadsheet->getActiveSheet()->getStyle('M'.$k.'')->getAlignment()->setHorizontal('center');
                $spreadsheet->getActiveSheet()->getStyle('N'.$k.'')->getAlignment()->setHorizontal('center');
                $spreadsheet->getActiveSheet()->getStyle('O'.$k.'')->getAlignment()->setHorizontal('center');
                $spreadsheet->getActiveSheet()->getStyle('M'.$k.'')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER );
                $k++;
                $aux = str_replace(",","",$row2['gastos']);
                $totalGastos= $totalGastos +  floatval($aux);
            }
        }
        ob_end_clean();
        ob_start();
        $renta=$totalIng-$totalGastos;
        $i++;
        $spreadsheet->getActiveSheet()->setCellValue('C'.$i, 'Ingresos del '.$fechaini.' al '.$fechafin);
        $spreadsheet->getActiveSheet()->mergeCells('C'.$i.':E'.$i);
        $spreadsheet->getActiveSheet()->setCellValue('F'.$i,$totalIng,2);
        $spreadsheet->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
        $spreadsheet->getActiveSheet()->getStyle('F'.$i)->getFont()->setBold(true)->setSize(12);

        $spreadsheet->getActiveSheet()->setCellValue('I'.$i, 'Egresos del '.$fechaini.' al '.$fechafin);
        $spreadsheet->getActiveSheet()->mergeCells('I'.$i.':L'.$i);
        $spreadsheet->getActiveSheet()->setCellValue('M'.$i,$totalGastos,2);
        $spreadsheet->getActiveSheet()->getCell('M'.$i)->getCalculatedValue();
        $spreadsheet->getActiveSheet()->getStyle('M'.$i)->getFont()->setBold(true)->setSize(12);
       
    
        $spreadsheet->getActiveSheet()->getStyle('A1:O1')->getFont()->setBold(true)->setSize(16);
        $spreadsheet->getActiveSheet()->getStyle('A1:O3')->getAlignment()->setHorizontal('center');
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
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getStyle('A1:O1')->getFont()->getColor()->setRGB('FFFFFF');
        $spreadsheet->getActiveSheet()->getStyle('A1:O1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('E74C3C');
        $spreadsheet->getActiveSheet()->getStyle('A3:O3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR)->getStartColor()->setARGB('B03A2E');
        $spreadsheet->getActiveSheet()->getStyle('A3:O3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR)->getEndColor()->setARGB('641E16');
        $spreadsheet->getActiveSheet()->getStyle('A3:O3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR)->setRotation(90);
        $spreadsheet->getActiveSheet()->getStyle('A3:O3')->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
        $spreadsheet->getActiveSheet()->getStyle('A3:O3')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
        $spreadsheet->getActiveSheet()->getStyle('A3:O3')->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle('A3:O3')->getAlignment()->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle('A3:O3')->getFont()->setBold(true)->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle('A3:O3')->getFont()->getColor()->setRGB('FFFFFF');
        $spreadsheet->getActiveSheet()->mergeCells('A1:O1');
        $spreadsheet->getActiveSheet()->freezePane('A2');
        $spreadsheet->getActiveSheet()->getStyle('F'.$i.'')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
        $spreadsheet->getActiveSheet()->getStyle('M'.$i.'')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
        $i=$i+2;
        $spreadsheet->getActiveSheet()->setCellValue('L'.$i, 'Rentabilidad:');
        $spreadsheet->getActiveSheet()->getStyle('L'.$i.'')->getFont()->setBold(true)->setSize(12);
        $spreadsheet->getActiveSheet()->setCellValue('M'.$i, $renta);
        $spreadsheet->getActiveSheet()->getStyle('M'.$i.'')->getFont()->setBold(true)->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle('M'.$i.'')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);


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