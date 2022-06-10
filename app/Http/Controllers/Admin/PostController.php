<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category')->get();

        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys =  Category::isShow()->get();

        return view('admin.post.add', compact('categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $post = new Post($request->all());
        $post->slug = Str::slug($request->name);
        $post->save();
        $this->storeImage($request, $post->id);

        return redirect('admin/post');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorys = Category::isShow()->get();
        $post = Post::findOrFail($id);

        return view('admin.post.edit', compact('categorys', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->all();
        $post = Post::findOrFail($id);
        $post->status = config('custom.post_status.pending');
        $post->is_popular = ($request->is_popular == config('custom.post_popular.yes')
            ? config('custom.post_popular.yes') : config('custom.post_popular.no'));
        $post->update($data);
        $this->updateImage($request, $post->images[0]->id);

        return redirect()->route('admin.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function storeImage($request, $post_id)
    {
        $imagePost = new Image();
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHis') . $file->getClientOriginalName();
            $file->move(public_path('image'), $filename);

            $imagePost->image = $filename;
            $imagePost->post_id = $post_id;
            $imagePost->save();
        }
    }

    public function updateImage($request, $image_id)
    {
        $imagePost = Image::findOrFail($image_id);
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHis') . $file->getClientOriginalName();
            $file->move(public_path('image'), $filename);

            $imagePost->image = $filename;
            $imagePost->update();
        }
    }
}
