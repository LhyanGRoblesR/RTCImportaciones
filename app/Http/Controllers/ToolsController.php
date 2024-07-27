<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Mail\VerifiedEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use PDF;

class ToolsController extends Controller
{
    public function validateDocument(Request $request){

        if (($request->document_type === 'dni' && ($request->id_document_types != 1 || !preg_match('/^\d{8}$/', $request->document))) || ($request->document_type === 'ruc' && !preg_match('/^\d{11}$/', $request->document))){

            $response = [
                'success' => false,
                'message' => 'El documento no cumple los requisitos para ser validado.'
            ];

            return json_encode($response);

        } else {

            $url = 'https://apiperu.dev/api/'.$request->document_type.'/'.$request->document.'?api_token=b63f9aa5bd82eec1504ecb0656835c6e9b00284835b64effac6175b4b6790edc';

            $response = Http::get($url);

            return $response;

        }
    }

    public function testing(Request $request){

        $data = [
            'titulo' => 'Styde.net'
        ];

        $pdf = PDF::loadView('templates.quotesPDF', $data);

        // Generar el PDF
        $pdfContent = $pdf->output();

        // Crear una respuesta HTTP con encabezados para la visualización del PDF
        return Response::make($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="archivo.pdf"'
        ]);
    }


}
