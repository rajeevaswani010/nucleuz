<?php
namespace App\Import;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

use App\Models\Pricing;
use Log;

class PricingImport implements ToCollection, WithHeadingRow, WithChunkReading, WithBatchInserts{
    public function collection(Collection $rows){
        foreach ($rows as $row){
            Log::debug("row car type: ".$row['car_type']);
            $CheckCode = Pricing::where("company_id", session("CompanyLinkID"))->where("car_type", $row['car_type'])->count();
            if($CheckCode == 0){
                $NewObj = new Pricing();
            }else{
                $NewObj = Pricing::where("company_id", session("CompanyLinkID"))->where("car_type", $row['car_type'])->first();
            }
            
            $NewObj->company_id = session("CompanyLinkID");
            $NewObj->car_type = $row['car_type'];
            $NewObj->daily_pricing = $row['daily_pricing'];
            $NewObj->monthly_pricing = $row['monthly_pricing'];
            $NewObj->weekly_pricing = $row['weekly_pricing'];

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