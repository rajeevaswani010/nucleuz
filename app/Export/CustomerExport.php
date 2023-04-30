<?php
namespace App\Export;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CustomerExport implements FromView{
    private $data;

    public function __construct($data){
        $this->data = $data;
    }

	 public function view(): View{
    	$Data = $this->data;
        return view('Exports.Customer', compact("Data"));
    }
}