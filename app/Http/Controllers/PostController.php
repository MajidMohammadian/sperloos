<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\Post\Store as RequestStore;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if(auth()->id()) {
            $data['posts'] = Post::query()->get();

            return view('post.list', $data);
        }

        return redirect()->intended('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws HttpException
     * @throws NotFoundHttpException
     */
    public function create()
    {
        $user_id = auth()->id();

        if($user_id % 2 == 0) {
            return view('post.create');
        } else {
            abort(402, 'User not authorized');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RequestStore  $request
     * @return Response
     */
    public function store(RequestStore $request)
    {
        $form_data = $request->all();

        $post = (new Post);

        $post->title = $form_data['title'];
        $post->content = $form_data['content'];
        $post->image = $post->addFromMediaLibraryRequest($request->get('image'))->toMediaCollection('image');

        $post->save();

        return redirect(route('post.index'))->with('success', 'post created!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     * @throws ModelNotFoundException
     */
    public function show($id)
    {
        $post = Post::query()->findOrFail($id);

        return response()->json($post->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     * @throws ModelNotFoundException
     */
    public function edit($id)
    {
        $post = Post::query()->findOrFail($id);

        return response()->json($post->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     * @throws ModelNotFoundException
     */
    public function update(Request $request, $id)
    {
        $form_data = $request->all();

        $post = Post::query()->findOrFail($id);

        $post->title = $form_data['title'];
        $post->content = $form_data['content'];

        $post->save();

        return response()->json([
            'message' => 'post updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws ModelNotFoundException
     */
    public function destroy($id)
    {
        $post = Post::query()->findOrFail($id);

        $post->delete();

        return response()->json([
            'message' => 'post deleted'
        ]);
    }
}
