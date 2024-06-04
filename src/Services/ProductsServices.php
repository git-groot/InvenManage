<?php

namespace App\Services;

use App\Entity\Customer;
use App\Entity\Inventory;
use App\Entity\Product;
use App\Entity\Products;
use App\Entity\QuantityType;
use App\Entity\RefCompany;
use App\Utils\ApiResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;



class ProductsServices
{
    private $EM;

    public function __construct(EntityManagerInterface $EM)
    {
        $this->EM = $EM;
    }

    // Add product
    public function _Product($request)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, Products::class, 'json');
        $dataqua = $serializer->deserialize($content, QuantityType::class, 'json');
        $datainv = $serializer->deserialize($content, Inventory::class, 'json');

        $comrep = $this->EM->getRepository(RefCompany::class);
        $comid = $comrep->findOneBy(['id' => $data->getCompanyId()]);
        if ($comid == null) {
            return "invalide Company Id";
        }
       
        $pro = new Products;
        $pro->setName($data->getName());
        $pro->setDescription($data->getDescription());
        $pro->setHSFCcode($data->getHSFCcode());
        $pro->setStatus($data->getStatus());
        $pro->setCompany($comid);

        $this->EM->persist($pro);
        $this->EM->flush();

        $quat = new QuantityType;
        $quat->setName($dataqua->getName());
        $quat->setMesaarMent($dataqua->getMesaarMent());
        $quat->setUnits($dataqua->getUnits());
        $quat->setStatus($dataqua->getStatus());                   
        $quat->setPrice($dataqua->getPrice());
        $quat->setProduct($pro);
        $this->EM->persist($quat);
        $this->EM->flush();


        $inv = new Inventory;
        $inv->setQuantity($datainv->getQuantity());
        $inv->setBuyingPrice($datainv->getBuyingPrice());
        $inv->setSellingPrice($datainv->getSellingPrice());
        $inv->setProduct($pro);
        $inv->setQuantityType($quat);
        $inv->setCompany($comid);
        $this->EM->persist($inv);
        $this->EM->flush();
        return $pro;
    }
    // getsingle
    public function _getSingleProduct($id)
    {

        $admrepo = $this->EM->getRepository(Products::class);
        $proid = $admrepo->findOneBy(['id' => $id]);
        if ($proid == null) {
            return "invalide product Id";
        }
        return $proid;
    }
    // getAll
    public function _productgetall()
    {
        $admrepo = $this->EM->getRepository(Products::class);
        $proall = $admrepo->findAll();
        return $proall;
    }
    //  update product
    public function _updateproduct($id, $request)
    {

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, Products::class, 'json');

        $prorepo = $this->EM->getRepository(Products::class);
        $updpro = $prorepo->findOneBy(['id' => $id]);
        if ($updpro == null) {
            return 'inalide admin id';
        }
        $proname = $data->getName("Name");
        if ($proname) {
            $updpro->setName($proname);
        }
        $prostatus = $data->getStatus('Status');
        if ($prostatus) {
            $updpro->setStatus($prostatus);
        }
        $prohsfc = $data->getHSFCcode('HSFCcode');
        if ($prohsfc) {
            $updpro->setHSFCcode($prohsfc);
        }
        $proquan = $data->getQuantity('Quantity');
        if ($proquan) {
            $updpro->setQuantity($proquan);
        }
        $promes = $data->getMesarement('Mesarement');
        if ($promes) {
            $updpro->setMesarement($promes);
        }
        $prounit = $data->getUnits('Units');
        if ($prounit) {
            $updpro->setUnits($prounit);
        }
        $probuy = $data->getBuyingPrice('BuyingPrice');
        if ($probuy) {
            $updpro->setBuyingPrice($probuy);
        }
        $prosell = $data->getSellingPrice('SellingPrice');
        if ($prosell) {
            $updpro->setSellingPrice($prosell);
        }
        $company = $this->EM->getRepository(RefCompany::class)->find($data->getCompanyId());
        if ($company) {
            $updpro->setCompany($company);
        }

        $this->EM->persist($updpro);
        $this->EM->flush();
        return ['updated', $updpro];
    }

    // getsingle inventory
    public function _getSingleInventory($id)
    {

        $admrepo = $this->EM->getRepository(Inventory::class);
        $proid = $admrepo->findOneBy(['id' => $id]);
        if ($proid == null) {
            return "invalide product Id";
        }
        return $proid;
    }
    // getAll
    public function _inventorygetall()
    {
        $admrepo = $this->EM->getRepository(Inventory::class);
        $proall = $admrepo->findAll();
        return $proall;
    }
    // update inventory
    public function _updateinventory($id, $request)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, Inventory::class, 'json');

        $invenrepo = $this->EM->getRepository(Inventory::class);
        $updinven = $invenrepo->findOneBy(['id' => $id]);
        if ($updinven == null) {
            return 'invalide inventory id';
        }

        $quan = $data->getQuantity('Quantity');
        if ($quan) {
            $updinven->setQuantity($quan);
        }
        $buypri = $data->getBuyingPrice('BuyingPrice');
        if ($buypri) {
            $updinven->setBuyingPrice($buypri);
        }
        $sellpri = $data->getSellingPrice('SellingPrice');
        if ($sellpri) {
            $updinven->setSellingPrice($sellpri);
        }

        $productid = $this->EM->getRepository(Products::class)->find($data->getProductId());
        $updinven->setProduct($productid);
        $this->EM->persist($updinven);
        $this->EM->flush();
        return ['updated', $updinven];
    }
    // post customer
    public function _Customer($request)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, Customer::class, 'json');

        $comrep = $this->EM->getRepository(RefCompany::class);
        $comid = $comrep->findOneBy(['id' => $data->getCompanyId()]);
        if ($comid == null) {
            return "invalide Company Id";
        }
        $cust = new Customer;
        $cust->setCompany($comid);
        $cust->setName($data->getName());
        $cust->setPhone($data->getPhone());
        $cust->setAddress($data->getAddress());
        $cust->setState($data->getState());

        $this->EM->persist($cust);
        $this->EM->flush();
        return $cust;
    }
    // getsingle cus
    public function _getSingleCustomer($id)
    {
        $admrepo = $this->EM->getRepository(Customer::class);
        $proid = $admrepo->findOneBy(['id' => $id]);
        if ($proid == null) {
            return "invalide product Id";
        }
        return $proid;
    }
    // getAll cus
    public function _Customergetall()
    {
        $admrepo = $this->EM->getRepository(Customer::class);
        $proall = $admrepo->findAll();
        return $proall;
    }
    // delete
    public function _deletecustomer($id)
    {
        $venrepo = $this->EM->getRepository(Customer::class);
        $del = $venrepo->findOneBy(['id' => $id]);
        if ($del == null) {
            return 'invalid Customer id';
        }
        $this->EM->remove($del);
        $this->EM->flush();
        return 'Delete sucessfully';
    }
    // update
    public function _updatecustomer($id, $request)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, Customer::class, 'json');

        $cusrepo = $this->EM->getRepository(Customer::class);
        $updcus = $cusrepo->findOneBy(['id' => $id]);
        if ($updcus == null) {
            return "invalide product Id";
        }

        $cusname = $data->getName('Name');
        if ($cusname) {
            $updcus->setName($cusname);
        }
        $cuspho = $data->getPhone('Phone');
        if ($cuspho) {
            $updcus->setPhone($cuspho);
        }
        $cusadd = $data->getAddress('Address');
        if ($cusadd) {
            $updcus->setAddress($cusadd);
        }
        $cussta = $data->getState('State');
        if ($cussta) {
            $updcus->setState($cussta);
        }
        $company = $this->EM->getRepository(RefCompany::class)->find($data->getCompanyId());
        $updcus->setCompany($company);

        $this->EM->persist($updcus);
        $this->EM->flush();
        return ['updaeted', $updcus];
    }
    // addquantity
    public function _Quantitytype($request)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, QuantityType::class, 'json');

        $cusrepo = $this->EM->getRepository(Products::class);
        $procus = $cusrepo->findOneBy(['id' => $data->getProductId()]);
        if ($procus == null) {
            return "invalide product Id";
        }

        $qunty = new QuantityType;
        $qunty->setName($data->getName());
        $qunty->setMesaarMent($data->getMesaarMent());
        $qunty->setUnits($data->getUnits());
        $qunty->setPrice($data->getPrice());
        $qunty->setStatus($data->getStatus());
        $qunty->setProduct($data->getProductId());
        $this->EM->persist($qunty);
        $this->EM->flush();
        return $qunty;
    }

    // public function createQuantityType( $request)
    // {
    //     $content = $request->getContent();
    //     $data = $this->SE->deserialize($content, QuantityType::class, 'json');

    //     $productRepo = $this->EM->getRepository(Products::class);
    //     $product = $productRepo->find($data->getProductId());

    //     if ($product === null) {
    //         return ['error' => 'Invalid product ID'];
    //     }

    //     $quantityType = new QuantityType();
    //     $quantityType->setName($data->getName());
    //     $quantityType->setMesaarMent($data->getMesaarMent());
    //     $quantityType->setUnits($data->getUnits());
    //     $quantityType->setPrice($data->getPrice());
    //     $quantityType->setStatus($data->getStatus());
    //     $quantityType->setProduct($product);

    //     $this->EM->persist($quantityType);
    //     $this->EM->flush();

    //     return $quantityType;
    // }
}
