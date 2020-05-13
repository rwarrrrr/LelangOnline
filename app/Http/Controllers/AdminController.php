<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//jangan lupa use
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
	//ayo belajar
	//semangat
    public function viewHome()
    {
    	if (!Session::get('login')) {
    		return redirect('/');
    	}else{
    		if (Session::get('id_level') == '1') {
                return redirect('petugas/home');                
            } elseif (Session::get('id_level') == '2') {
                $data['barang'] = \App\Barang::get();
    			return view('admin.home',$data);
                
            } else{
                return redirect('/');
            }
    	}
    }


    public function viewDetailBarang($id_barang)
    {
        //ini buat ngeprotect halaman
        //kalo belum login
        if(!Session::get('login')){
            //masuk sini
            return redirect('petugas/login')->with('alert','Kamu harus login dulu');

        //kalo id levelnya 1 masuk admin
        }elseif(Session::get('id_level') == 2){
            //$data['barangDetail'] bacaan barangDetail itu buat variabel buat nanti di tampilan
            //$data ini buat nampung data barang berdasarkan id barang
            $data['barangDetail'] = \App\Barang::where('id_barang',$id_barang)->get();
            //ini untuk menampilakn tampilannya sama $datanya agar bisa di akses di tampilan
            return view('admin.detailBarang',$data);
        //kalo bukan masuk petugas             
        }else{
            return redirect('petugas/home');
        }
    }


    public function viewTambahBarang()
    {
        //ini buat ngeprotect halaman
        //kalo belum login
        if(!Session::get('login')){
            //masuk sini
            return redirect('petugas/login')->with('alert','Kamu harus login dulu');

        //kalo id levelnya 1 masuk petugas    
        }elseif(Session::get('id_level') == 2){
            //ini untuk menampilkan tampilan tambahBarang pada folder petugas
           return view('admin.tambahEditBarang');
                     
        }else{
            return redirect('petugas/home');
        }
    }

    public function tambahBarangPost(Request $request)
    {
        //ini untuk memvalidasi apa aja yg mau diinputkan ketika tambah barang
        $this->validate($request,[
            'nama_barang' => 'required',
            'harga_awal' => 'required',
            'deskripsi_barang' => 'required',
        ]);

        //ini untuk menampung model kalo ada bacaan new berarti buat tambah data
        $data = new \App\Barang;

        //ini untuk tanggal (tahun , bulan , tanggal)
        $date = date("Y-m-d");
        //ini untuk memasukkan data dari nama_barang diambil dari $request->nama_barang ini data yg di inputkan user
        $data->nama_barang = $request->nama_barang;
        //ini mengisi tanggal dengan variabel date yg tadi di buat
        $data->tgl = $date;
        $data->harga_awal = $request->harga_awal;
        $data->deskripsi_barang = $request->deskripsi_barang;

        //ini untuk simpand data
        $status = $data->save();

        //ini buat pengecekan
        if ($status) {
            //kalo berhasil
            return redirect('admin/home')->with('alert-success','Kamu berhasil Register');
        } else {
            //kalo gagal
            return redirect('admin/tambah/barang')->with('alert-error','register gagal');
        }

    }

    public function viewEditBarang($id_barang)
    {
        //ini buat ngeprotect halaman
        //kalo belum login
        if(!Session::get('login')){
            //masuk sini
            return redirect('petugas/login')->with('alert','Kamu harus login dulu');
        //kalo id levelnya 1 masuk petugas    
        }elseif(Session::get('id_level') == 2){
            //ini untuk menampilkan tampilan tambahBarang pada folder petugas
            //yang diujung biasanya kan pake where tapi disini pake find biar lebih singkat
            $data['barang'] = \App\Barang::find($id_barang);
           return view('admin.tambahEditBarang',$data);
                     
        }else{
            return redirect('petugas/home');
        }
                     
        
    }

    public function editBarangPost(Request $request,$id_barang)
    {
        //ini buat validasi apa aja yg bisa diinputkan ketika edit barang
        $this->validate($request,[
            'nama_barang' => 'string',
            'harga_awal' => 'min:1',
            'deskripsi_barang' => 'string',
        ]);

        //ini mengambil data dari tabel barang berdasarkan id barang
        $data = \App\Barang::find($id_barang);
        //ini tanggal
        $date = date("Y-m-d");
        //ini untuk mengganti field nama barang degan = nama barang yg di inputkan user
        $data->nama_barang = $request->nama_barang;
        $data->tgl = $date;
        $data->harga_awal = $request->harga_awal;
        $data->deskripsi_barang = $request->deskripsi_barang;

        //ini untuk ubah data
        $status = $data->update();

        //ini untuk pengecekan
        if ($status) {
            //kalo berhasil
            return redirect('admin/home')->with('alert-success','Kamu berhasil Register');
        } else {
            //kalo gagal
            return redirect('admin/edit/barang')->with('alert-error','register gagal');
        }

    }

    public function deletePost($id_barang)
    {
        //ini untuk mencari data barang berdasarkan id
        $data = \App\Barang::find($id_barang);
        //ini untuk delete data
        $status = $data->delete();

        //ini untuk pengecekan
        if ($status) {
            //kalo berhasil
            return redirect('admin/home')->with('alert-success','Kamu berhasil Register');
        } else {
            //kalo gagal
            return redirect('admin/home')->with('alert-error','register gagal');
        }

    }


    public function viewPemenang()
    {

        //ini buat ngeprotect halaman
        //kalo belum login
        if(!Session::get('login')){
            //masuk sini
            return redirect('petugas/login')->with('alert','Kamu harus login dulu');
        //kalo id levelnya 1 masuk petugas    
        }elseif(Session::get('id_level') == 2){
            //$status buat nampung kata ditutup
           $status = "ditutup";
           //menampilkan data lelang berdasarkan status ditutup
            $data['lelang'] = \App\Lelang::where('status',$status)->get();
            
            //ini untuk menampilkan tampilan lelang pada folder petugas
           return view('admin.pemenang',$data);
        }else{
            return redirect('petugas/home');
        }

        
    }

    
}
