<?php

namespace App\Services;

use App\Entity\Customer;
use App\Entity\Inventory;
use App\Entity\Products;
use App\Entity\RefCompany;
use App\Entity\Sale;
use App\Entity\SaleItems;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class BillServices
{
    private $EM;
    public function __construct(EntityManagerInterface $EM)
    {
        $this->EM = $EM;
    }

    public function _billStore($request)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, Sale::class, 'json');
        $datas = $serializer->deserialize($content, SaleItems::class, 'json');

        $array = $datas->getVrray();
        // return $array;



        $comrep = $this->EM->getRepository(RefCompany::class);
        $comid = $comrep->findOneBy(['id' => $data->getcompanyId()]);
        if ($comid == null) {
            return "invalide Company Id";
        }
        $cusrep = $this->EM->getRepository(Customer::class);
        $cusid = $cusrep->findOneBy(['id' => $data->getcustomerId()]);
        if ($cusid == null) {
            return "invalid customer Id";
        }

        // $salerepo = $this->EM->getRepository(Sale::class);
        // $saleid = $salerepo->findOneBy(['id' => $datas->getSaleId()]);
        // if ($saleid == null) {
        //     return "invalide sale Id";
        // }

        $sale = new Sale;
        $sale->setCompany($comid);
        $sale->setCustomer($cusid);
        $phone = $cusid->getPhone();
        $sale->setDateTime(new \DateTime());
        $dates = $sale->getDateTime();
        $sale->setBeforeTax($data->getBeforeTax());
        $sale->setTotalTax($data->getTotalTax());
        $sale->setTotalAmount($data->getTotalAmount());
        $this->EM->persist($sale);
        $this->EM->flush();
        $productIds = [];
        foreach ($array as $arrayObj) {


            $prodrepo = $this->EM->getRepository(Products::class);
            $prodid = $prodrepo->findOneBy(['id' => $arrayObj['productId']]);
            if ($prodid == null) {
                return "invalide productsss Id";
            }
        
            $inverepo = $this->EM->getRepository(Inventory::class);
            $invenid = $inverepo->findOneBy([ 'Product' => $prodid]);
            if ($invenid == null) {
                return "invalide inventory Id";
            }

            $item = new SaleItems;
            $item->setSaleitem($sale);
            $item->setProduct($prodid);
            $item->setInventory($invenid);

            $item->setQuantitys($arrayObj['Quantitiys']);
            $item->setHsncode($arrayObj['HSNCode']);
            $item->setUnitPrice($invenid->getSellingPrice());
            $item->setCgst($arrayObj['CGST']);
            $item->setSgst($arrayObj['SGST']);
            $item->setTotalPrice($arrayObj['TotalPrice']);
            $item->setCustomerphoneno($phone);
            $item->setDate($dates);
            $item->setBuyingPrice($invenid->getBuyingPrice());
            $profit = $invenid->getSellingPrice() - $invenid->getBuyingPrice();
            $item->setProfit($profit);
            $this->EM->persist($item);
            $this->EM->flush();
            $quantity = $invenid->getQuantity() - $item->getQuantitys();
            $invenid->setQuantity($quantity);
            $this->EM->persist($invenid);
            $this->EM->flush();
            array_push($productIds, $item);
        }
        return $productIds;


        return $sale;
    }

    // filter
    // public function _FilterApi($request)
    // {
    //     $encoders = [new JsonEncoder()];
    //     $normalizers = [new DateTimeNormalizer(['datetime_format' => 'Y-m-d']), new ObjectNormalizer()];
    //     $serializer = new Serializer($normalizers, $encoders);
    //     $content = $request->getContent();

    //     try {
    //         $data = $serializer->deserialize($content, Sale::class, 'json');
    //     } catch (\Exception $e) {
    //         return new JsonResponse(['error' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
    //     }

    //     $custid = $data->getcustomerId();
    //     $date = $data->getDate();

    //     $query = "SELECT * FROM sale WHERE";
    //     $conditions = [];

    //     if ($custid) {
    //         $conditions[] = "customer_id = '$custid'";
    //     }
    //     if ($date) {
    //         $formattedDate = $date->format('Y-m-d'); // Assuming $date is a DateTime object
    //         $conditions[] = "date = '$formattedDate'";
    //     }

    //     if (count($conditions) > 0) {
    //         $query .= ' ' . implode(' AND ', $conditions);
    //     } else {
    //         $query = "SELECT * FROM sale"; // No conditions, get all records
    //     }

    //     $connection = $this->EM->getConnection();
    //     $stmt = $connection->executeQuery($query);
    //     $ArrayOfResults = $stmt->fetchAllAssociative();

    //     // Fetch Sale objects from the database using their IDs
    //     $sales = [];
    //     foreach ($ArrayOfResults as $result) {
    //         $sale = $this->EM->getRepository(Sale::class)->find($result['id']);
    //         if ($sale) {
    //             $sales[] = $sale;
    //         }
    //     }

    //     return $serializer->normalize($sales, null, ['groups' => 'sale']);

    // }

    public function _FilterApi($request)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, SaleItems::class, 'json');
        $dataas = $serializer->deserialize($content, Sale::class, 'json');
        $salerepo = $this->EM->getRepository(Sale::class);
        // return $data;
        $company = $data->getSaleId();
        $phoneNO = $data->getCustomerphoneno();
        $start = $dataas->getStartDates();


        $conn = $this->EM->getConnection();
        $result = $conn->executeQuery("SELECT * FROM sale_items WHERE customerphoneno= '$phoneNO' AND date='$start' ORDER BY date ")->fetchAll();

        return $result;
    }

    public function _Excelgeneraion($request)
    {

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, SaleItems::class, 'json');

        $startdate =$data->getstartDatees();
        $enddate = $data->getEndDatees();
        //return [$startdate,$enddate];
        $start = new DateTime($startdate);
        $end = new DateTime($enddate);

        $saltitrepo = $this->EM->getRepository(SaleItems::class);
      //  $saltitrepo = $this->filterLeaves($request);
        $salitemid = $saltitrepo->findByDate($start,$end);
        //$saleitem = $saltitrepo->findby
        if ($salitemid == null) {
            return 'invalide date';
        }

        return $salitemid;


    }
}
