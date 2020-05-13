<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PetugasController extends Controller
{
    

/* struktur pembuatan function */
/* public function FunctionName()
{
    code
} */

    public function viewHome()
    {
    	//ini buat ngeprotect halaman
    	//kalo belum login
    	if(!Session::get('login')){
    		//masuk sini
            return redirect('petugas/login')->with('alert','Kamu harus login dulu');

        //kalo id levelnya 1 masuk petugas
        }else{
            if (Session::get('id_level') == '1') {

                //yang $data itu variabel buat nampung model Barang 
            //yang di dalam kurung [] pinggir $data itu buat variabel yang nantinya di panggil di tampilan buat di looping
            //App\barang terus get itu buat mengambil semua data di dalam model Barang yang isinya tabel barang
            $data['barang'] = \App\Barang::get();
            //ini untuk menampilkan tampilan home pada folder petugas
           return view('petugas.home',$data);


            } elseif (Session::get('id_level') == '2') {
                return redirect('admin/home');                
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

        //kalo id levelnya 1 masuk petugas
        }elseif(Session::get('id_level') == 1){
            //$data['barangDetail'] bacaan barangDetail itu buat variabel buat nanti di tampilan
            //$data ini buat nampung data barang berdasarkan id barang
            $data['barangDetail'] = \App\Barang::where('id_barang',$id_barang)->get();
            //ini untuk menampilakn tampilannya sama $datanya agar bisa di akses di tampilan
            return view('petugas.detailBarang',$data);
        //kalo bukan masuk admin             
        }else{
            return redirect('admin/home');
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
        }elseif(Session::get('id_level') == 1){
            //ini untuk menampilkan tampilan tambahBarang pada folder petugas
           return view('petugas.tambahEditBarang');
                     
        }else{
            return redirect('admin/home');
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
            return redirect('petugas/home')->with('alert-success','Kamu berhasil Register');
        } else {
            //kalo gagal
            return redirect('petugas/tambah/barang')->with('alert-error','register gagal');
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
        }elseif(Session::get('id_level') == 1){
            //ini untuk menampilkan tampilan tambahBarang pada folder petugas
            //yang diujung biasanya kan pake where tapi disini pake find biar lebih singkat
            $data['barang'] = \App\Barang::find($id_barang);
           return view('petugas.tambahEditBarang',$data);
                     
        }else{
            return redirect('admin/home');
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
            return redirect('petugas/home')->with('alert-success','Kamu berhasil Register');
        } else {
            //kalo gagal
            return redirect('petugas/edit/barang')->with('alert-error','register gagal');
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
            return redirect('petugas/home')->with('alert-success','Kamu berhasil Register');
        } else {
            //kalo gagal
            return redirect('petugas/home')->with('alert-error','register gagal');
        }

    }



    public function viewLelang()
    {

        //ini buat ngeprotect halaman
        //kalo belum login
        if(!Session::get('login')){
            //masuk sini
            return redirect('petugas/login')->with('alert','Kamu harus login dulu');
        //kalo id levelnya 1 masuk petugas    
        }elseif(Session::get('id_level') == 1){
            //ini untuk mengambil semua data lelang dari tabel lelang
            $data['lelang'] = \App\Lelang::get();
            
            //ini untuk menampilkan tampilan lelang pada folder petugas
           return view('petugas.lelang',$data);
                     
        }else{
            return redirect('admin/home');
        }
    }


    public function viewTambahLelang()
    {

     //ini buat ngeprotect halaman
        //kalo belum login
        if(!Session::get('login')){
            //masuk sini
            return redirect('petugas/login')->with('alert','Kamu harus login dulu');
        //kalo id levelnya 1 masuk petugas    
        }elseif(Session::get('id_level') == 1){
            //ini untuk mengambil data barang dari tabel barang
            $data['barang'] = \App\Barang::get();
                //ini untuk menampilkan tampilan lelang pada folder petugas
               return view('petugas.tambahEditLelang',$data);                                      
        }else{
            return redirect('admin/home');
        }
    
    }

    public function bukaLelangPost($id_lelang)
    {
        //ini untuk mengambil data  lelang berdaasarkan id
        $data = \App\Lelang::find($id_lelang);
        //ini untuk mengubah status di tabel lelang
        $data->status = "dibuka";

        //ini untuk ubah data
        $statusc = $data->update();

        //ini untuk pengecekan
        if ($statusc) {
            //kalo berhasil
            return redirect('petugas/home/lelang')->with('alert-success','Kamu berhasil Register');
        } else {
            //kalo gagal
            return redirect('petugas/home/lelang')->with('alert-error','register gagal');
        }

    }


    public function tutupLelangPost($id_lelang)
    {
        //ini untuk mengambil data  lelang berdaasarkan id
        $data = \App\Lelang::find($id_lelang);
        //ini untuk mengubah status di tabel lelang
        $data->status = "ditutup";

        //ini untuk ubah data
        $statusc = $data->update();

        //ini untuk pengecekan
        if ($statusc) {
            //kalo berhasil
            return redirect('petugas/home/lelang')->with('alert-success','Kamu berhasil Register');
        } else {
            //kalo gagal
            return redirect('petugas/home/lelang')->with('alert-error','register gagal');
        }

    }


    public function tambahLelangPost(Request $request)
    {
        //ini buat validasi apa aja yg bisa di input ketika tambah data
        $this->validate($request,[
            'id_barang' => 'required',            
        ]);

        //aduh cape ngetik
        //ini untuk mengambil data lelang kalo ada bacaan new itu untuk tambah data
        $data = new \App\Lelang;

        //ini untuk tabggal
        $date = date("Y-m-d");

        $data->id_barang = $request->id_barang;
        $data->tgl_lelang = $date;
        //ini di set 0 karena belum ada penawaran
        $data->harga_akhir = 0;
        //ini di set 0 juga karena belum ada yg nawar 
        //jangan lupa bikin user yg id nnya 0
        $data->id_user = 0;
        //ini ngambil id yg login
        $data->id_petugas = Session::get('id_petugas');
        //haaah ini status di set tutup
        $data->status = "ditutup";
        //ini buat simpan data
        $statusc = $data->save();

        //ini buat pengecekan
        if ($statusc) {
            //kalo berhasil
            return redirect('petugas/home/lelang')->with('alert-success','Kamu berhasil Register');
        } else {
            //kalo gagal
            return redirect('petugas/tambah/lelang')->with('alert-error','register gagal');
        }

    }
    

    public function viewEditlelang($id_lelang)
    {


         //ini buat ngeprotect halaman
        //kalo belum login
        if(!Session::get('login')){
            //masuk sini
            return redirect('petugas/login')->with('alert','Kamu harus login dulu');
        //kalo id levelnya 1 masuk petugas    
        }elseif(Session::get('id_level') == 1){
            //ini untuk mengambil data lelang berdasarkan id
           $data['lelang'] = \App\Lelang::find($id_lelang);
           //ini untuk mengambil data dari tabel barang
            $data['barang'] = \App\Barang::get();
        
            return view('petugas.tambahEditLelang',$data);
        }else{
            return redirect('admin/home');
        }

        
            
    }    

    public function editLelangPost(Request $request, $id_lelang)
    {
        //ini untuk validasi apa aja yg boleh di inputkan user ketika edit data
        $this->validate($request,[
            'id_barang' => 'required',            
        ]);

        //ini untuk mengambil data lelang berdasarkan id 
        $data = \App\Lelang::find($id_lelang);

        //ini untuk tanggal
        $date = date("Y-m-d");

        //ini untuk mengubah id barang
        $data->id_barang = $request->id_barang;
        $data->tgl_lelang = $date;
        //ini untuk mengubah id petugas dengan id petugas yg sedang login
        $data->id_petugas = Session::get('id_petugas');

        //ini untuk ubah data
        $statusc = $data->update();

        //ini untuk pengecekan
        if ($statusc) {
            //kalo berhasil
            return redirect('petugas/home/lelang')->with('alert-success','Kamu berhasil Register');
        } else {
            //kalo gagal
            return redirect('petugas/edit/lelang')->with('alert-error','register gagal');
        }        
    }


    public function deleteLelangPost($id_lelang)
    {
        //mengambil data lelang berdasarkan id
        $data = \App\Lelang::find($id_lelang);
        //ini untuk delete data
        $statusc = $data->delete();

        //ini untuk pengecekan
        if ($statusc) {
            //kalo berhasil
            return redirect('petugas/home/lelang')->with('alert-success','Kamu berhasil Register');
        } else {
            //kalo gagal
            return redirect('petugas/home/lelang')->with('alert-error','register gagal');
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
        }elseif(Session::get('id_level') == 1){
            //$status buat nampung kata ditutup
           $status = "ditutup";
           //menampilkan data lelang berdasarkan status ditutup
            $data['lelang'] = \App\Lelang::where('status',$status)->get();
            
            //ini untuk menampilkan tampilan lelang pada folder petugas
           return view('petugas.pemenang',$data);
        }else{
            return redirect('admin/home');
        }

        
    }


}
