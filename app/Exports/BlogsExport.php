<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\Blogs;

class BlogsExport implements FromCollection, WithHeadings, WithCustomCsvSettings, WithStyles{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'Title',
            'Description',
        ];
    }

    public function styles(Worksheet $sheet){
        return [
            'A' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
            'B' => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
        ];
    }

    public function getCsvSettings(): array{
        return [
            'delimiter' => '||',
        ];
    }

    public function collection()
    {
        return Blogs::where('status',1)->select('title', 'description')->get()->map(function ($blog) {
            $blog->description = strip_tags($blog->description);
            return $blog;
        });
    }
}
