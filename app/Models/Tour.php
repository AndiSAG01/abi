<?php

namespace App\Models;

use CodeIgniter\Model;

class Tour extends Model
{
    protected $table            = 'tour';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = ['name', 'location', 'ticket', 'information', 'information_detail', 'image', 'classification', 'category','status'];

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
    protected $validationRules = [];
    protected $validationMessages = [];
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

    // public function category()
    // {
    //     return $this->join('categories', 'categories.id = tours.id_category')
    //         ->select('tours.*, categories.name as category_name')
    //         ->findAll();
    // }

    // // Relasi dengan klasifikasi
    // public function classification()
    // {
    //     return $this->join('classifications', 'classifications.id = tours.id_classification')
    //         ->select('tours.*, classifications.name as classification_name')
    //         ->findAll();
    // }
    public function getTours()
    {
        return $this->db->table('tour')
            ->select('tour.*, GROUP_CONCAT(DISTINCT classifications.name ORDER BY classifications.name ASC) AS classification_names, GROUP_CONCAT(DISTINCT categories.name ORDER BY categories.name ASC) AS category_names')
            ->join('classifications', 'FIND_IN_SET(classifications.id, tour.classification)', 'left')
            ->join('categories', 'FIND_IN_SET(categories.id, tour.category)', 'left')
            ->groupBy('tour.id')
            ->get()
            ->getResultArray(); // Mengubah ke array asosiatif
    }
}
