<?php

namespace Cpkm\Excel\Services;

use Cpkm\Excel\Models\ExcelImport as CrudModel;
use DataTables;
use Cpkm\Excel\Exceptions\ErrorException;
use Cpkm\Excel\Jobs\ImportJob;

class ImportService {

    public function __construct(CrudModel $CrudModel) {
        $this->CrudModel = $CrudModel;
    }
    /**
     * 取得dataTable限制匯入
     *
     * @param  mixed $where
     * @return void
     */
    public function dataTable(array $where = []) {
        return DataTables::eloquent($this->CrudModel->listQuery($where))->make(true);
    }

    /**
     * 取得paginate匯入
     *
     * @param  mixed $where
     * @return void
     */
    public function paginate(array $where = [],$limit = 10) {
        return $this->frontQuery($where)->paginate($limit);
    }

    /**
     * 取得所有匯入
     *
     * @param  mixed $where
     * @return void
     */
    public function get(array $where = []) {
        return $this->CrudModel->listQuery($where)->get();
    }

    /**
     * 新增匯入
     *
     * @param  array  $validatedData
     * @return array
     */
    public function store($validatedData)
    {
        $data = [
            'model' =>  $validatedData['model'],
            'name'  =>  $validatedData['file']->getClientOriginalName(),
            'path'  =>  $validatedData['file']->store('imports'),
            'status'=>  0,
        ];
        $model = $this->CrudModel->create($data);
        if(!$model) {
            throw new ErrorException(__('create').__('fail'),422);
        }
        ImportJob::dispatch($model);
        return $model;
    }

    /**
     * 取得匯入資訊
     *
     * @param  int  $id
     * @return array
     */
    public function show($id)
    {
        $data = $this->CrudModel->with(['products'])->findOrFail($id);
        return $data;
    }

    /**
     * 更新匯入
     *
     * @param  array  $validatedData
     * @param  int  $id
     * @return array
     */
    public function update($validatedData, $id)
    {
        $model = $this->CrudModel->findOrFail($id);
        $result = $model->update($validatedData);
        if(!$result) {
            throw new ErrorException(__('update').__('fail'),422);
        }
        return $model;
    }

    /**
     *刪除匯入
     *
     * @param  int  $id
     * @return array
     */
    public function destroy($id)
    {
        $data = $this->CrudModel->findOrFail($id);
        $result = $data->delete();
        if(!$result) {
            throw new ErrorException(__('delete').__('fail'),422);
        }
        return $data;
    }

}
