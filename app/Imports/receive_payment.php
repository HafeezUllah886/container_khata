<?php

namespace App\Imports;

use App\Models\payment_categories;
use App\Models\receive_payments;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class receive_payment implements ToModel, WithHeadingRow
{
    protected $category_id;
    protected $bank_id;

    public function __construct($category_id, $bank_id)
    {
        $this->category_id = $category_id;
        $this->bank_id = $bank_id;
    }

    public function model(array $row)
    {
        $ref = getRef(); // Assuming this is a global helper function

        $category = payment_categories::find($this->category_id);
        $notes = "Category: $category->name - Notes: " . ($row['notes']);
        $date = \DateTime::createFromFormat('d-m-y', $row['date']);
if ($date) {
    $date = $date->format('Y-m-d');
} else {
    $date = $row['date']; // fallback if parsing fails
}
        $amount = str_replace(',', '', $row['amount']);
       
        // Log transaction before inserting payment row
        createTransaction($this->bank_id, $date, $amount, 0, $notes, $ref);

        return new receive_payments([
            'category_id' => $this->category_id,
            'bank_id' => $this->bank_id,
            'date' => $date,
            'amount' => $amount,
            'notes' => $notes,
            'refID' => $ref,
        ]);
    }
}
