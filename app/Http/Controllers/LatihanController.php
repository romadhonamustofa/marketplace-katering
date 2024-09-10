<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LatihanController extends Controller
{
    public function index(){
        return "Ini dipanggil dari controller latihan";
    }


    public function blog($id){
        return "Ini adalah parameter yang dikirim = ".$id;
    }

    public function beranda() {
        $data = array('nama' => 'Admin');
        return view('beranda', $data);
    }
}
