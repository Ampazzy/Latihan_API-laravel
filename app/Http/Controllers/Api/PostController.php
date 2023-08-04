<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class PostController extends Controller
{
    public function index()
    {
        //ambil semmua data
        $posts = Post::latest()->get();

        //respon berhasil
        return new PostResource(true, 'Success retrieving foods.', $posts);
    }

    public function store(Request $request)
    {
        //buat validasi
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'required',
        ]);

        //kondisi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //buat data
        $post = Post::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        //respon berhasil
        return new PostResource(true, 'Success add food to database.', $post);
    }

    public function show($id)
    {
        //Cari berdasarkan ID
        $post = Post::find($id);

        // Kondisi ketika null
        if (!$post) {
            return response()->json(['message' => 'The given food resource is not found.'], Response::HTTP_NOT_FOUND);
        }

        //respon berhasil
        return new PostResource(true, 'Success retrieving foods.', $post);
    }

    public function update(Request $request, $id)
    {
        //buat validasi
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'required',
        ]);

        //Kondisi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //Cari berdasarkan ID
        $post = Post::find($id);

        //Update data
        $post->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        //respon berhasil
        return new PostResource(true, 'Success update the given food resource.', $post);
    }

    public function destroy($id)
    {

        //Cari berdasarkan ID
        $post = Post::find($id);

        //Hapus data
        $post->delete();

        //respon berhasil
        return new PostResource(true, 'Success delete the given food resource.', null);
    }
}