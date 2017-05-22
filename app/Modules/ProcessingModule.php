<?php
/**
 * Created by PhpStorm.
 * User: semenpatnickij
 * Date: 08.04.17
 * Time: 17:06
 */

namespace App\Modules;

class ProcessingModule
{

    public $W = 0;
    public $H = 0;
    public $L = 0;
    public $Vu = 0;
    public $au = 0;
    public $Tr = 0;
    public $b = 0;
    public $m0 = 0;
    public $n = 0;
    public $Tu = 0;
    public $ro = 0;
    public $c = 0;
    public $T0 = 0;
    public $step =  0.1;
    private $data = NULL;
    public $necessary_aliases = array('');

    public function __construct()
    {
        //$this->process();

    }

    public function process()
    {
        $i=0;
        $data = array();

        for($i=0; $i <$this->L; $i+=$this->step){


            $this->data[] = array(
                'i' => $i,
                'T' => $this->T($i),
                'V' => $this->V($this->T($i))
                );

            //print $i.'-------'.$this->T($i).'<br>';


        }
        //print '<br>'.$i.'<br>';


        if (round($i-$this->step,10) != round($this->L, 10)) {
            print $i-$this->step.'----'.$this->L.'<br>';

            $this->data[] = array(
                'i' => $this->L,
                'T' => $this->T($this->L),
                'V' => $this->V($this->T($this->L))
            );
            //print $this->L.'-------'.$this->T($this->L).'<br>';
        }
        return $this->data;

    }



    //Температура на итерации
    public function T($var)
    {
        $T = $this->Tr + (1 / $this->b) * log((($this->b * $this->get_qr() + $this->W * $this->au) / ($this->b * $this->get_qa())) * (1.0 - exp((-1.0) * ($this->b * $this->get_qa() * $var) / ($this->ro * $this->c * $this->Q()))) + exp($this->b * ($this->T0 - $this->Tr - (($this->get_qa() * $var) / ($this->ro * $this->c * $this->Q())))));
        return $T;
    }

    //Производительность канала
    public function Q()
    {
        $Q = ($this->W * $this->H / 2) * $this->Vu * $this->get_Fd();
        return $Q;
    }

    public function get_Fd()
    {
        $Fd = 0.125 * ($this->H / $this->W) * ($this->H / $this->W) - 0.625 * ($this->H / $this->W) + 1.0;
        return $Fd;
    }

    public function get_qr()
    {
        $qr = $this->W * $this->H * $this->m0 * pow(($this->Vu / $this->H), $this->n + 1);
        return $qr;
    }


    public function get_qa()
    {
        $qa = $this->W * (($this->au / $this->b) - ($this->au * $this->Tu) + ($this->au * $this->Tr));
        return $qa;
    }

    //вязкость
    private function V($T)
    {
        $V = $this->m0 * exp(($this->Tr - $T) * $this->b) * pow(($this->Vu / $this->H), $this->n - 1);
        return $V;
    }
    public function getJSONresult(){
        $this->process();
        return json_encode($this->data);
    }
    public function printJSONresult(){
        $this->process();

        print json_encode($this->data, JSON_PRETTY_PRINT);

    }
}