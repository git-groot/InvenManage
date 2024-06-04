<?php

namespace App\Controller;

use App\Services\ProductsServices;
use App\Utils\ApiResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductsController extends AbstractController
{
    #[Route('/products', name: 'app_products')]
    public function index(): Response
    {
        return $this->render('products/index.html.twig', [
            'controller_name' => 'ProductsController',
        ]);
    }
    // Product add
    #[Route("/api/Products", name: "Productadd", methods: "POST")]
    public function Product(Request $request, ProductsServices $ProductServices)
    {
        $Users = $ProductServices->_Product($request);
        return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "password"]);
    }
    // getsingle product
    #[Route('/product/getsingle/{id}', name: 'getSingleproduct', methods: 'GET')]
    public function getSingleProduct($id, ProductsServices $ProductsServices)
    {
        $result = $ProductsServices->_getSingleProduct($id);
        if ($result == "invalid id") {
            return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
        }
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
    //  getall
    #[Route("/getall/product", name: "getallproduct", methods: "GET")]
    public function productgetall(ProductsServices $ProductsServices)
    {
        $Users = $ProductsServices->_productgetall();
        return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "password"]);
    }
    //update
    #[Route('/update/product/{id}', name: 'updateproduct', methods: 'POST')]
    public function updateproduct($id, Request $request, ProductsServices $ProductsServices)
    {
        $result = $ProductsServices->_updateproduct($id, $request);
        if ($result == "invalid id") {
            return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
        }
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
    // getsingle inventoy
    #[Route('/inventory/getsingle/{id}', name: 'getSingleinventory', methods: 'GET')]
    public function getSingleInventory($id, ProductsServices $ProductsServices)
    {
        $result = $ProductsServices->_getSingleInventory($id);
        if ($result == "invalid id") {
            return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
        }
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
    //  getall inventory
    #[Route("/inventory/getall", name: "getallinventory", methods: "GET")]
    public function inventorygetall(ProductsServices $ProductsServices)
    {
        $Users = $ProductsServices->_inventorygetall();
        return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "password"]);
    }
    // update inventory
    #[Route('/api/inventory/update/{id}', name: 'updateinventory', methods: ['POST'])]
    public function updateinventory($id, Request $request, ProductsServices $ProductsServices)
    {
        $result = $ProductsServices->_updateinventory($id, $request);
        if ($result == "invalide inventory id") {
            return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
        }
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
    // Add Customer
    #[Route("/add/Customer", name: "AddCustomer", methods: "POST")]
    public function Customer(Request $request, ProductsServices $ProductServices)
    {
        $Users = $ProductServices->_Customer($request);
        return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "password"]);
    }
    // getsingle cus
    #[Route('/Customer/getsingle/{id}', name: 'getSingleinventory', methods: 'GET')]
    public function getSingleCustomer($id, ProductsServices $ProductsServices)
    {
        $result = $ProductsServices->_getSingleCustomer($id);
        if ($result == "invalid id") {
            return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
        }
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
    // geet all cus
    #[Route("/customer/getall", name: "getallCustomer", methods: "GET")]
    public function Customergetall(ProductsServices $ProductsServices)
    {
        $Users = $ProductsServices->_Customergetall();
        return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "password"]);
    }
    // delete
    #[Route('/customer/delete/{id}', name: 'deletecustomer', methods: 'GET')]
    public function deletecustomer($id, ProductsServices $ProductsServices)
    {
        $result = $ProductsServices->_deletecustomer($id);
        if ($result == "invalid id") {
            return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
        }
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
    // update cus
    #[Route('/customer/update/{id}', name: 'updatecustomer', methods: ['POST'])]
    public function updatecustomer($id, Request $request, ProductsServices $ProductsServices)
    {
        $result = $ProductsServices->_updatecustomer($id, $request);
        if ($result == "invalide inventory id") {
            return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
        }
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
     // quantity add
     #[Route("/api/quantitytype", name: "quantitytpeadd", methods: "POST")]
     public function Quantitytype(Request $request, ProductsServices $ProductServices)
     {
         $Users = $ProductServices->_Quantitytype($request);
         return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "password"]);
     }

    //  #[Route("/api/quantype/api", name: "quantitytpeaddapicreate", methods: "POST")]
    //  public function createQuantityType(Request $request, ProductsServices $ProductServices)
    //  {
    //      $Users = $ProductServices->createQuantityType($request);
    //      return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "password"]);
    //  }

}
