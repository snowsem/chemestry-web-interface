<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertParams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::table('parameters')->insert([
            'name' => 'Плотность',
            'unit' => 'кг/м3',
            'description' => '',
            'alias' => 'p'
        ]);
        DB::table('parameters')->insert([
            'name' => 'Удельная теплоемкость',
            'unit' => 'Дж/(кг* °C)',
            'description' => '',
            'alias' => 'c'
        ]);
        DB::table('parameters')->insert([
            'name' => 'Температура плавления',
            'unit' => '0C',
            'description' => '',
            'alias' => 'T0'
        ]);
        DB::table('parameters')->insert([
            'name' => 'Коэффициент консистенции материала при температуре приведения',
            'unit' => 'Pa*c^n',
            'description' => '',
            'alias' => 'm0'
        ]);
        DB::table('parameters')->insert([
            'name' => 'Температура коэффициента вязкости материала',
            'unit' => '1/°C',
            'description' => '',
            'alias' => 'b'
        ]);
        DB::table('parameters')->insert([
            'name' => 'Температура приведения',
            'unit' => '°C',
            'description' => '',
            'alias' => 'Tr'
        ]);
        DB::table('parameters')->insert([
            'name' => 'Индекс теченеия материала',
            'unit' => '',
            'description' => '',
            'alias' => 'n'
        ]);
        DB::table('parameters')->insert([
            'name' => 'Коэффициент теплоотдачи от крышки канала к материалу',
            'unit' => 'Вт/(м²*°C)',
            'description' => '',
            'alias' => 'au'
        ]);

        //
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
