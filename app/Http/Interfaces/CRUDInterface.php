<?php
/**
 * Created by PhpStorm.
 * User: semenpatnickij
 * Date: 26.03.17
 * Time: 15:02
 */
namespace App\Http\Interfaces;

interface ICRUDInterface {

    public function index();
    public function create();
    public function show();
    public function update();
    public function store();

}
