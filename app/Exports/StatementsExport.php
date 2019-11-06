<?php

namespace App\Exports;

use App\Statements;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;

class StatementsExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $stm;
    public function __construct($stm)
    {
        $this->stm = $stm;
    }

    public function array(): array
    {
        return $this->stm;
    }

    public function headings(): array
    {
        return [
            'Mã GD',
            'Khách hàng',
            'Nội dung',
            'Phuơng thức',
            'Số tiền',
            'Thời gian giao dịch',
            'Mục đích',
            'Trạng thái'
        ];
    }
}