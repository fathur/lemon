<?php

namespace App\Http\Controllers;

use App\Model\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    private $rules = [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->grant('view-post');

        return view('post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->grant('create-post');

        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->grant('create-post');

        \Validator::make($request->all(), $this->rules)
            ->validate();

        $post = new Post();
        $post->author_id = \Auth::user()->id;
        $post->active = $request->has('active') ? true : false;
        $post->title = $request->get('title');
        $post->slug = Str::slug($request->get('title'));
        $post->content = $request->get('content');
        $post->release_date = $request->get('release_date');
        $post->save();

        return redirect()->route('posts.index')
            ->with('success', 'Post ' . $request->get('title') . ' successfully created.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->grant('edit-post');

        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->grant('edit-post');

        \Validator::make($request->all(), $this->rules)
            ->validate();

        $post->active = $request->has('active') ? true : false;
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->release_date = $request->get('release_date');
        $post->save();

        return redirect()->back()
            ->with('success', 'Post ' . $request->get('title') . ' successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->grant('delete-post');

        return (int)$post->delete();
    }

    /**
     * @return mixed
     *
     * @author Fathur Rohman <hi.fathur.rohman@gmail.com>
     */
    public function data()
    {
        $this->grant('view-post');

        return \Datatables::of(Post::select('*'))
            ->addColumn('author', function($data) {
                return $data->author->name;
            })
            ->addColumn('action', function ($post) {
                return view('layouts.actions.1')
                    ->with('action', [
                        'name'    => $this->name,
                        'edit'    => route('posts.edit', $post->id),
                        'destroy' => route('posts.destroy', $post->id)
                    ])
                    ->with('ability', [
                        'edit'   => 'edit-post',
                        'delete' => 'delete-post'
                    ])
                    ->render();
            })
            ->make(true);
    }
}
