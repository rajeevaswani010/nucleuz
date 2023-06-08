<?php
namespace App\Import;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

use App\Models\Vehicle;
use Log;

class VehicleImport implements ToCollection, WithHeadingRow, WithChunkReading, WithBatchInserts{
    public function collection(Collection $rows){
        foreach ($rows as $row){
            //Log::debug("row car type: ".$row['car_type']);
            $CheckCode = Vehicle::where("company_id", session("CompanyLinkID"))->where("reg_no", $row['registration_number'])->count();
            if($CheckCode == 0){
                $NewObj = new Vehicle();
            }else{
                $NewObj = Vehicle::where("company_id", session("CompanyLinkID"))->where("reg_no", $row['registration_number'])->first();
            }
            
            $NewObj->company_id = session("CompanyLinkID");
            $NewObj->car_type = $row['car_type'];
            $NewObj->make = $row['make'];
            $NewObj->model = $row['model'];
            $NewObj->variant = $row['variant'];
            $NewObj->km_reading = $row['km_reading'];
            $NewObj->fuel_level_reading = $row['fuel_level_reading'];
            $NewObj->current_condition = $row['current_conditions'];
            $NewObj->ac = $row['ac'];
            $NewObj->Audio = $row['audio'];
            $NewObj->gps = $row['gps'];
            $NewObj->mulkiya_details = $row['mulkiya_details'];
            $NewObj->insurance_detail = $row['insurance_details'];
            $NewObj->chasis_no = $row['chasis_number'];
            $NewObj->engine_no = $row['engine_number'];
            $NewObj->reg_no = $row['registration_number'];
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