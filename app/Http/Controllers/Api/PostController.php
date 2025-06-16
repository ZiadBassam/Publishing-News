<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(): JsonResponse
    {
        try {
            $posts = $this->postService->getAllPosts();

            return response()->json([
                'data' => $posts,
                'message' => 'All posts retrieved successfully',
                'status' => true,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'data' => null,
                'message' => 'Failed to retrieve posts: ' . $e->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        try {
            $post = $this->postService->getPostById($id);

            return response()->json([
                'data' => $post,
                'message' => 'Post retrieved successfully',
                'status' => true,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'data' => null,
                'message' => 'Post not found',
                'status' => false,
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'data' => null,
                'message' => 'Failed to retrieve post: ' . $e->getMessage(),
                'status' => false,
            ], 500);
        }
    }



    public function getAllUsers(): \Illuminate\Http\JsonResponse
    {
        try {
            $users = $this->postService->getAllUsers();

            return response()->json([
                'data' => $users,
                'message' => 'All users retrieved successfully',
                'status' => true,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'data' => null,
                'message' => 'Failed to retrieve users: ' . $e->getMessage(),
                'status' => false,
            ], 500);
        }
    }


    public function store(PostRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $post = $this->postService->createPost($request->validated());

            return response()->json([
                'data' => $post,
                'message' => 'Post created successfully',
                'status' => true,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'data' => null,
                'message' => 'Failed to create post: ' . $e->getMessage(),
                'status' => false,
            ], 500);
        }
    }




    public function update(PostRequest $request, $id): \Illuminate\Http\JsonResponse
    {
        try {
            $post = $this->postService->updatePost($id, $request->validated());

            return response()->json([
                'data' => $post,
                'message' => 'Post updated successfully',
                'status' => true,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'data' => null,
                'message' => 'Post not found',
                'status' => false,
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'data' => null,
                'message' => 'Failed to update post: ' . $e->getMessage(),
                'status' => false,
            ], 500);
        }
    }



    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        try {
            $this->postService->deletePost($id);

            return response()->json([
                'data' => null,
                'message' => 'Post deleted successfully',
                'status' => true,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'data' => null,
                'message' => 'Post not found',
                'status' => false,
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'data' => null,
                'message' => 'Failed to delete post: ' . $e->getMessage(),
                'status' => false,
            ], 500);
        }
    }
}
