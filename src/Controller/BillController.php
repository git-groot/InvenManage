<?php

namespace App\Controller;

use App\Services\BillServices;
use App\Utils\ApiResponse;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as WriterXlsx;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BillController extends AbstractController
{
    #[Route('/bill', name: 'app_bill')]
    public function index(): Response
    {
        return $this->render('bill/index.html.twig', [
            'controller_name' => 'BillController',
        ]);
    }
    #[Route("/api/bill/gend", name: "billaddsale", methods: "POST")]
    public function billStore(Request $request, BillServices $BillServices)
    {
        $Users = $BillServices->_billStore($request);
        return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "password"]);
    }

    // fliter
    #[Route("/api/filter", name: "fliterApi", methods: "POST")]
    public function FilterApi(Request $request, BillServices $BillServices)
    {
        $Users = $BillServices->_FilterApi($request);
        return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "password"]);
    }

    // XL gen

    #[Route("/api/xlgeneration", name: "xlgen", methods: "POST")]
    public function Excelgeneraion(Request $request, BillServices $BillServices)
    {
        $excelData = $BillServices->_Excelgeneraion($request);
        if ($excelData == null) {
            return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $excelData, ['timezone']);
        }
      //  return new ApiResponse($excelData, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "password"]);


        $row = 1;
        // Generate Excel file
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();


        // Add headers
        $sheet->setCellValue('A1', 'Product Name');
        $sheet->setCellValue('B1', 'Hsncode');
        $sheet->setCellValue('D1', 'Quantity');
        $sheet->setCellValue('C1', 'Unit price');
        $sheet->setCellValue('E1', 'Total price');
        $sheet->setCellValue('F1', 'CustomerNO');
        $row ++;
       


        foreach ($excelData as $row_data) {
         
            $productid = $row_data->getProduct()->getName() ;
        
            $hsn = $row_data->getHsncode() ? $row_data->getHsncode() : 'NA';
            $quantity = $row_data->getQuantitys() ? $row_data->getQuantitys() : 'NA';
            $price = $row_data->getUnitPrice() ? $row_data->getUnitPrice() : 'NA';
            $totalprice = $row_data->getTotalPrice() ? $row_data->getTotalPrice() : 'NA';
            $phoneNO = $row_data->getCustomerphoneno();

            $sheet->setCellValue('A' . $row, $productid);
            $sheet->setCellValue('B' . $row, $hsn);
            $sheet->setCellValue('C' . $row, $quantity);
            $sheet->setCellValue('D' . $row, $price);
            $sheet->setCellValue('E' . $row, $totalprice);
            $sheet->setCellValue('F' . $row, $phoneNO);
            $row++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="BILL.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new WriterXlsx($spreadsheet);
        $writer->save('php://output');
        return $spreadsheet;        
    }

}
