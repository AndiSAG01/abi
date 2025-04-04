<?php

namespace App\Models;

use CodeIgniter\Model;

class Transaction extends Model
{
    protected $table            = 'transactions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'customer_id',
        'cart_id',
        'item_id',
        'qty',
        'amount',
        'start_date',
        'end_date',
        'total_people',
        'status'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getTransactionsByCustomer($customerId)
    {
        return $this->select('transactions.*, 
        customers.name AS customer_name, 
        tour.name AS tour_name, 
        tour.location AS tour_location, 
        tour.ticket AS tour_ticket,
        tour.image AS tour_image,
        GROUP_CONCAT(DISTINCT classifications.name ORDER BY classifications.name ASC) AS classification_names,
        GROUP_CONCAT(DISTINCT categories.name ORDER BY categories.name ASC) AS category_names,
        carts.id AS cart_id')
            ->join('carts', 'carts.id = transactions.cart_id', 'left')
            ->join('customers', 'customers.id = transactions.customer_id', 'left')
            ->join('tour', 'tour.id = carts.tour_id', 'left')
            ->join('classifications', 'FIND_IN_SET(classifications.id, tour.classification)', 'left')
            ->join('categories', 'FIND_IN_SET(categories.id, tour.category)', 'left')
            ->where('transactions.customer_id', $customerId)
            ->groupBy('transactions.id')
            ->orderBy('transactions.created_at', 'DESC')
            ->findAll();
    }

    public function getCartByCustomer($customerId)
    {
        $cartModel = new Cart();

        return $cartModel->select('carts.*, carts.tour_id, 
            tour.name AS tour_name, 
            tour.location AS tour_location, 
            tour.ticket AS tour_ticket,
            tour.image AS tour_image,
            GROUP_CONCAT(DISTINCT classifications.name ORDER BY classifications.name ASC) AS classification_names,
            GROUP_CONCAT(DISTINCT categories.name ORDER BY categories.name ASC) AS category_names')
            ->join('tour', 'tour.id = carts.tour_id', 'left')
            ->join('classifications', 'FIND_IN_SET(classifications.id, tour.classification)', 'left')
            ->join('categories', 'FIND_IN_SET(categories.id, tour.category)', 'left')
            ->where('carts.customer_id', $customerId)
            ->groupBy('carts.id')
            ->findAll();
    }
    public function getCartBytransactions($customerId)
    {
        $cartModel = new Cart();

        return $cartModel->select('carts.*, carts.tour_id, 
        tour.name AS tour_name, 
        tour.location AS tour_location, 
        tour.ticket AS ticket_price,
        tour.image AS tour_image,
        GROUP_CONCAT(DISTINCT classifications.name ORDER BY classifications.name ASC) AS classification_names,
        GROUP_CONCAT(DISTINCT categories.name ORDER BY categories.name ASC) AS category_names')
            ->join('tour', 'tour.id = carts.tour_id', 'left')
            ->join('classifications', 'FIND_IN_SET(classifications.id, tour.classification)', 'left')
            ->join('categories', 'FIND_IN_SET(categories.id, tour.category)', 'left')
            ->where('carts.customer_id', $customerId)
            ->groupBy('carts.id')
            ->first(); // Menggunakan first() agar hanya satu data yang diambil
    }
}
