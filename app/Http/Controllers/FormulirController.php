<?php

namespace App\Http\Controllers;

use App\Exceptions\UserException;
use Illuminate\Http\Request;
use App\Models\Formulir;
use App\Models\ImageUpload;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Throwable;

class FormulirController extends Controller
{
    public function createFormulir(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "name" => "required|min:4|max:20",
            "email" => "required|email",
            "age" => "required|integer|min:12",
            "height" => "required|numeric|between:2.50,99.99",
            "foto" => [
                'required',
                'file',
                'mimes:png,jpg,jpeg',
                'max:2048',
            ],
        ]);

        if ($validator->fails()) {
            // UserException::throw('Validasi Salah', 400, 400);
            $errors = $validator->errors();
            return response()->json(['errors' => $errors]);
        }

        $photo = ImageUpload::create(
            $request->file('foto'),
            'photos',
            $request->input('name'),
            'photo',
            true
        );

        $photo->upload();

        $formulir = Formulir::create(
            $request->input('name'),
            $request->input('email'),
            $request->input('age'),
            $request->input('height'),
            $photo
        );

        DB::beginTransaction();
        try {
            DB::table('formulir')->upsert([
                'id' => $formulir->getId()->toString(),
                'email' => $formulir->getEmail(),
                'name' => $formulir->getName(),
                'height' => $formulir->getHeight(),
                'age' => $formulir->getAge(),
                'file_location' => $formulir->getPhotoUrl()->full_path
            ], 'id');
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        $response = array(["name" => $formulir->getName(), "photo" => $photo->full_path, "ext" => $request->file('foto')->getClientOriginalExtension()]);

        return $this->successWithData($response, "Berhasil Mengisi Formulir");
    }

    public function listFormulirView(Request $request)
    {
        $ingpo = DB::table('formulir')->get();
        $data = array(
            "ingpo" => $ingpo
        );
        $view = view('livewire.ingpo', $data);
        return $view;
    }
}
