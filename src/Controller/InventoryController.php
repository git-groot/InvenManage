<?php

namespace App\Controller;

use App\Services\InventoryServices;
use App\Utils\ApiResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InventoryController extends AbstractController
{
    #[Route('/inventory', name: 'app_inventory')]
    public function index(): Response
    {
        return $this->render('inventory/index.html.twig', [
            'controller_name' => 'InventoryController',
        ]);
    }
       // register
      
       #[Route("/api/register", name: "companyregister", methods: "POST")]
       public function company(Request $request, InventoryServices $loginService)
       {
           $Users = $loginService->_company($request);
           return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "Password"]);
       }
       
          // logo update
    #[Route('/logo/update/{id}', name: 'logoupdate', methods: 'POST')]
    public function logoUpdate($id, Request $request, InventoryServices $loginService)
    {
        $result = $loginService->_logoUpdate($id, $request);
        if ($result[0] == "error") {
            return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result[1], ['timezone']);
        }
        return new ApiResponse($result[1], 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
    // Login
    #[Route("/api/login", name: "usersLogin3", methods: "POST")]
    public function login(Request $request, InventoryServices $loginService)
    {
        $Users = $loginService->_login($request);
        return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "Password"]);
    }
    
     // post
     #[Route("/post/user", name: "saveusers", methods: "POST")]
     public function user(Request $request, InventoryServices $InventoryServices)
     {
         $Users = $InventoryServices->_user($request);
         return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "password"]);
     }
     // getsingle
     #[Route('/admin/getsingle/{id}', name: 'getSingleAdmin', methods: 'GET')]
     public function getSingleadmin($id, InventoryServices $InventoryServices)
     {
         $result = $InventoryServices->_getSingleadmin($id);
         if ($result == "invalid id") {
             return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
         }
         return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
     }
     // getAll
     #[Route("/getall/admin", name: "getalladmin", methods: "GET")]
     public function admingetall(InventoryServices $InventoryServices)
     {
         $Users = $InventoryServices->_admingetall();
         return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "password"]);
     }
     // delete
     #[Route('/admin/delete/{id}', name: 'deleteAdmin', methods: 'GET')]
     public function deleteadmin($id, InventoryServices $InventoryServices)
     {
         $result = $InventoryServices->_deleteadmin($id);
         if ($result == "invalid id") {
             return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
         }
         return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
     }
     //update
     #[Route('/admin/update/{id}', name: 'updateadmin', methods: 'POST')]
     public function updateadmin($id, Request $request, InventoryServices $InventoryServices)
     {
         $result = $InventoryServices->_updateadmin($id, $request);
         if ($result == "invalid id") {
             return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
         }
         return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
     }
     // post vendors
    #[Route("/post/vendors", name: "vendors", methods: "POST")]
    public function vendors(Request $request, InventoryServices $loginService)
    {
        $Users = $loginService->_vendors($request);
        return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "password"]);
    }
    // getsingle
    #[Route('/vendor/getsingle/{id}', name: 'getSinglevendor', methods: 'GET')]
    public function getSinglevendor($id, InventoryServices $LoginService)
    {
        $result = $LoginService->_getSinglevendor($id);
        if ($result == "invalid id") {
            return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
        }
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
    // getAll
    #[Route('/vendor/getall', name: 'getAllvendor', methods: 'GET')]
    public function getAllvendor(InventoryServices $loginService)
    {
        $result = $loginService->_getAllvendor();
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
    // delete
    #[Route('/vendor/delete/{id}', name: 'delete', methods: 'PUT')]
    public function deletevendor($id, InventoryServices $LoginService)
    {
        $result = $LoginService->_deletevendor($id);
        if ($result == "invalid vendor id") {
            return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
        }
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
    // update
    #[Route('/vendor/update/{id}', name: 'vendorupdate', methods: 'POST')]
    public function vendorUpdate($id, Request $request, InventoryServices $loginService)
    {
        $result = $loginService->_vendorUpdate($id, $request);
        if ($result == "error") {
            return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
        }
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
 
}
