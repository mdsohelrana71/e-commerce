<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Blogs;

class BlogsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'Title',
            'Description',
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
