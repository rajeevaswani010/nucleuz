<?php
namespace App\Import;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

use App\Models\Brand;

class BrandImport implements ToCollection, WithHeadingRow, WithChunkReading, WithBatchInserts{
    public function collection(Collection $rows){
        foreach ($rows as $row){
            $CheckCode = Brand::where("name", $row['name'])->count();
            if($CheckCode == 0){
                $NewObj = new Brand();
            }else{
                $NewObj = Brand::where("name", $row['name'])->first();
            }
            
            $NewObj->name = $row['name'];
            $NewObj->save();
        }
    }
    
    public function batchSize(): int{
        return 1000;
    }
    
    public function chunkSize(): int{
        return 1000;
    }
}
?>