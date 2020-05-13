<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use yg di bawah
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class MasyarakatController extends Controller
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
            return redirect('masyarakat/login')->with('alert','Kamu harus login dulu');
        }
        else{
            if (!Session::get('id_level')) {
            
                //$status buat nampung string dibuka
            $status = "dibuka";
            //ini buat ngmabil ID user yg login
            $id = Session::get('id_user');     
            //ini ngambil history berdasarkan user login     
            $barang =  \App\History::where('id_user',$id)->first();
            //ini buat pengecekan
            //kalo $barang/user = ada
            if($barang != null) {
                //maka muncul ini
                //$data['barang'] yg bacaan barang itu variabel buat di tampilan
                //yg sesudah where([]) itu maksudnya wherenya ada 2
                $data['barang'] = \App\lelang::where([
                    ['status',$status],
                    ['id_user',"!=",$barang->id_user]
                ])->get();
            
            //kalo ga adad user
            } else if($barang == null) {
                //muncul ini
                //ini where-nya 1
                 $data['barang'] = \App\lelang::where('status',$status)->get();
            }

            //ini untuk menampilkan tampilan home pada folder masyarakat
           return view('masyarakat.home',$data);
                            
            }else{
                return redirect('/');
            }
                    	         
        }
    	
    }


    //yg di dalam () itu id yg di passing/dikirim terus di tampung
    public function viewDetailPenawaran($id_lelang)
    {

        //kalo belum login
        // Session ini ngambil dari loginPost
        if(!Session::get('login')){
            //masuk sini
            return redirect('masyarakat/login')->with('alert','Kamu harus login dulu');
        }
        //kalo udah login masuk sini
        else{
            //ini menampilkan lelang berdasarkan id
            $data['barangDetail'] = \App\Lelang::where('id_lelang',$id_lelang)->get();

            //ini untuk mengarahkan ke tampilannya
            return view('masyarakat.detailPenawaran',$data);
        }
            
    }

    //yg di dalma () itu request buat ngambil data,terus yg id itu id yg di passing
    public function penawaranPost(Request $request,$id_lelang)
    {
        //ini buat validasi apa aja yg harus dimasukin ke penawaean
        $this->validate($request,[
            'penawaran_harga' => 'required',
        ]);
            //ini untuk mengambil lelang berdasarkan id
            $lelang = \App\Lelang::find($id_lelang);
            //$harga untuk menampung penawaran yg udah di input user
            $harga = $request->penawaran_harga;            

            //ini buat pengececkan kalo harga yg di input lebih besar sama dengan yang ada di tabel lelang di field harga awal maka bisa tambah data
            if( $harga >= $lelang->barang->harga_awal) {
                //ini buat ngambil model history
                //kalo ada new berarti itu buat tambah data kalo find()/where() itu buat edit atau delete data
                $data = new \App\History;
                //$data->namaField = $idlelang -> ini dapet dari id yg di passing
                $data->id_lelang = $id_lelang;
                $data->id_barang = $request->id_barang;//$request ini dapet dari tag input yg ada di tampilan
                $data->id_user = Session::get('id_user'); // ini dapet dari user login
                $data->penawaran_harga = $request->penawaran_harga;
                //ini buat save data
                $status = $data->save();
                //kalo berhasil 
                if ($status) {
                    //buat pengecekan lagi
                    //kalo penawaran yg di input user lebih besar dari harga akhir yg ada di tabel lelang maka bisa lanjut
                    if ($harga > $lelang->harga_akhir) {
                        //$lelang dapet dari variabel di atas 
                        $lelang->harga_akhir = $harga;
                        $lelang->id_user = Session::get('id_user');
                        //ini buat update
                        $statusc = $lelang->update();
                        //kalo berhassil
                        if ($status) {
                            //return redirect() yg di dalem redirect itu nama route
                             return redirect('masyarakat/home');
                         //kalo gagal    
                         } else{
                            //return redirect() yg di dalem redirect itu nama route
                            return redirect('masyarakat/home');
                         }

                    //kalo kurang maka kesini
                    } else{
                            //return redirect() yg di dalem redirect itu nama route
                        return redirect('masyarakat/home');
                    }
                //kalo gagal
                }else{
                            //return redirect() yg di dalem redirect itu nama route
                    return redirect('masyarakat/home');
                }

            //kalo kurang maka massuk sini dan tidak bisa tambah data
            } else {
                            //return redirect() yg di dalem redirect itu nama route
                return redirect('masyarakat/home');
            }

    }


    public function viewPemenang()
    {
        //kalo belum login
        // Session ini ngambil dari loginPost
        if(!Session::get('login')){
            //masuk sini
            return redirect('masyarakat/login')->with('alert','Kamu harus login dulu');
        }
        //kalo udah login masuk sini
        else{
            //$id buat nampung id yg login
            $id = Session::get('id_user');
            //$status buat nampung string ditutup
            $status = "ditutup";
            //$data['lelang'] bacaan lelang itu buat varibabel di tampilan
            //terus disini ada 2 where 
            //ini nampilin data di tabel lelang where statusnya ditutup sama id usernya yg login
            $data['lelang'] = \App\Lelang::where([
                ['status',$status],
                ['id_user',$id]
            ])->get();
            //ini buat ngarahin ke tampulannya
            return view('masyarakat.pemenang',$data);
        }
    }

    public function viewHistoryLelang()
    {
        //kalo belum login
        // Session ini ngambil dari loginPost
        if(!Session::get('login')){
            //masuk sini
            return redirect('masyarakat/login')->with('alert','Kamu harus login dulu');
        }
        //kalo udah login masuk sini
        else{
            //ini buat nampung id user login
            $id = Session::get('id_user');
            //ini nampilin data di tabel history berdasarkan id user login
            $data['history'] = \App\History::where('id_user',$id)->get();
            //ini ubuat nampilin tampilannya
            return view('masyarakat.historyLelang',$data);
        }
    }

    //disini di dalem method nya ada id history yg udah di passing
    public function viewEditPenawaran($id_history)
    {
        //kalo belum login
        // Session ini ngambil dari loginPost
        if(!Session::get('login')){
            //masuk sini
            return redirect('masyarakat/login')->with('alert','Kamu harus login dulu');
        }
        //kalo udah login masuk sini
        else{
            //ini buat nampilin history berdasarkan id history
            $data['barangDetail'] = \App\History::where('id_history',$id_history)->get();
            //ini buat ngarahin ke tampilannya
            return view('masyarakat.editPenawaran',$data);
        }
    }

    public function editPenawaranPost(Request $request,$id_history)
    {
        //ini buat validasi apa aja yg mau di input atau edit
        $this->validate($request,[
            'penawaran_harga' => 'required',
        ]);
            //ini buat nampung id lelang yg ada di tag input di tampulan
            $id_lelang = $request->id_lelang;
            //ini buat nampung tabel lelang berdasarkan id lelang
            $lelang = \App\Lelang::find($id_lelang);
            //ini buat nampung penawaran yg udah di input user
            $harga = $request->penawaran_harga;            

            //ini buat pengecekan kalo harga yg diinputkan lebih besar sama dengan harga awal di tabel barang dan lebih besar juga dari harga akhir maka bisa edit data
            //$lelang->barang   bacaan barang itu nama function yg ada di model atau nama relasi yg ada di model lelang yg berelasi ke tabel barang
            if( $harga >= $lelang->barang->harga_awal && $harga >= $lelang->harga_akhir) {

                //ini buat nampung tabel history berdasarkan id 
                $data = \App\History::find($id_history);
                //ini buat nge ganti penawaran harga yg di history menjadi yg di inputkan
                $data->penawaran_harga = $request->penawaran_harga;
                //ini buat update data
                $status = $data->update();

                //kalo berhasisl
                if ($status) {
                    //ini buat pengecekan kalo penawaran lebih besar dari harga akhir yg ada di tabel lelang maka bisa update data 
                    //ini buat di tabel lelang semisal data penawaran lebih besar
                    if ($harga > $lelang->harga_akhir) {
                        //ini buat ngubah harga akhir dengan harga yg di inputkan
                        $lelang->harga_akhir = $harga;
                        //ini buat ganti id user
                        $lelang->id_user = Session::get('id_user');
                        //ini buat  update data
                        $statusc = $lelang->update();
                        //kalo berhasil
                        if ($status) {
                            //return redirect() yg di dalem redirect itu nama route
                             return redirect('masyarakat/home');
                        //kalo gagal
                         } else{
                            //return redirect() yg di dalem redirect itu nama route
                            return redirect('masyarakat/home');
                         }
                    //kalo kkurang dari harga akhir
                    } else{
                            //return redirect() yg di dalem redirect itu nama route
                        return redirect('masyarakat/home');
                    }
                    //kalo gagal
                }else{
                            //return redirect() yg di dalem redirect itu nama route
                    return redirect('masyarakat/home');
                }

            //kalo kurang
            } else {
                            //return redirect() yg di dalem redirect itu nama route
                return redirect('masyarakat/home');
            }

    }

    //di dalem method itu ada id yg di passing
    public function deletePenawaranPost($id_history)
    {
        //$data untuk menampung tabel history berdasarkan id
        $data = \App\History::find($id_history);
        //ini untuk delete
        $status = $data->delete();

        //kalo berhasil
        if ($status) {
            //ini buat nampung tabel history berdasarkan id lelang  yg ada di tabel lelang sama nampilin penawaran terbesar
            $history = \App\History::where('id_lelang',$data->lelang->id_lelang)->max('penawaran_harga');
            //ini buat nampung dari penngecekan sama pencarian di tabel lelang berdasarkan id lelang
            $lelang = \App\Lelang::findOrFail($data->lelang->id_lelang);
            //ini buat nampung tabel history berdasarkna id lelang yg ada di tabel lelang
            //$data->lelang   bacaan lelang itu dari function/relasi di model history terus first buat ngambil data pertama
            $user = \App\History::where('id_lelang',$data->lelang->id_lelang)->first();
            
            //ini buat pengecekan
            //kalo data udah di hapus terus ga ada penawaran terbesar yg artinya null maka if jalan
            if ($history == null) {            
                //ini ngerubah data harga akhir jadi 0
                $lelang->harga_akhir = 0;
                //ini ngerubah id user jadi 0
                $lelang->id_user = 0;

                //kalo engga  null berarti ada data yg besar sebekumnya atau data besar ke 2 maka else jalan
            } else {
                //ini buat ngeganti harga akhir di tabel lelang dengan MAX
                $lelang->harga_akhir = $history;
                //ini ngeganti id user dari user yg memiliki data penawaran harga terbesar ke 2
                $lelang->id_user = $user->id_user;
            }
            //ini buat update data
            $statusd = $lelang->update();
            //kalo berhasil
            if ($statusd) {
                            //return redirect() yg di dalem redirect itu nama route
                return redirect('masyarakat/home');
                //kalo gagal
            }else{
                            //return redirect() yg di dalem redirect itu nama route
                return redirect('masyarakat/home');
            }

            //klao gagal
        }else{
                            //return redirect() yg di dalem redirect itu nama route
            return redirect('masyarakat/home');
        }
    }

}
