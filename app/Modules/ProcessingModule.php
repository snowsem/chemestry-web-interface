<?php
/**
 * Created by PhpStorm.
 * User: semenpatnickij
 * Date: 08.04.17
 * Time: 17:06
 */
namespace App\Modules;

class ProcessingModule {

    private $necessary_aliases = array('h');

    public function __construct(){
        $this->process();
    }

    public function process() {
        print "process";
    }
}