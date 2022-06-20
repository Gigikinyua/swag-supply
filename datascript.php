<?php

require __DIR__ . '/functions.php';
require_once __DIR__ . '/assets/classes/PHPExcel.php';

ini_set('max_execution_time', '0');

$request = $_GET['request'];
$response = [];

try {
    if ($request == "place_orders") {
        $name = $_POST['name'];
        $color = $_POST['color'];
        $quantity = $_POST['quantity'];
        $county = $_POST['county'];
        $address = $_POST['address'];
        $names = $_POST['names'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $notes = $_POST['notes'];

        $filename = "order_details.xls";
        $excel = new PHPExcel();

        $excel->setActiveSheetIndex(0)
            ->setCellValue('A' . '1', "Product Name")
            ->setCellValue('B' . '1', $name)
            ->setCellValue('A' . '3', "Unit Price")
            ->setCellValue('B' . '3', "Ksh. 2500")
            ->setCellValue('A' . '4', 'Quantity')
            ->setCellValue('B' . '4', $quantity)
            ->setCellValue('A' . '5', 'Color')
            ->setCellValue('B' . '5', $color)
            ->setCellValue('A' . '6', 'County')
            ->setCellValue('B' . '6', $county . ", Kenya")
            ->setCellValue('A' . '7', 'Full Address')
            ->setCellValue('B' . '7', $address)
            ->setCellValue('A' . '8', 'Customer Name')
            ->setCellValue('B' . '8', $names)
            ->setCellValue('A' . '9', 'Customer Phone Number')
            ->setCellValue('B' . '9', $phone)
            ->setCellValue('A' . '10', 'Customer Email Address')
            ->setCellValue('B' . '10', $email)
            ->setCellValue('A' . '11', 'Order notes')
            ->setCellValue('B' . '11', $notes)
            ->setCellValue('A' . '13', 'Total')
            ->setCellValue('B' . '13', $_POST['total']);

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

        /*$hostname = "localhost";
        $database = "swag_supply";
        $username = "root";
        $password = "";

        // Create connection
        $conn = new mysqli($hostname, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Attempt insert query execution
        $sql = "INSERT INTO orders (name, color, quantity, county, address, customer_name, phone, email, notes) 
                    VALUES (" . $name . "," . $color . "," . $quantity . "," . $county . "," . $address . "," . $names .
                    "," . $phone . "," . $email . "," . $notes . ")";
        if(mysqli_query($conn, $sql)){
            echo "Records inserted successfully.";
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }

        // Close connection
        mysqli_close($conn);*/

    }
} catch (\Throwable $th) {
    echo myJsonResponse(400, $th->getMessage());
}

