<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Iklan; 

class IklanController extends Controller
{
    public function index()
    {
    	try{
	        $data["count"] = Iklan::count();
	        $iklan = array();

	        foreach (Iklan::all() as $p) {
	            $item = [
                    "id"            => $p->id,
	                "judul"         => $p->judul,
	                "deskripsi"     => $p->deskripsi,
	                "harga"         => $p->harga,
                    "gambar"    	=> $p->gambar,
                    "lokasi"    	=> $p->lokasi,
	                "created_at"    => $p->created_at,
	                "updated_at"    => $p->updated_at
	            ];

	            array_push($iklan, $item);
	        }
	        $data["iklan"] = $iklan;
	        $data["status"] = 1;
	        return response($data);

	    } catch(\Exception $e){
			return response()->json([
			  'status' => '0',
			  'message' => $e->getMessage()
			]);
      	}
    }

    public function getAll($limit = 10, $offset = 0)
    {
    	try{
	        $data["count"] = Iklan::count();
	        $iklan = array();

	        foreach (Iklan::take($limit)->skip($offset)->get() as $p) {
	            $item = [
                    "id"            => $p->id,
	                "judul"         => $p->judul,
	                "deskripsi"     => $p->deskripsi,
	                "harga"         => $p->harga,
                    "gambar"    	=> $p->gambar,
                    "lokasi"    	=> $p->lokasi,
	                "created_at"    => $p->created_at,
	                "updated_at"    => $p->updated_at
	            ];

	            array_push($iklan, $item);
	        }
	        $data["iklan"] = $iklan;
	        $data["status"] = 1;
	        return response($data);

	    } catch(\Exception $e){
			return response()->json([
			  'status' => '0',
			  'message' => $e->getMessage()
			]);
      	}
    }

    public function store(Request $request)
    {
      try{
    		$validator = Validator::make($request->all(), [
                'judul'         => 'required|string|max:255',
                'deskripsi'	    => 'required|string|max:255',
                'harga'			=> 'required|string|max:255',
                'gambar'         => 'required|string|max:255',
                'lokasi'         => 'required|string|max:255',
    		]);

    		if($validator->fails()){
    			return response()->json([
    				'status'	=> 0,
    				'message'	=> $validator->errors()
    			]);
    		}

    		$data = new Iklan();
	        $data->judul = $request->input('judul');
            $data->deskripsi = $request->input('deskripsi');
            $data->harga = $request->input('harga');
            $data->gambar = $request->input('gambar');
            $data->lokasi = $request->input('lokasi');
	        $data->save();

    		return response()->json([
    			'status'	=> '1',
    			'message'	=> 'Data berhasil ditambahkan!'
    		], 201);

      } catch(\Exception $e){
            return response()->json([
                'status' => '0',
                'message' => $e->getMessage()
            ]);
        }
  	}


    public function update(Request $request, $id)
    {
      try {
      	$validator = Validator::make($request->all(), [
			'judul'         => 'required|string|max:255',
			'deskripsi'	    => 'required|string|max:255',
            'harga'			=> 'required|string|max:255',
            'gambar'         => 'required|string|max:255',

		]);

      	if($validator->fails()){
      		return response()->json([
      			'status'	=> '0',
      			'message'	=> $validator->errors()
      		]);
      	}

      	//proses update data
      	$data = Iklan::where('id', $id)->first();
        $data->judul = $request->input('judul');
        $data->deskripsi = $request->input('deskripsi');
        $data->harga = $request->input('harga');
        $data->gambar = $request->input('gambar');
        $data->save();

      	return response()->json([
      		'status'	=> '1',
      		'message'	=> 'Data berhasil diubah'
      	]);
        
      } catch(\Exception $e){
          return response()->json([
              'status' => '0',
              'message' => $e->getMessage()
          ]);
      }
    }

    public function delete($id)
    {
        try{

            $delete = Iklan::where("id", $id)->delete();

            if($delete){
              return response([
              	"status"	=> 1,
                  "message"   => "Data berhasil dihapus."
              ]);
            } else {
              return response([
                "status"  => 0,
                  "message"   => "Data gagal dihapus."
              ]);
            }
        } catch(\Exception $e){
            return response([
            	"status"	=> 0,
                "message"   => $e->getMessage()
            ]);
        }
    }
}
