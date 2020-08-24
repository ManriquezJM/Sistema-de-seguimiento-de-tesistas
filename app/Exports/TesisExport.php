<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class TesisExport implements FromView,ShouldAutoSize{

    use Exportable;

    private $listTesis = [];
    public function getTesis($listTesis)
    {
        $this->listTesis = $listTesis;
        
        return $this;
    }
    public function view(): View
    {
        return view('reportes.tesis.excel.reportefit', [
            'reportefit' => $this->listTesis
        ]);
    }
}
