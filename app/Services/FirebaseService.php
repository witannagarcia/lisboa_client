<?php

namespace App\Services;
use Kreait\Firebase\Factory;

class FirebaseService
{

    private $firebase;
    private $db;

    public function __construct()
    {
        $this->firebase = (new Factory)->withServiceAccount(base_path('lafinca-2370d-firebase-adminsdk-cd2b8-7165fe2213.json'));
        $this->db = $this->firebase->createDatabase();
    }

    public function getOrders()
    {
        $reference = $this->db->getReference('/orders');
        $orders = $reference->orderByKey()
        ->getSnapshot();
        return $orders;
    }

    public function saveOrder()
    {
        $order = $this->db->getReference('orders')->push(["user_id"=>"2", "status"=>"craedo"]);
        return $order->getKey();
    }

}