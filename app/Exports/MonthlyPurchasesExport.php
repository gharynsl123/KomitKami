<?php

namespace App\Exports;

use App\Order;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MonthlyPurchasesExport implements FromView
{
    protected $monthlyPurchases;
    protected $months;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::all();
    }
    
    public function __construct($monthlyPurchases, $months)
    {
        $this->monthlyPurchases = $monthlyPurchases;
        $this->months = $months;
    }

    public function view(): View
    {
        return view('exports.monthly_purchases', [
            'monthlyPurchases' => $this->monthlyPurchases,
            'months' => $this->months
        ]);
    }


}
