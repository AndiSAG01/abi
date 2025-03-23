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
        'tour_id',
        'item_id',
        'amount',
        'start_date',
        'end_date',
        'payment',
        'image',
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

    // Relasi ke tabel customers
    public function getTransactionWithUser()
    {
        return $this->select('transactions.*, customers.name AS customer_name')
            ->join('customers', 'customers.id = transactions.customer_id')
            ->findAll();
    }

    // Relasi ke tabel customers, tour, items
    public function getTransactionDetails($id)
    {
        return $this->select('transactions.*, 
                                customers.name AS customer_name, 
                                tour.name AS tour_name, 
                                items.name AS item_name')
            ->join('customers', 'customers.id = transactions.customer_id')
            ->join('tour', 'tour.id = transactions.tour_id')
            ->join('items', 'items.id = transactions.item_id', 'left') // Pakai left join biar item_id bisa null
            ->where('transactions.id', $id)
            ->first();
    }

    // Relasi lengkap untuk semua tabel
    public function getAllTransactions()
    {
        return $this->db->table('transactions')
            ->select('transactions.*, 
                 customers.name AS customer_name, 
                 tour.name AS tour_name, 
                 tour.location AS tour_location, 
                 tour.image AS tour_image,
                 GROUP_CONCAT(DISTINCT classifications.name ORDER BY classifications.name ASC) AS classification_names,
                 GROUP_CONCAT(DISTINCT categories.name ORDER BY categories.name ASC) AS category_names,
                 items.name AS item_name')
            ->join('customers', 'customers.id = transactions.customer_id')
            ->join('tour', 'tour.id = transactions.tour_id')
            ->join('items', 'items.id = transactions.item_id', 'left')
            ->join('classifications', 'FIND_IN_SET(classifications.id, tour.classification)', 'left')
            ->join('categories', 'FIND_IN_SET(categories.id, tour.category)', 'left')
            ->groupBy('transactions.id')
            ->orderBy('transactions.created_at', 'DESC')
            ->get()
            ->getResultArray();
    }
}
