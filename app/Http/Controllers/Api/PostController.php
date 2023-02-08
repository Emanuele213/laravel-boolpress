<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate();

        return response()->json([
            'success' => true,
            'results' => $posts,
        ]);
    }

    public function show($post)
    {
        $post = Post::where('slug', $post)->with(['category', 'tags'])->first();

        if($post) {
            return response()->json([
                'success' => true,
                'results' => $post,
            ]);
        }else {
            return response()->json([
                'success' => false,
            ]);
        }


    }

    public function random() {
        $posts = Post::inRandomOrder()->limit(9)->get();

        return response()->json([
            'success' => true,
            'results' => $posts,
        ]);
    }

}
