<?php

namespace App\Http\Controllers;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DosenController extends Controller
{
    private $dbmatkul;

    public function __construct(){
        $this->dbmatkul = DB::table('tb_dosen');
     }
 
     public function index(){
         $request = app('db')->select('select * from tb_dosen');
         return response()->json($request);
     }
 
     public function getOne($idmatkul){
         $mt = $this->dbmatkul->find($idmatkul);
         if(!$mt){
             return response()->json([
                 'status' => 'sukses',
                 'message' => 'Matkul tidak ditemukan'
             ], 404);
         }
         return response()->json($mt);
     }
 
     public function deleteOne($id){
         $matkul = $this->dbmatkul->where('id', $id)->delete();
         if($matkul == 0){
             return response()->json([
                 'status' => 'gagal',
                 'message' => 'matkul tidak ditemukan'],
                 404);
         }
 
         return response()->json([
             'status' => 'sukses',
             'message' => 'matkul dengan id berhasil dihapus']);
     }
 
     public function addOne(Request $request){
         $insertmatkul = $this->dbmatkul->insertGetId([

             'nama_matkul' => $request->input('nama'),
             'sks' => $request->input('sks'),
             'dosen' => $request->input('dosen'),
         ]);
         return response()->json([
             'status' => 'sukses',
             'message' => 'berhasil menambahkan matkul',
             'id' => $insertmatkul
         ]);
     }
 
     public function updateOne(Request $request, $id){
     $updateData = [
        // 'id' => $request->input('id'),
        'nama_matkul' => $request->input('nama'),
        'sks' => $request->input('sks'),
        'dosen' => $request->input('dosen')
    ];

     $updatematkul =$this->dbmatkul
                        ->where('id', $id)
                        ->update($updateData);

    if($updatematkul == 0){
        return response()->json([
            'status' => 'gagal',
            'message' => 'id matkul tidak ditemukan'],
            404);
    }
    return response()->json([
        'status' => 'OK', 
        'message' => 'Berhasil Memperbarui Data Mata Kuliah']);
     }
 }