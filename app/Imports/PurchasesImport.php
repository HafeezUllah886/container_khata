<?php
// filepath: /C:/laragon/www/auction/app/Imports/PurchasesImport.php
namespace App\Imports;

use App\Models\purchase;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PurchasesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $check = purchase::where('chassis', $row['chassis_no'])->first();
        if ($check) {
            return null;
        }
        return new purchase([
            'year' => $row['year'],
            'model' => $row['model'],
            'maker' => $row['maker'],
            'chassis' => $row['chassis_no'],
            'loot' => $row['loot_no'],
            'yard' => $row['yard'],
            'date' => $this->transformDate($row['p_date']),
            'auction' => $row['auction'],
            'price' => $row['price'],
            'ptax' => $row['p_tax'],
            'afee' => $row['auction_fee'],
            'atax' => $row['fee_tax'],
            'transport_charges' => $row['transport_charges'],
            'total' => $row['total'],
            'recycle' => $row['recycle'],
            'adate' => $this->transformDate($row['arrival_date']),
            'ddate' => $this->transformDate($row['document_date']),
            'number_plate' => $row['number_plate'],
            'nvalidity' => $row['number_plate_validity'],
            'notes' => $row['notes'],
            'refID' => getRef(),
        ]);
    }

    private function transformDate($date)
    {
        if (empty($date)) {
            return null; // Return null for empty or null dates
        }
        // Check if the date is numeric (Excel's date format)
        if (is_numeric($date)) {
            return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date));
        }
        // Otherwise, attempt to parse a normal date string
        return Carbon::parse($date);
    }
}
