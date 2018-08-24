<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\Post;
use App\Helper;
use App\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('published_at', 'asc')->paginate(30);
        return view('backend.pages.blog.posts', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = Post::firstOrNew([
            'title'=>'This is my new great post',
            'type' => 'default',
        ]);
        $post->save();
        return view('backend.pages.blog.createpost', [
            'post' => $post,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $authors = User::whereHas('roles', function ($query) {
            $query->whereIn('id', [1,2,3,4]);
        })->get();

        return view('backend.pages.blog.createpost', [
            'authors' => $authors,
            'post'    => $post,
        ]);
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

        $columns = Schema::getColumnListing((new Post)->getTable());

        foreach ($request->all() as $field => $value) {
            if (($field != '_token') && (in_array($field, $columns))) {
                $post->$field = $value;
            }
        }

        $post->save();

        return redirect()->back()->with([
            'message' => [
                'text' => 'Field correctly saved.',
                'type' => 'success',
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    /**
     * [cloudinaryAction description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function cloudinaryAction(Request $request) {

        $cloudinary = \Cloudder::getApi();
        // return $request->all();
        if ($request->input('action', false) == 'allimages') {

            if ($request->input('search', false) && !empty($request->input('search'))) {
                $items = $cloudinary->resources_by_tag(str_replace(' ', '', $request->input('search')), [
                    'next_cursor' => $request->input('next_cursor', ''),
                    'with_field'  => 'tags',
                    'direction'   => 'desc',
                    'max_results' => 8,
                ]);
            } else {
                $items = $cloudinary->resources([
                    'next_cursor' => $request->input('next_cursor', ''),
                    'with_field'  => 'tags',
                    'direction'   => 'desc',
                    'max_results' => 8,
                ]);
            }

            foreach ($items['resources'] as $i) {
                $results[] = [
                    'image_tag'  => cl_image_tag($i['public_id'], array("width"=>180, "height"=>180, "crop"=>"fit")),
                ];
            }

            return [
                'resources'   => $results,
                'next_cursor' => $items['next_cursor'],
            ];
        }
    }

    /**
     * [getSlug description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getSlug(Request $request) {
        return str_slug($request->input('q', false));
    }

    public function tag(Request $request, Post $post)
    {

        $tagType = $request->input('tagType');

        $tags = [];
        foreach (explode(',', $request->input('tags')) as $c) {
            $tags[] = trim($c);
        };

        Helper::tag($tagType, $tags, $post, true);

        return redirect()->back()->with([
            'message' => [
                'text' => 'Category ' . $tagType . ' updated',
                'type' => 'success',
            ]
        ]);

    }
}
