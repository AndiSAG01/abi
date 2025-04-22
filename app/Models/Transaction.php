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
        'user_id',
        'cart_id',
        'item_id',
        'qty',
        'amount',
        'start_date',
        'end_date',
        'total_people',
        'status',
        'created_at',
        'updated_at'
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

    public function getTransactionsByCustomer($userId)
    {
        return $this->select('transactions.*, 
            users.username AS username, 
            tour.name AS tour_name, 
            tour.location AS tour_location, 
            tour.ticket AS tour_ticket,
            tour.image AS tour_image,
            GROUP_CONCAT(DISTINCT classifications.name ORDER BY classifications.name ASC) AS classification_names,
            GROUP_CONCAT(DISTINCT categories.name ORDER BY categories.name ASC) AS category_names,
            GROUP_CONCAT(DISTINCT items.name ORDER BY items.name ASC) AS items_names, 
            transactions.item_id,
            transactions.qty')
            ->join('carts', 'carts.id = transactions.cart_id', 'left')
            ->join('users', 'users.id = transactions.user_id', 'left')
            ->join('tour', 'tour.id = carts.tour_id', 'left')
            ->join('classifications', 'FIND_IN_SET(classifications.id, tour.classification)', 'left')
            ->join('categories', 'FIND_IN_SET(categories.id, tour.category)', 'left')
            ->join('items', 'FIND_IN_SET(items.id, transactions.item_id)', 'left')  // Perbaiki join agar sesuai dengan banyak ID
            ->where('transactions.user_id', $userId)
            ->groupBy('transactions.id')
            ->orderBy('transactions.created_at', 'DESC')
            ->findAll();
    }

    public function getCartByCustomer($userId)
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
            ->where('carts.user_id', $userId)
            ->groupBy('carts.id')
            ->findAll();
    }
    public function getCartBytransactions($userId)
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
            ->where('carts.user_id', $userId)
            ->groupBy('carts.id')
            ->first(); // Menggunakan first() agar hanya satu data yang diambil
    }

    public function getPayments($transactionId) 
    {
        return model('Payment')
            ->where('transaction_id', $transactionId)
            ->findAll();
    }

    
}
