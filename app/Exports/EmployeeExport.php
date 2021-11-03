<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\products;

class EmployeeExport implements ShouldAutoSize, FromCollection, WithHeadings, WithEvents,WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return products::all();
    }
    public function headings(): array
    {
        return [
            'Tên Sản Phẩm',
            'Slug',
            'Mô Tả Ngăn',
            'Mô Tả Chi Tiết',
            'Gía Gốc',
            'Gía Sale',
            'Mã Sản Phẩm',
            'Tình Trình',
            'Đặc Tính',
            'Số Lượng',
            'Đã Bán',
            'Hình Ảnh',
            'Ảnh Phụ',
            'ID Danh mục',
            'Ngày Thêm',
            'Ngày Sửa',
            'ID Danh Mục Con'
        ];
    }
    public function columnWidths(): array
    {
        return [
            'G' => 45,
            'E' => 45,
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:P1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
            },
        ];

    }
}
