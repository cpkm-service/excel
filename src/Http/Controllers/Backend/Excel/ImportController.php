<?php

namespace Cpkm\Excel\Http\Controllers\Backend\Excel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cpkm\Excel\Http\Requests\ImportRequest;

class ImportController extends Controller
{

    protected $form = [];

    public function __construct() {
        $this->ImportService = app(config('excel.import.service'));
        $this->name = 'imports';
        $this->view = 'backend.'.$this->name;
        $this->form = config('excel.import.form');
        $this->form['back'] =   route('backend.excel.import.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->action == 'download') {
            return (new \Cpkm\Excel\Exports\TableFieldsExport(config('excel.import.types.'.request()->downlaod.'.eloquent')))->download(config('excel.import.types.'.request()->downlaod.'.name').date('Ymd').'.xlsx');
        }
        if (request()->ajax()) {
            
            return response()->json([
                "data"  =>  $this->ImportService->dataTable()
            ]);
        }
        return view('excel::'.$this->view.'.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->form['action']   =   route('backend.excel.import.store');
        $this->form['title']    =   '匯入資料';
        $this->form['fields']['model']['options'] = collect(config('excel.import.types'))->map(function($item) {
            return [
                'value' =>  $item['model'],
                'name'  =>  $item['name'],
            ];
        })->toArray();
        $data['form']   =   $this->form;
        return view('excel::'.$this->view.'.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImportRequest $request)
    {
        $this->ImportService->store($request->all());
        return redirect()->route('backend.excel.import.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
