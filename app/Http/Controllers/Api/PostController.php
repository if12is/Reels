<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class PostController extends Controller
{
    use ApiResponseTrait;
    /**
     *
     * Get All Posts without details Test to fetch  data
     *
     */
    public function index()
    {
        $posts = PostResource::collection(Post::get());
        return $this->apiResponse($posts, 'Ok', 200);
    }
    /**
     *
     * Create a New Post
     *
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts',
            'body' => 'required',
            'category_id' => 'required',
        ]);


        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }

        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
        ]);

        if ($post) {
            return $this->apiResponse(new PostResource($post), 'The Post Created Successfully', 201);
        }
        return $this->apiResponse(null, 'The Post Can\'t created successfully', 400);
    }

    /**
     *
     * Get Post with details by using {id}
     *
     */
    public function show($id)
    {
        $post = Post::find($id);
        if ($post) {
            return $this->apiResponse(new PostResource($post), 'Ok', 200);
        }
        return $this->apiResponse(null, 'Data Not Found', 404);
    }
    /**
     *
     * Update In Any Post by id
     *
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts',
            'body' => 'required',
            // 'user_id' => 'required',
            'category_id' => 'required',
        ]);


        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }

        $post = Post::find($id);
        if (!$post) {
            return $this->apiResponse(null, 'The Post Not Found', 404);
        }

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
        ]);


        if ($post) {
            return $this->apiResponse(new PostResource($post), 'The Post Updated Successfully', 200);
        }
        return $this->apiResponse(null, 'The Post Can\'t Updated', 400);
    }
    /**
     *
     * Delete Any Post by id
     *
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return $this->apiResponse(null, 'The Post Not Found', 404);
        }


        $post->delete($id);
        if ($post) {
            return $this->apiResponse(null, 'The Post Deleted Successfully', 200);
        }
    }
    /**
     *
     * Create a New comment In Post
     *
     */
    public function storeComment(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'body' => 'required',
            'post_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }

        $comment = Comment::create([
            'body' => $request->body,
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
        ]);

        if ($comment) {
            return $this->apiResponse($comment, 'The Comment Created Successfully', 201);
        }
        return $this->apiResponse(null, 'The Post Can\'t created successfully', 400);
    }
    /**
     *
     * Update comment In Post
     *
     */
    public function updateComment(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'body' => 'required',
            'post_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }

        $comment = Comment::find($id);

        if (!$comment) {
            return $this->apiResponse(null, 'The Comment Not Found', 404);
        }
        $comment->update([
            'body' => $request->body,
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
        ]);

        if ($comment) {
            return $this->apiResponse($comment, 'The Comment Updated Successfully', 200);
        }
        return $this->apiResponse(null, 'The Comment Can\'t Updated', 400);
    }
    /**
     *
     * Delete comment In Post by id
     *
     */
    public function deleteComment($id)
    {


        $comment = Comment::find($id);

        if (!$comment) {
            return $this->apiResponse(null, 'The Comment Not Found', 404);
        }
        $comment->delete($id);

        if ($comment) {
            return $this->apiResponse($comment, 'The Comment Deleted Successfully', 200);
        }
    }
    /**
     *
     * Get All Post Details(like and comment count)
     *
     */
    public function AllPostsDetails()
    {
        $posts = Post::withCount('likes', 'comments')->get();
        return $this->apiResponse($posts, 'Ok', 200);
    }
    //
    /**
     *
     * Get Post Details(like and comment count) by $id
     *
     */
    public function userPosts($id)
    {
        $Post = Post::withCount('likes', 'comments')->where('id', '=', $id)->get();
        if (!$Post->isEmpty()) {
            return $this->apiResponse($Post, 'Ok', 200);
        }
        return $this->apiResponse(null, 'This post Not found.', 404);
    }
    /**
     *
     * Get Comments of the post by $id
     *
     */
    public function commentPost($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return $this->apiResponse(null, 'This post Not found.', 200);
        }
        $comments = $post->comments;
        // To count number of comments
        $total = $comments->count($id);

        if ($total < 1) {
            return $this->apiResponse(null, 'This post has no comments.', 404);
        }

        if ($comments) {
            return $this->apiResponse($comments, 'Ok', 200);
        }
    }
    /**
     *
     * Get likes of the post by $id
     *
     */
    public function userLike($id)
    {
        $post = Post::find($id);
        return $post->likes;
    }
    /**
     *
     * Get All Categories and show all same category posts
     *
     */
    public function postsCategory()
    {
        $category = Category::with('posts')->get();
        return $category;
    }
    /**
     *
     * Get All Category Posts by id of category_id
     *
     */
    public function postsIdCategory(Category $category)
    {
        $category = $category->posts;
        if (!$category->isEmpty()) {
            return $this->apiResponse($category, 'Ok', 200);
        }
        return $this->apiResponse(null, 'This Category Don\'t have posts', 404);
    }
    /**
     *
     * Put like
     *
     */
    public function likersAction(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'post_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }

        $like = Like::create([
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
        ]);
        return $this->apiResponse($like, 'Like done add', 200);
    }
    /**
     *
     * Remove like
     *
     */
    public function deleteLike($id)
    {
        $like = Like::find($id);
        if (!$like) {
            return $this->apiResponse(null, 'You Are Not Like In This post.', 200);
        }
        $like->delete($id);
        return $this->apiResponse($like, 'Like done Removed', 200);
    }
}
