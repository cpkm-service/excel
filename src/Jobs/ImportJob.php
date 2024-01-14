<?php

namespace Cpkm\Excel\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
            Excel::import(new $this->data->model, storage_path('app/'.$this->data->path));
            $this->data->update([
                'status'    =>  1,
            ]);
        }catch(\Exception $e) {
            $this->data->update([
                'status'    =>  2,
                'error' =>  $e->getMessage(),
            ]);
            \DB::commit();
        }
    }
}
