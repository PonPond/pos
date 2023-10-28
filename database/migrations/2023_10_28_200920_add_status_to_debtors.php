<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToDebtors extends Migration
{
    public function up()
    {
        Schema::table('debtors', function (Blueprint $table) {
            $table->string('status')->default(0)->nullable(); // เพิ่มคอลัมน์ 'status'
        });
    }

    public function down()
    {
        Schema::table('debtors', function (Blueprint $table) {
            $table->dropColumn('status'); // ลบคอลัมน์ 'status' ถ้าต้องการย้อนกลับ
        });
    }
}