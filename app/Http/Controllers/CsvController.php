<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class CsvController extends Controller
{
    public function uploadCsv(Request $request)
    {
      //  dd($request->all());
        $file = file_get_contents($request->file('file')->getRealPath());
        return response()->json($file, 200);
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        dd('validate');
        $file = $request->file('file');
        $path = $file->getRealPath();

        dd($path);
        // $handle = fopen($path, 'r');
        // // Ignorar la primera fila
        // fgetcsv($handle);

        // $doc = [];

        // while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
        //     $doc[] = [
        //         'evento_id' => $row[0],
        //         'tiempo' => $row[1],
        //         'area' => $row[2],
        //         'dispositivo' => $row[3],
        //         'punto' => $row[4],
        //         'descripcion' => $row[5],
        //         'user_id' => $row[6],
        //         'nombre' => $row[7],
        //         'apellido' => $row[8],
        //         'tarjeta' => $row[9],
        //         'dpto_id' => $row[10],
        //         'dpto' => $row[11],
        //         'lector' => $row[12],
        //         'verificacion' => $row[13],
        //     ];
        // }
        // dd($doc);
        // $data = array_map('str_getcsv', file($path));
        // $header = array_shift($data);
        // return Http::response($doc, 200);
        // return back()->with('success', 'Archivo CSV subido y procesado correctamente.');
    }
}
