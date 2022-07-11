<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Image\ImageRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    protected $postRepo;
    protected $categoryRepo;
    protected $imageRepo;

    public function __construct(
        PostRepositoryInterface $postRepo,
        CategoryRepositoryInterface $categoryRepo,
        ImageRepositoryInterface $imageRepo
    ) {
        $this->postRepo = $postRepo;
        $this->categoryRepo = $categoryRepo;
        $this->imageRepo = $imageRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postRepo->getPostList();

        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys =  $this->categoryRepo->getCategoryListStatusIsShow();

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
        $options = $request->all();
        $options['slug'] = Str::slug($request->name);
        $post = $this->postRepo->create($options);
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
        $categorys = $this->categoryRepo->getCategoryListStatusIsShow();
        $post = $this->postRepo->getPost($id);

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
        $options = $request->all();
        $options['status'] = config('custom.post_status.pending');
        $options['slug'] = Str::slug($request->name);
        $options['is_popular'] = ($request->is_popular == config('custom.post_popular.yes')
            ? config('custom.post_popular.yes') : config('custom.post_popular.no'));
        $post = $this->postRepo->update($id, $options);
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
        $this->postRepo->delete($id);

        return response()->json([
            'code' => 200,
            'message' => __('delete_success'),
        ]);
    }

    public function storeImage($request, $post_id)
    {
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHis') . $file->getClientOriginalName();
            $file->move(public_path('image'), $filename);
            $options['image'] = $filename;
            $options['post_id'] = $post_id;

            $this->imageRepo->create($options);
        }
    }

    public function updateImage($request, $image_id)
    {
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHis') . $file->getClientOriginalName();
            $file->move(public_path('image'), $filename);
            $options['image'] = $filename;

            $this->imageRepo->update($image_id, $options);
        }
    }

    public function postStatus()
    {
        $posts = $this->postRepo->getPostStatusList();

        return view('admin.post-status.index', compact('posts'));
    }

    public function changePostStatus($id, $postStatus)
    {
        $options['status'] = $postStatus;
        $post = $this->postRepo->update($id, $options);
        if (!$post) {
            return response()->json([
                'code' => 400,
                'message' => __('messages.something-wrong')
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => __('messages.update-success')
        ]);
    }

    public function previewPost($slug)
    {
        $categories = $this->categoryRepo->getCategoryListStatusIsShow();
        $post = $this->postRepo->getPostBySlug($slug);
        $postHotinSidebar = $this->postRepo->getPostStatusApprovedList();

        return view('client.post.post-details', compact('categories', 'post', 'postHotinSidebar'));
    }
}
