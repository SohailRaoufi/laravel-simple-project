<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;

class NewsPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Post::all();

        $dataArray = compact('data');
        return view('admin/admin')->with($dataArray);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $url = url('user/admin/addnewpost');
        $title = 'Create New Post';
        $data = compact('url', 'title');
        return view('admin/add_new_post')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        session_start();
        $validatedData = $request->validate(
            [
                'title' => 'required|max:255',
                'body' => 'required',
                'image' => 'required',
            ]
        );

        $existingPost = Post::where('title', $validatedData['title'])->first();
        if ($existingPost) {
            session()->flash('error', 'Post Already Exits!.');
            return redirect()->back();
        }

        //taking the requrest content from form
        $title = $request['title'];
        $body = $request['body'];
        $image = $request['image'];
        $originalName = $image->getClientOriginalName();
        $imagePath = $image->storeAs('post_images', $originalName, 'public');
        $addedby = $_SESSION['name'];

        //checking image for size and extenstion.
        $allowed_ext = ['png', 'webp', 'jpeg'];

        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];

        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));

        if (in_array($file_ext, $allowed_ext)) {
            if ($file_size <= 5000000) {
                //saving data to database.
                $post = new Post();
                $post->title = $title;
                $post->body = $body;
                $post->image = $imagePath;
                $post->added_By = $addedby;
                $post->save();

                //redirecting admin to main admin page.
                session()->flash('success', 'Data Added successfully.');
                return redirect('/user/admin');
            } else {
                session()->flash('error', 'Image Size must be less than 5 mb!');
                return redirect()->back();
            }
        } else {
            session()->flash('error', 'Alowed Types are PNG , JPEG and WEBP!!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource to user.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        if (!is_null($post)) {
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at);
            $formattedDate = $date->format('d - M - Y');
            $data = compact('post', 'formattedDate');
            return view('read_more_post/read_more_post')->with($data);
        } else {
            return abort(404, 'Not Found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if (is_null($post)) {
            //Post Not Found
            return redirect('user/admin');
        } else {
            //Post Found!
            $title = 'Update Post';
            $url = url('user/admin/posts/update') . '/' . $id;
            $data = compact('post', 'url', 'title');
            return view('admin/add_new_post')->with($data);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate(
            [
                'title' => 'required|max:255',
                'body' => 'required',
                'image' => 'required',
            ]
        );

        // $existingPost = Post::where('title', $validatedData['title'])->first();
        // if ($existingPost) {
        //     session()->flash('error', 'Post Already Exits!.');
        //     return redirect()->back();
        // }

        $post = Post::find($id);
        //taking the requrest content from form
        $title = $request['title'];
        $body = $request['body'];
        $image = $request['image'];
        $originalName = $image->getClientOriginalName();
        $imagePath = $image->storeAs('post_images', $originalName, 'public');

        $post->title = $title;
        $post->body = $body;
        $post->image = $imagePath;
        $post->save();

        session()->flash('success', 'Post Update Successfully!');
        return redirect('user/admin');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if (!is_null($post)) {
            $post->delete();
            session()->flash('success', 'Data deleted successfully.');
        }

        return redirect('/user/admin');
    }
}
