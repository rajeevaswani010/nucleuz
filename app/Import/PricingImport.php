<?php
namespace App\Import;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

use App\Models\Pricing;
use App\Models\CarType;
use Log;

class PricingImport implements ToCollection, WithHeadingRow, WithChunkReading, WithBatchInserts{
    public function collection(Collection $rows){

        $rownumber = 0;
        $n_error = 0;
        foreach ($rows as $row){
            $CheckCode = Pricing::where("company_id", session("CompanyLinkID"))->where('car_type','LIKE',$row['car_type'])->count();
            if($CheckCode == 0){
                $NewObj = new Pricing();
            }else{
                $NewObj = Pricing::where("company_id", session("CompanyLinkID"))->where('car_type','LIKE',$row['car_type'])->first();
            }

            $cartype = CarType::select("name")->where('name','LIKE',$row['car_type'])->first();

            if($cartype){
                $NewObj->company_id = session("CompanyLinkID");
                $NewObj->car_type = $cartype->name;
                $NewObj->daily_pricing = $row['daily_pricing'];
                $NewObj->monthly_pricing = $row['monthly_pricing'];
                $NewObj->weekly_pricing = $row['weekly_pricing'];
                $NewObj->save();
            } else {
                Log::error("error importing row (".($rownumber+1).") - ".$row);
                $n_error++;
            }
            $rownumber++;
        }
        Log::debug("vehicle import - total rows processed: ".$rownumber.", success: ".($rownumber-$n_error).", error: ".$n_error);
    }
    
    public function batchSize(): int{
        return 1000;
    }
    
    public function chunkSize(): int{
        return 1000;
    }
}
?>