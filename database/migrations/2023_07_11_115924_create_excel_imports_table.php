<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excel_imports', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('status')->default(1)->comment('啟用狀態 0:處理中 1:完成');
            $table->string('model')->comment('匯入模組');
            $table->string('name')->comment('檔案名稱');
            $table->string('path')->comment('檔案路徑');
            $table->text('error')->nullable()->comment('錯誤原因');
            $table->timestamps();
            $table->comment('Excel 匯入資料表');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('excel_imports');
    }
};
