<?php

$data = $_POST['data'];

$filename = "order_details.xls";
$excel = new PHPExcel();


$excel->setActiveSheetIndex(0)
    ->setCellValue('A' . '1', "Product Name")
    ->setCellValue('B' . '1', $data["name"])
    ->setCellValue('A' . '3', "Unit Price")
    ->setCellValue('B' . '3', "Ksh. 2500")
    ->setCellValue('A' . '4', 'Quantity')
    ->setCellValue('B' . '4', $data['quantity'])
    ->setCellValue('A' . '5', 'Color')
    ->setCellValue('B' . '5', $data['color'])
    ->setCellValue('A' . '6', 'County')
    ->setCellValue('B' . '6', $data['county'] . ", Kenya")
    ->setCellValue('A' . '7', 'Full Address')
    ->setCellValue('B' . '7', $data['address'])
    ->setCellValue('A' . '8', 'Customer Name')
    ->setCellValue('B' . '8', $data['names'])
    ->setCellValue('A' . '9', 'Customer Phone Number')
    ->setCellValue('B' . '9', $data['phone'])
    ->setCellValue('A' . '10', 'Customer Email Address')
    ->setCellValue('B' . '10', $data['email'])
    ->setCellValue('A' . '11', 'Order notes')
    ->setCellValue('B' . '11', $data['notes'])
    ->setCellValue('A' . '13', 'Total')
    ->setCellValue('B' . '13', $data['total']);

$excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(50);


//this is for MS Office Excel 2007 xlsx format
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="order_details.xls"');

//this is for MS Office Excel 2003 xls format
//header('Content-Type: application/vnd.ms-excel');
//header('Content-Disposition: attachment; filename="test.xlsx"');
header('Cache-Control: max-age=0');

//write the result to a file
//for excel 2007 format
$file = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');

//for excel 2003 format
$file = PHPExcel_IOFactory::createWriter($excel, 'Excel5');

//output to php output instead of filename
$file->save($filename);