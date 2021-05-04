<?php
require 'vendor/autoload.php';
require "util/db.php";

$db = connectDB();
// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// header('Content-Disposition: attachment; filename="lista_usuarios.xlsx"');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Id');
$sheet->setCellValue('B1', 'Full Name');
$sheet->setCellValue('C1', 'user Name');
$sheet->setCellValue('D1', 'Email');

$sql = "SELECT * FROM users";
$stmt = $db->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $key => $user){

    $sheet->setCellValue('A'.$key, $user['id']);
    $sheet->setCellValue('B'.$key, $user['full_name']);
    $sheet->setCellValue('C'.$key, $user['email']);
    $sheet->setCellValue('D'.$key, $user['user_name']);

}

$writer = new Xlsx($spreadsheet);
$writer->save('usuarios.xlsx');