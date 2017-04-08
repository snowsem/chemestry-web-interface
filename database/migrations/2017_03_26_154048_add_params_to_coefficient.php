<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class AddParamsToCoefficient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coefficients', function (Blueprint $table) {
            $table->string('alias');


        });
        DB::table('coefficients')->insert([
            'name' => 'Коэффициент консистенции жидкости',
            'alias' => '',
            'value' => '',
            'unit' => '',
        ]);
        DB::table('coefficients')->insert([
            'name' => 'Температурный коэффициент вязкости',
            'alias' => '',
            'value' => '',
            'unit' => '',
        ]);
        DB::table('coefficients')->insert([
            'name' => 'Темепература приведения',
            'alias' => '',
            'value' => '',
            'unit' => '',
        ]);
        DB::table('coefficients')->insert([
            'name' => 'Идекс течения жидкости',
            'alias' => '',
            'value' => '',
            'unit' => '',
        ]);
        DB::table('coefficients')->insert([
            'name' => 'Коэффициент теплоотдачи от крышки канала к жидкости',
            'alias' => '',
            'value' => '',
            'unit' => '',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
