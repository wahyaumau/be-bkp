<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Jurusan;
use App\ProgramStudi;
use App\Konseling;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;


class KonselingController extends Controller
{
    // Authorization to mahasiswa & konselor
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:konselor,mahasiswa',['except' => ['']]);
    }

    // Get all schedule
    public function getAll(){
        try{
            // $list_konseling = Konseling::select('id','konselor_id','waktu_mulai','waktu_selesai','status')->get();
            $list_konseling = Konseling::with('konselor')->get(['waktu_mulai', 'waktu_selesai', 'konselor_id', 'status']);
            return $this->apiResponse(200, 'success', ['list_konseling' => $list_konseling]);
        }catch (\Exception $e) {
            return $this->apiResponse(201, $e->getMessage(), null);
        }
    }

    public function getOne(Request $request)
    {
        $this->validate($request, [
            'konseling_id' => 'required|integer',
        ]);
        try{
            $konseling = Konseling::findOrFail($request->konseling_id);
            return $this->apiResponse(200, 'success', ['konseling' => $konseling]);
        }catch (\Exception $e) {
            return $this->apiResponse(201, $e->getMessage(), null);
        }
    }

    public function getOneByMhs(Request $request)
    {
        $this->validate($request, [
            'mhs_id' => 'required|integer',
        ]);
        try{
            $konseling = array();
            $konseling = Konseling::all()->where('mhs_id',$request->mhs_id);
            return $this->apiResponse(200, 'success', ['konseling' => $konseling]);
        }catch (\Exception $e) {
            return $this->apiResponse(201, $e->getMessage(), null);
        }
    }

    public function getKonselingMendatang(){
        try{
            $list_konseling = Konseling::where('waktu_mulai', '>=', Carbon::now())->get();
            return $this->apiResponse(200, 'success', ['$list_konseling' => $list_konseling]);
        }catch (\Exception $e) {
            return $this->apiResponse(201, $e->getMessage(), null);
        }
    }
}
