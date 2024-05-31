<?php

namespace App\Traits;

use Illuminate\Http\Request;
use League\Csv\Reader;

trait ApiTrait {
    public function getCsv(Request $request)
    {
        $file = $request->file('csv');
        $csv = Reader::createFromPath($file->path(), 'r');
        $csv->setHeaderOffset(0);

        // $header = $csv->getHeader();
        $records = $csv->getRecords();

        return $records;
    }
}
