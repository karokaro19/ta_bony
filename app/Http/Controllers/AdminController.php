<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



use Redirect;
use Storage;

//models
use App\Models\User;
use App\Models\disposisi;
use App\Models\jabatan;
use App\Models\surat;

class AdminController extends Controller
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
		return view('layouts.admin.home', compact('tahun','suratmasuk1','suratmasuk2','suratmasuk3','suratmasuk4','suratmasuk5','suratmasuk6','suratmasuk7','suratmasuk8','suratmasuk9','suratmasuk10','suratmasuk11','suratmasuk12','suratkeluar1','suratkeluar2','suratkeluar3','suratkeluar4','suratkeluar5','suratkeluar6','suratkeluar7','suratkeluar8','suratkeluar9','suratkeluar10','suratkeluar11','suratkeluar12','totaluser','totaldisposisi','totalsuratmasuk','totalsuratkeluar'));	
	}  

	public function tambahUser(){
		$jabatan = jabatan::all();
		return view('layouts.admin.tambahuser',compact ('jabatan'));		
	}    
    
	public function prosesTambahUser(Request $request){
        $request->validate([
            'email' => 'required|unique:users',
        ]);
		
			$user = new user();
			$user->name = $request->input('name');
			$user->email = $request->input('email');
			$user->level = 'Normal';
			$user->jabatan = $request->input('jabatan');
			$user->password = Hash::make($request->input('password'));
			$user->save();
			return redirect()->route('users.home')->with('success', 'Berhasil Menambah Data');	
	}   

	public function userTampil(){
        $user = user::where('level','!=','Admin')->with('fk_jabatan')->get();
        return view('layouts.admin.tampiluser', compact('user'));		
   }    

    public function hapusUser($id){
    $hapususer = user::find($id);
    $hapususer->delete(); 		
    return redirect()->route('users.home')->with('success', 'Data Berhasil di hapus');
    }

    public function editUser($id)
    {
        //
			$user = user::with('fk_jabatan')->find($id);
			$jabatan = jabatan::all();
			return view('layouts.admin.edituser', compact('user','jabatan'));	

    }	
	
    public function prosesUpdateUser(Request $request, $id)
    {
        //
        //$produk = produk::find($id);
        $ubh = user::findorfail($id);
        $passwordtohash = Hash::make($request['password']);
        $passwordvalidasi = $request['password'];  
		
		$levelvalid = $request['level'];  
	
            if ($passwordvalidasi == ''){
				$dt = [
					'name' => $request['name'],
					'email' => $request['email'],
					'jabatan' => $request['jabatan'],
				];	
			}		
			else{
				$dt = [
					'name' => $request['name'],
					'email' => $request['email'],
					'jabatan' => $request['jabatan'],
					'password' => $passwordtohash,
				];	
			}    
			$ubh->update($dt);
			return redirect()->route('users.home')->with('success', 'Data Berhasil di ubah');	
				
	} 

	public function jabatantampil(){
        $jabatan = jabatan::all();
        return view('layouts.admin.tampiljabatan', compact('jabatan'));		
   }   

   public function tambahjabatan(){
        return view('layouts.admin.tambahjabatan');		
   }    

   public function prosestambahjabatan(Request $request){
		$jabatan = new jabatan();
		$jabatan->jabatan = $request->input('jabatan');
		$jabatan->save();
		return redirect()->route('jabatan.home')->with('success', 'Berhasil Menambah Data');		
   }  

   public function editjabatan($id){
	    $jabatan = jabatan::find($id);
        return view('layouts.admin.editjabatan', compact('jabatan'));		
   }    
   
   public function prosesUpdatejabatan(Request $request, $id){
		$ubh = jabatan::findorfail($id);
			$dt = [
				'jabatan' => $request['jabatan'],
			];	
		$ubh->update($dt);
		return redirect()->route('jabatan.home')->with('success', 'Data Berhasil di ubah');		
   }    

   public function hapusjabatan($id){
	$hapusjatabatan = jabatan::find($id);
	$hapusjatabatan->delete(); 		
	return redirect()->route('jabatan.home')->with('success', 'Data Berhasil di hapus');		
   }  

	//
	
   public function suratmasuktampil(){
        $surat = surat::where('jenis_surat','SURAT MASUK')->get();
        return view('layouts.admin.tampilsuratmasuk', compact('surat'));		
   } 	

   public function suratkeluartampil(){
        $surat = surat::where('jenis_surat','SURAT KELUAR')->get();
        return view('layouts.admin.tampilsuratkeluar', compact('surat'));		
   } 

   public function tambahsurat(){
        return view('layouts.admin.tambahsurat');		
   }    
	
   public function prosestambahsurat(Request $request){
	   
        $request->validate([
            'file_lampiran' => 'required|mimes:pdf,jpg,bmp,png|max:2048',
        ]);

        $name_file_lampiran = $request->file_lampiran;			
		$file_lampiran = time().rand(100,999).".".$name_file_lampiran->getClientOriginalName();	   

        $img = $request->image;
		$folderPath = "assets/images/";

		$image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';		
		$file = $folderPath . $fileName;
        Storage::put($file, $image_base64);
	   
		$surat = new surat();
		$surat->jenis_surat = $request->input('jenis_surat');
		$surat->no_surat = $request->input('no_surat');
		$surat->perihal = $request->input('perihal');
		$surat->tanggal_surat = $request->input('tanggal_surat');
		$surat->tanggal_diterima = $request->input('tanggal_diterima');
		$surat->ringkasan = $request->input('ringkasan');
		$surat->keterangan = $request->input('keterangan');
		$surat->pengirim = $request->input('pengirim');
		$surat->no_surat_pemohon = $request->input('no_surat_pemohon');
		$surat->tanggal_pemohon = $request->input('tanggal_pemohon');
		$surat->tanggal_usul = $request->input('tanggal_usul');
		$surat->jenis_permohonan = $request->input('jenis_permohonan');
		$surat->status = $request->input('status');
		$surat->foto_unggahan = $fileName;
		$surat->file_lampiran = $file_lampiran;
		$surat->save();
		$name_file_lampiran->move(public_path().'/assets/images/', $file_lampiran);
		return redirect()->route('admin.home')->with('success', 'Berhasil Menambah Data');		
   }  
   
   public function editsurat($id){
	    $surat = surat::find($id);
        return view('layouts.admin.editsurat',compact('surat'));		
   }     

   public function prosesupdatesurat(Request $request, $id){
	   
		$ubh = surat::findorfail($id);
		$data_awal = $ubh->file_lampiran;

		if ($request->file_lampiran == '')
		{
			$dt = [
				'jenis_surat' => $request['jenis_surat'],
				'no_surat' => $request['no_surat'], 
				'perihal' => $request['perihal'],
				'tanggal_surat' => $request['tanggal_surat'],
				'tanggal_diterima' => $request['tanggal_diterima'],
				'ringkasan' => $request['ringkasan'],
				'keterangan' => $request['keterangan'],
				'pengirim' => $request['pengirim'],
			];		
			$ubh->update($dt);
		}
		else{

			$request->validate([
				'file_lampiran' => 'required|mimes:pdf,jpg,bmp,png|max:2048',
			]);

			$dt = [
				'jenis_surat' => $request['jenis_surat'],
				'no_surat' => $request['no_surat'], 
				'perihal' => $request['perihal'],
				'tanggal_surat' => $request['tanggal_surat'],
				'tanggal_diterima' => $request['tanggal_diterima'],
				'ringkasan' => $request['ringkasan'],
				'keterangan' => $request['keterangan'],
				'pengirim' => $request['pengirim'],
				'file_lampiran' => $data_awal,
			];		
			$request->file_modul->move(public_path().'/assets/images/', $data_awal);
			$ubh->update($dt);			
		}
		
		return redirect()->route('admin.home')->with('success', 'Data Berhasil di ubah');					
   }  	
   
    public function hapussurat($id){
		$hapussurat = surat::find($id);
		$hapussurat->delete(); 		
		return redirect::back()->with('success', 'Data Berhasil di hapus');		
    }     
	
	//
	
   public function disposisi($id){
	    $surat = surat::find($id);
	    $jabatan = jabatan::all();
        return view('layouts.admin.tambahdisposisi', compact('surat','jabatan'));		
   }

   public function prosestambahdisposisi(Request $request){
	   
		$datas = $request->input('id_suratmasuk');
		$datavalid = disposisi::where('id_suratmasuk',$datas)->count();
		
		if ($datavalid < 1)
		{		
			$disposisi = new disposisi();
			$disposisi->id_suratmasuk = $request->input('id_suratmasuk');
			$disposisi->tujuan = $request->input('tujuan');
			$disposisi->batas_waktu = $request->input('batas_waktu');
			$disposisi->catatatan = $request->input('catatan');
			$disposisi->status_baca = 'BELUM DIBACA';
			$disposisi->save();
			return redirect()->route('disposisi.home')->with('success', 'Berhasil Menambah Data Disposisi');		
		}
		else{
			return redirect::back()->withErrors(['msg' => 'Surat ini tidak bisa di disposisi dikarenakan data disposisi surat ini sudah dibuat sebelumnya!']);
		}
   }    
   
   public function editdisposisi($id){
	    $disposisi = disposisi::with('fk_surat')->with('fk_tujuan')->find($id);
	    $jabatan = jabatan::all();
        return view('layouts.admin.editdisposisi', compact('disposisi','jabatan'));		
   }   
   
    public function hapusdisposisi($id){
		$disposisi = disposisi::find($id);
		$disposisi->delete(); 		
		return redirect()->route('disposisi.home')->with('success', 'Data Berhasil di hapus');	
    }     
	
   public function prosesupdatedisposisi(Request $request, $id){
		$ubh = disposisi::findorfail($id);
			$dt = [
				'tujuan' => $request['tujuan'],
				'batas_waktu' => $request['batas_waktu'],
				'jabatan' => $request['jabatan'],
				'catatatan' => $request['catatatan'],
			];	
		$ubh->update($dt);
		return redirect()->route('disposisi.home')->with('success', 'Data Berhasil di ubah');		
   }

   public function disposisitampil(){
	    $disposisi = disposisi::all();
        return view('layouts.admin.tampildisposisi',compact('disposisi'));		
   }     
   
    public function detailsurat($id)
    {
        //
			$surat = surat::find($id);
			return view('layouts.admin.detailsurat', compact('surat'));	

    }	  

    public function detaildisposisi($id)
    {
        //
			$disposisi = disposisi::with('fk_surat')->with('fk_tujuan')->find($id);
			return view('layouts.admin.detaildisposisi', compact('disposisi'));	

    }	   
	
}
