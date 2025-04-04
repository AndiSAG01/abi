<?php
namespace App\Validation;

class MyRules
{
    public function validateDateRange(string $endDate, string $fields, array $data): bool
    {
        $startDate = $data['start_date'] ?? null;

        if (!$startDate || strtotime($endDate) < strtotime($startDate)) {
            return false;
        }
        return true;
    }
}
