<?php
// filepath: /C:/laragon/www/auction/app/Exports/PurchasesExport.php
namespace App\Exports;

use App\Models\purchase;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PurchasesExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $start;
    protected $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function collection()
    {
        return Purchase::select('date','auction','loot','chassis','maker','model','year','price','ptax','afee','atax','transport_charges','recycle','total','yard','ddate','adate','number_plate','nvalidity','notes')
            ->whereBetween('date', [$this->start, $this->end])
            ->get();
    }

    public function headings(): array
    {
        return [
            'Purchase Date',
            'Auction',
            'Loot No.',
            'Chassis No.',
            'Maker',
            'Model',
            'Year',
            'Price',
            'Purchase Tax',
            'Auction Fee',
            'Auction Tax',
            'Transport Charges',
            'Recycle',
            'Total',
            'Yard',
            'Document Date',
            'Arrival Date',
            'Number Plate',
            'Number Validity',
            'Notes'
        ];
    }
}
