<?php

namespace Cpkm\Excel\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;

class TableFieldsExport implements FromView
{
    use Exportable;
    public function __construct($eloquent)
    {
        $this->model = app($eloquent);
    }

    public function view(): View
    {
        return view('excel::exports.table_fields', [
            'table' =>  $this->model->getTable(),
            'fields' => $this->model->getDetailFields(),
        ]);
    }

}
