<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Jurusan;
use App\ProgramStudi;
use App\Konseling;
use App\Konselor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use DateInterval;
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
            $konseling = Konseling::where('mhs_id',$request->mhs_id);
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

    public function store(Request $request){
        $this->validate($request, [            
            'konselor_id' => 'required|integer',
            'waktu_mulai' => 'required|date_format:Y-m-d H:i:s|after:now',
            'deskripsi' => 'required|string',
            'tempat' => 'required|string',
        ]);
        try{            
            $user = Auth::User();
            $mahasiswa = $user->mahasiswa;
            $konselor = Konselor::findOrFail($request->konselor_id);
            $konseling = new Konseling;            
            $konseling->fill($request->all());
            $konseling->mhs_id = $mahasiswa->id;
            $konseling->konselor_id = $konselor->id;
            $konseling->status = 'created';
            $waktuMulai = new DateTime($request->waktu_mulai);
            $konseling->waktu_mulai = $waktuMulai->format('Y-m-d H:i:s');
            $waktuSelesai = $waktuMulai->add(new DateInterval('PT' . 60 . 'M'));
            $konseling->waktu_selesai = $waktuSelesai->format('Y-m-d H:i:s');            
            $konseling->save();
            return $this->apiResponse(200, 'success', ['konseling' => $konseling]);
        }catch (\Exception $e) {
            return $this->apiResponse(201, $e->getMessage(), null);
        }                    
    }
}
