<?php

namespace App\Services;

use App\Entity\RefCompany;
use App\Entity\User;
use App\Entity\Vendors;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class InventoryServices
{
    private $EM;
    public function __construct(EntityManagerInterface $EM)
    {
        $this->EM = $EM;
    }

    public function _company($request)
    {
        // register
        $filee = $request->files->get('Logo');
        $filname = $filee->getClientOriginalName();
        $filepath = "project/" . "/" . $filname;
        $upload = $filee->move("project/" . "/", $filname);

        $compna = $request->get('CompanyName');
        $comemail = $request->get('CompanyEmail');
        $comphone = $request->get('Phone');
        $comadd = $request->get('Address');
        // $comdist = $request->get('District');
        $comstat = $request->get('State');
        $compin = $request->get('Pincode');
        $pass = $request->get('Password');
        $encrypt = $this->encryptPassword($pass);

        $reg = new RefCompany;
        $reg->setLogo($filepath);
        $reg->setCompanyName($compna);
        $reg->setCompanyEmail($comemail);
        $reg->setPhone($comphone);
        $reg->setAddress($comadd);
        // $reg->setDistrict($comdist);
        $reg->setState($comstat);
        $reg->setPinCode($compin);
        $reg->setPassword($encrypt);

        $this->EM->persist($reg);
        $this->EM->flush();

        return $reg;
    }
    // updateLogo
    public function _logoUpdate($id, $request)
    {
        $comreo = $this->EM->getRepository(RefCompany::class);
        $uplogo = $comreo->findOneBy(['id' => $id]);
        if ($uplogo); {
            return 'invalide logo';
        }

        $filee = $request->files->get('Logo');
        $filname = $filee->getClientOriginalName();
        $filepath = "project/" . "/" . $filname;
        $upload = $filee->move("project/" . "/", $filname);

        $logo = $request->get('Logo');
        if ($logo) {
            $uplogo->setLogo($logo);
        }
        $this->EM->persist($uplogo);
        $this->EM->flush();
        return ['logo uploaded', $uplogo];
    }
    // login
    private $encryptionKey = 'YourEncryptionKey';
    public function _login($request)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, RefCompany::class, 'json');
        // return ;
        $repo = $this->EM->getRepository(RefCompany::class);
        $user = $repo->findOneBy(['CompanyEmail' => $data->getCompanyEmail()]);
        $passwordUser = $user->getPassword();
        $pass = $data->getPassword();
        $decryptedPassword = $this->decryptPassword($passwordUser);
        if ($decryptedPassword == $pass) {
            return $user;
        } else {
            return "invalide password";
        }
    }

    private function encryptPassword($password)
    {
        // Encrypt the password using AES encryption
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encryptedPassword = openssl_encrypt($password, 'aes-256-cbc', $this->encryptionKey, 0, $iv);
        return base64_encode($encryptedPassword . '::' . $iv);
    }

    private function decryptPassword($encryptedPassword)
    {
        // Decrypt the password using AES decryption
        list($encryptedPassword, $iv) = explode('::', base64_decode($encryptedPassword), 2);
        $decryptedPassword = openssl_decrypt($encryptedPassword, 'aes-256-cbc', $this->encryptionKey, 0, $iv);
        return $decryptedPassword;
    }
    // post User
    public function _user($request)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, User::class, 'json');
        $comrep = $this->EM->getRepository(RefCompany::class);
        $comid = $comrep->findOneBy(['id' => $data->getCompanyId()]);
        if ($comid == null) {
            return "invalide Company Id";
        }

        $adm = new User;
        $adm->setName($data->getName());
        $adm->setEmail($data->getEmail());
        $adm->setPhoneNo($data->getPhoneNo());
        $adm->setCompany($comid);
        $this->EM->persist($adm);
        $this->EM->flush();
        return $adm;
    }
    // getsingle
    public function _getSingleadmin($id)
    {
        $admrepo = $this->EM->getRepository(User::class);
        $admid = $admrepo->findOneBy(['id' => $id]);
        if ($admid == null) {
            return "invalide Admin Id";
        }
        return $admid;
    }
    // getAll
    public function _admingetall()
    {
        $admrepo = $this->EM->getRepository(User::class);
        $admall = $admrepo->findAll();
        return $admall;
    }
    // delete
    public function _deleteadmin($id)
    {
        $admrepo = $this->EM->getRepository(User::class);
        $admid = $admrepo->findOneBy(['id' => $id]);
        if ($admid == null) {
            return 'invalide admin id';
        }
        $this->EM->remove($admid);
        $this->EM->flush();
        return "delete sucessfully";
    }
    // update
    public function _updateadmin($id, $request)
    {

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, User::class, 'json');

        $admrepo = $this->EM->getRepository(User::class);
        $updadm = $admrepo->findOneBy(['id' => $id]);
        if ($updadm == null) {
            return 'inalide admin id';
        }

        $admname = $data->getName('Name');
        if ($admname) {
            $updadm->setName($admname);
        }
        $admemail = $data->getEmail('Email');
        if ($admemail) {
            $updadm->setEmail($admemail);
        }
        $admphone = $data->getPhoneNo('phoneNo');
        if ($admphone) {
            $updadm->setPhoneNo($admphone);
        }
        $quarep = $this->EM->getRepository(RefCompany::class);
        $compid = $quarep->findOneBy(['id' => $data->getCompanyId()]);
        if ($compid == null) {
            return 'invalide company id';
        }
        $updadm->setCompany($compid);

        $this->EM->persist($updadm);
        $this->EM->flush();
        return ['okk', $updadm];
    }
    // post vndors
    public function _vendors($request)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $content = $request->getContent();
        $data = $serializer->deserialize($content, Vendors::class, 'json');
        $comrepo = $this->EM->getRepository(RefCompany::class);
        $companyId = $comrepo->findOneBy(['id' => $data->getCompanyId()]);
        if ($companyId == null) {
            return 'invalide company Id';
        }
        $ven = new Vendors;
        $ven->setName($data->getName());
        $ven->setEmail($data->getEmail());
        $ven->setPhone($data->getPhone());
        $ven->setAddress($data->getAddress());
        $ven->setState($data->getState());
        //  $ven->setDistrict($data->getDistrict());
        $ven->setPinCode($data->getPinCode());
        $ven->setGSTno($data->getGSTno());
        $ven->setCompany($companyId);

        $this->EM->persist($ven);
        $this->EM->flush();

        return $ven;
    }
    // getsingle vendor 
    public function _getSinglevendor($id)
    {
        $venrepo = $this->EM->getRepository(Vendors::class);
        $venId = $venrepo->findOneBy(['id' => $id]);
        if ($venId == null) {
            return 'invalide vendors Id';
        }
        return $venId;
    }
    // getAll vendor
    public function _getAllvendor()
    {
        $venrepo = $this->EM->getRepository(Vendors::class);
        $venall = $venrepo->findAll();
        return $venall;
    }
    // delete vendor
    public function _deletevendor($id)
    {
        $venrepo = $this->EM->getRepository(Vendors::class);
        $del = $venrepo->findOneBy(['id' => $id]);
        if ($del == null) {
            return 'invalid Vendor id';
        }
        $this->EM->remove($del);
        $this->EM->flush();
        return 'Delete sucessfully';
    }
    // update vendor
    public function _vendorUpdate($id, $request)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, Vendors::class, 'json');
        // dd($data);
        $venrepo = $this->EM->getRepository(Vendors::class);
        $updobj = $venrepo->findOneBy(['id' => $id]);
        if ($updobj == null) {
            return 'Invalide Vendors Id';
        }

        $quarep = $this->EM->getRepository(RefCompany::class);
        $quaid = $quarep->findOneBy(['id' => $data->getCompanyId()]);
        if ($quaid == null) {
            return 'invalide company id';
        }
        $updobj->setCompany($quaid);

        $vendorname = $data->getName('Name');
        if ($vendorname) {
            $updobj->setName($vendorname);
        }
        $vendoremail = $data->getEmail('Email');
        if ($vendoremail) {
            $updobj->setEmail($vendoremail);
        }
        $vendorphone = $data->getPhone('Phone');
        if ($vendorphone) {
            $updobj->setPhone($vendorphone);
        }
        $vendoradd = $data->getAddress('Address');
        if ($vendoradd) {
            $updobj->setAddress($vendoradd);
        }
        $vendorstate = $data->getState('State');
        if ($vendorstate) {
            $updobj->setState($vendorstate);
        }

        $vendorpin = $data->getPinCode('PinCode');
        if ($vendorpin) {
            $updobj->setPinCode($vendorpin);
        }
        $vendorgst = $data->getGSTno('GSTno');
        if ($vendorgst) {
            $updobj->setGSTno($vendorgst);
        }

        $this->EM->persist($updobj);
        $this->EM->flush();
        return ["updated", $updobj];
    }
    
}
