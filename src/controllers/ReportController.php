<?php
namespace App\controllers;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../core/database.php';

use Fawno\FPDF\FawnoFPDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PDO;

class ReportController
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = \App\core\Database::connect();
    }

    public function generateReport()
    {

        $format = isset($_GET['format']) ? $_GET['format'] : 'pdf';
        
        $stmt = $this->pdo->prepare("SELECT 
            delivery_number, client_fullname, courier_fullname, delivery_city, delivery_street, delivery_house, 
            delivery_entrance, delivery_apartment, delivery_floor, delivery_intercome_code, delivery_date, delivery_price 
        FROM delivery d join client cl on d.client_id = cl.client_id join courier cr on d.courier_id = cr.courier_id where d.client_id = ?");
        $stmt->execute([$_SESSION['client_id']]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        switch ($format) {
            case 'pdf':
                $this->generatePdfReport($data);
                break;
            case 'excel':
                $this->generateExcelReport($data);
                break;
            default:
                http_response_code(400);
                echo "Неверный формат отчета. Доступные форматы: pdf, excel";
                exit;
        }
    }

    private function generatePdfReport(array $data)
    {
        $pdf = new FawnoFPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 10);

        $headers = [
            '№ доставки',
            'Клиент',
            'Курьер',
            'Город',
            'Улица',
            'Дом',
            'Подъезд',
            'Квартира',
            'Этаж',
            'Домофон',
            'Дата доставки',
            'Стоимость'
        ];

        $widths = [20, 30, 30, 20, 30, 15, 15, 15, 15, 20, 25, 20];

        foreach ($headers as $i => $header) {
            $pdf->Cell($widths[$i], 7, $header, 1);
        }
        $pdf->Ln();

        $pdf->SetFont('Arial', '', 9);
        foreach ($data as $row) {
            $pdf->Cell($widths[0], 6, $row['delivery_number'], 1);
            $pdf->Cell($widths[1], 6, $row['client_fullname'], 1);
            $pdf->Cell($widths[2], 6, $row['courier_fullname'], 1);
            $pdf->Cell($widths[3], 6, $row['delivery_city'], 1);
            $pdf->Cell($widths[4], 6, $row['delivery_street'], 1);
            $pdf->Cell($widths[5], 6, $row['delivery_house'], 1);
            $pdf->Cell($widths[6], 6, $row['delivery_entrance'], 1);
            $pdf->Cell($widths[7], 6, $row['delivery_apartment'], 1);
            $pdf->Cell($widths[8], 6, $row['delivery_floor'], 1);
            $pdf->Cell($widths[9], 6, $row['delivery_intercome_code'], 1);
            $pdf->Cell($widths[10], 6, $row['delivery_date'], 1);
            $pdf->Cell($widths[11], 6, number_format($row['delivery_price'], 2), 1, 0, 'R');
            $pdf->Ln();
        }

        $filename = 'delivery_report_' . date('Y-m-d') . '.pdf';
        $pdf->Output('D', $filename);
        exit;
    }

    private function generateExcelReport(array $data)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', '№ доставки');
        $sheet->setCellValue('B1', 'Клиент');
        $sheet->setCellValue('C1', 'Курьер');
        $sheet->setCellValue('D1', 'Город');
        $sheet->setCellValue('E1', 'Улица');
        $sheet->setCellValue('F1', 'Дом');
        $sheet->setCellValue('G1', 'Подъезд');
        $sheet->setCellValue('H1', 'Квартира');
        $sheet->setCellValue('I1', 'Этаж');
        $sheet->setCellValue('J1', 'Домофон');
        $sheet->setCellValue('K1', 'Дата доставки');
        $sheet->setCellValue('L1', 'Стоимость');

        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item['delivery_number']);
            $sheet->setCellValue('B' . $row, $item['client_fullname']);
            $sheet->setCellValue('C' . $row, $item['courier_fullname']);
            $sheet->setCellValue('D' . $row, $item['delivery_city']);
            $sheet->setCellValue('E' . $row, $item['delivery_street']);
            $sheet->setCellValue('F' . $row, $item['delivery_house']);
            $sheet->setCellValue('G' . $row, $item['delivery_entrance']);
            $sheet->setCellValue('H' . $row, $item['delivery_apartment']);
            $sheet->setCellValue('I' . $row, $item['delivery_floor']);
            $sheet->setCellValue('J' . $row, $item['delivery_intercome_code']);
            $sheet->setCellValue('K' . $row, $item['delivery_date']);
            $sheet->setCellValue('L' . $row, $item['delivery_price']);
            $row++;
        }

        foreach (range('A', 'L') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="delivery_report_' . date('Y-m-d') . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}