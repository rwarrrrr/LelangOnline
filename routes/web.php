<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/* ini route buat login register logout */
Route::get('logout','LoginController@logoutPost');

/*  ini untuk Route Masyarakat */

			/* yg kiri buat link yg kanan manggil fungsi di controller */
Route::get('masyarakat/login','LoginController@viewLoginMasyarakat');
Route::post('masyarakat/loginPost', 'LoginController@loginPostMasyarakat');
Route::get('masyarakat/register','LoginController@viewRegisterMasyarakat');
Route::post('masyarakat/registerPost', 'LoginController@registerPostMasyarakat');

/* ini untuk route petugas */
/* 2 route ini udah buat login admin sama petugas */
Route::get('petugas/login','LoginController@viewLogin');
Route::post('petugas/loginPost', 'LoginController@loginPost');

/* ini untuk route admin */
/* 2 route ini udah buat register admin sama petugas tapi di dalem home admin */
Route::get('admin/register','LoginController@viewRegister');
Route::post('admin/registerPost', 'LoginController@registerPost');




/* ini buat crud dll */

/* ini buat route masyarakat */
Route::get('masyarakat/home','MasyarakatController@viewHome');

/* ini route penawaran */
Route::get('masyarakat/detail/penawaran/{id_lelang}','MasyarakatController@viewDetailPenawaran');
Route::post('masyarakat/penawaran/{id_lelang}','MasyarakatController@penawaranPost');

Route::get('masyarakat/edit/penawaran/{id_history}','MasyarakatController@viewEditPenawaran');
Route::post('masyarakat/penawaran{id_history}','MasyarakatController@editPenawaranPost');

Route::post('masyarakat/delete/{id_history}','MasyarakatController@deletePenawaranPost');
/* ini route  pemenang */
Route::get('masyarakat/pemenang','MasyarakatController@viewPemenang');
/* ini route lelang */
Route::get('masyarakat/history/lelang','MasyarakatController@viewHistoryLelang');


/* ini buat route petugas */
Route::get('petugas/home','PetugasController@viewHome');

/* ini route buat barang */
Route::get('petugas{id_barang}','PetugasController@viewDetailBarang');
/* ini route tambah barang */
Route::get('petugas/tambah/barang','PetugasController@viewTambahBarang');
Route::post('petugas','PetugasController@tambahBarangPost');
/* ini route edit barang */
Route::get('petugas/edit/barang/{id_barang}','PetugasController@viewEditBarang');
Route::patch('petugas/{id_barang}','PetugasController@editBarangPost');
/* ini route delete barang */
Route::delete('petugas/delete{id_barang}','PetugasController@deletePost');

/* ini route lelang */
Route::get('petugas/home/lelang','PetugasController@viewLelang');
/* ini route buka tutup lelang */
Route::get('petugas/buka/lelang/{id_lelang}','PetugasController@bukaLelangPost');
Route::get('petugas/tutup/lelang/{id_lelang}','PetugasController@tutupLelangPost');
/* ini route tambah lelang */
Route::get('petugas/tambah/lelang','PetugasController@viewTambahLelang');
Route::post('petugas/lelang','PetugasController@tambahLelangPost');
/* ini route edit lelang */
Route::get('petugas/edit/lelang/{id_lelang}','PetugasController@viewEditLelang');
Route::patch('petugas/lelang/{id_lelang}','PetugasController@editLelangPost');
/* ini route delete lelang */
Route::delete('petugas/lelang{id_lelang}','PetugasController@deleteLelangPost');

/* ini route pemenang penawaran / history */
Route::get('petugas/pemenang','PetugasController@viewPemenang');




/* ini buat route admin */
Route::get('admin/home','AdminController@viewHome');

/* ini route buat barang */
Route::get('admin{id_barang}','AdminController@viewDetailBarang');
/* ini route tambah barang */
Route::get('admin/tambah/barang','AdminController@viewTambahBarang');
Route::post('admin','AdminController@tambahBarangPost');
/* ini route edit barang */
Route::get('admin/edit/barang/{id_barang}','AdminController@viewEditBarang');
Route::patch('admin/{id_barang}','AdminController@editBarangPost');
/* ini route delete barang */
Route::delete('admin/delete{id_barang}','AdminController@deletePost');

/* ini route pemenang penawaran / history */
Route::get('admin/pemenang','AdminController@viewPemenang');