<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Redirect;

//models
use App\Models\User;
use App\Models\disposisi;
use App\Models\jabatan;
use App\Models\surat;

class NormalController extends Controller
{
    //
	
	public function Home(){
		
		$tahun = date('Y');
		
		$suratmasuk1 = surat::whereMonth('created_at','1')->where('jenis_surat', 'SURAT MASUK')->whereYear('created_at',$tahun)->count();
        $suratmasuk2 = surat::whereMonth('created_at','2')->where('jenis_surat', 'SURAT MASUK')->whereYear('created_at',$tahun)->count();
        $suratmasuk3 = surat::whereMonth('created_at','3')->where('jenis_surat', 'SURAT MASUK')->whereYear('created_at',$tahun)->count();
        $suratmasuk4 = surat::whereMonth('created_at','4')->where('jenis_surat', 'SURAT MASUK')->whereYear('created_at',$tahun)->count();
        $suratmasuk5 = surat::whereMonth('created_at','5')->where('jenis_surat', 'SURAT MASUK')->whereYear('created_at',$tahun)->count();
        $suratmasuk6 = surat::whereMonth('created_at','6')->where('jenis_surat', 'SURAT MASUK')->whereYear('created_at',$tahun)->count();
        $suratmasuk7 = surat::whereMonth('created_at','7')->where('jenis_surat', 'SURAT MASUK')->whereYear('created_at',$tahun)->count();
        $suratmasuk8 = surat::whereMonth('created_at','8')->where('jenis_surat', 'SURAT MASUK')->whereYear('created_at',$tahun)->count();
        $suratmasuk9 = surat::whereMonth('created_at','9')->where('jenis_surat', 'SURAT MASUK')->whereYear('created_at',$tahun)->count();
        $suratmasuk10 = surat::whereMonth('created_at','10')->where('jenis_surat', 'SURAT MASUK')->whereYear('created_at',$tahun)->count();
        $suratmasuk11 = surat::whereMonth('created_at','11')->where('jenis_surat', 'SURAT MASUK')->whereYear('created_at',$tahun)->count();
        $suratmasuk12 = surat::whereMonth('created_at','12')->where('jenis_surat', 'SURAT MASUK')->whereYear('created_at',$tahun)->count();	
		
		$suratkeluar1 = surat::whereMonth('created_at','1')->where('jenis_surat', 'SURAT KELUAR')->whereYear('created_at',$tahun)->count();
        $suratkeluar2 = surat::whereMonth('created_at','2')->where('jenis_surat', 'SURAT KELUAR')->whereYear('created_at',$tahun)->count();
        $suratkeluar3 = surat::whereMonth('created_at','3')->where('jenis_surat', 'SURAT KELUAR')->whereYear('created_at',$tahun)->count();
        $suratkeluar4 = surat::whereMonth('created_at','4')->where('jenis_surat', 'SURAT KELUAR')->whereYear('created_at',$tahun)->count();
        $suratkeluar5 = surat::whereMonth('created_at','5')->where('jenis_surat', 'SURAT KELUAR')->whereYear('created_at',$tahun)->count();
        $suratkeluar6 = surat::whereMonth('created_at','6')->where('jenis_surat', 'SURAT KELUAR')->whereYear('created_at',$tahun)->count();
        $suratkeluar7 = surat::whereMonth('created_at','7')->where('jenis_surat', 'SURAT KELUAR')->whereYear('created_at',$tahun)->count();
        $suratkeluar8 = surat::whereMonth('created_at','8')->where('jenis_surat', 'SURAT KELUAR')->whereYear('created_at',$tahun)->count();
        $suratkeluar9 = surat::whereMonth('created_at','9')->where('jenis_surat', 'SURAT KELUAR')->whereYear('created_at',$tahun)->count();
        $suratkeluar10 = surat::whereMonth('created_at','10')->where('jenis_surat', 'SURAT KELUAR')->whereYear('created_at',$tahun)->count();
        $suratkeluar11 = surat::whereMonth('created_at','11')->where('jenis_surat', 'SURAT KELUAR')->whereYear('created_at',$tahun)->count();
        $suratkeluar12 = surat::whereMonth('created_at','12')->where('jenis_surat', 'SURAT KELUAR')->whereYear('created_at',$tahun)->count();	

		$totaluser = user::count();
		$totaldisposisi = disposisi::count();
		$totalsuratmasuk = surat::where('jenis_surat', 'SURAT MASUK')->count();
		$totalsuratkeluar = surat::where('jenis_surat', 'SURAT KELUAR')->count();
		
/* 		$lastuser = user::orderBy('id', 'DESC')->limit(5)->get();
		$countuser = user::count();
		$countguru = user::where('level','Guru')->count();
		$countmurid = user::where('level','Murid')->count();
		$countkelas = kelas::count();
		$countmapel = mata_pelajaran::count(); */
		return view('layouts.normal.home', compact('tahun','suratmasuk1','suratmasuk2','suratmasuk3','suratmasuk4','suratmasuk5','suratmasuk6','suratmasuk7','suratmasuk8','suratmasuk9','suratmasuk10','suratmasuk11','suratmasuk12','suratkeluar1','suratkeluar2','suratkeluar3','suratkeluar4','suratkeluar5','suratkeluar6','suratkeluar7','suratkeluar8','suratkeluar9','suratkeluar10','suratkeluar11','suratkeluar12','totaluser','totaldisposisi','totalsuratmasuk','totalsuratkeluar'));	
	}  	
	
   public function suratmasuktampil(){
        $surat = surat::where('jenis_surat','SURAT MASUK')->get();
        return view('layouts.normal.tampilsuratmasuk', compact('surat'));		
   } 	

   public function suratkeluartampil(){
        $surat = surat::where('jenis_surat','SURAT KELUAR')->get();
        return view('layouts.normal.tampilsuratkeluar', compact('surat'));		
   }	
   
    public function detailsurat($id)
    {
        //
			$surat = surat::find($id);
			return view('layouts.normal.detailsurat', compact('surat'));	

    }	  

    public function detaildisposisi($id)
    {
        //
		
			$ubh = disposisi::findorfail($id);
				$dt = [
					'status_baca' => 'DIBACA',
				];	
			$ubh->update($dt);		
		
			$disposisi = disposisi::with('fk_surat')->with('fk_tujuan')->find($id);
			return view('layouts.normal.detaildisposisi', compact('disposisi'));	

    }	  	
	
   public function disposisitampil(){
	    $datauser_aktif = Auth::user()->id;
		$datauser = user::where('id',$datauser_aktif)->first();
		$datavalidasi = $datauser->fk_jabatan->id;
	    $disposisi = disposisi::where('tujuan', $datavalidasi)->get();
        return view('layouts.normal.tampildisposisi',compact('disposisi'));		
   }   	
	
}
