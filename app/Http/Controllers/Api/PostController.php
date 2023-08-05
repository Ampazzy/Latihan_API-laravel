<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Http\Resources\PostResource;
use App\Http\Resources\PostDetail;
use App\Http\Resources\PostCreate;
use App\Http\Resources\PostUpdate;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();

        return new PostResource($posts);
    }

    public function store(Request $request)
    {
        //Validasi
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'required',
        ]);

        //Kondisi gagal
        if ($validator->fails()) {
            $errors = $validator->errors();

            // Ubah format pesan error menjadi array
            $errorMessages = [];
            foreach ($errors->all() as $message) {
                $errorMessages[] = $message;
            }

            // Buat format respons yang diinginkan
            $response = [
                'message' => 'The given data was invalid.',
                'errors' => $errors->messages(),
            ];

            return response()->json($response, 422);
        }


        //Create
        $post = Post::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        //respon berhasil
        return new PostCreate($post);
    }

    public function show($id)
    {
        try {
            $post = Post::findOrFail($id);
            return new PostDetail($post);

            //Kondis tidak ketemu
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'The given food resource is not found.'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        //Validasi
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'required',
        ]);

        //Kondisi gagal
        if ($validator->fails()) {
            $errors = $validator->errors();

            // Ubah format pesan error menjadi array
            $errorMessages = [];
            foreach ($errors->all() as $message) {
                $errorMessages[] = $message;
            }

            // Buat format respons yang diinginkan
            $response = [
                'message' => 'The given data was invalid.',
                'errors' => $errors->messages(),
            ];

            return response()->json($response, 422);
        }

        try {
            $post = Post::findOrFail($id);

            //Update data
            $post->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
            ]);

            return new PostUpdate($post);

            //Kondis tidak ketemu
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'The given food resource is not found.'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);

            //Hapus data
            $post->delete();
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'The given food resource is not found.'], 404);
        }
    }
}