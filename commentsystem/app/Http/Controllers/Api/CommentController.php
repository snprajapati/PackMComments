<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiBaseController;
use App\Models\Comment;
use Illuminate\Http\Request;
use Validator;

class CommentController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $comments = Comment::with('children')
            ->whereNull('parent_id')
            ->orderByDesc('created_at')
            ->get();  
            
            $response['data'] = $comments;
            $response['status_code'] = 200;
            $response['message'] = '';

            return $this->successResponse($response);
        } catch (\Exception $exception) {
            
            $response['data'] = [];
            $response['status_code'] = 500;
            $response['message'] = 'something went to wrong!';

            return $this->errorResponse($response, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            
            $validator = Validator::make($request->all(), [
                'user' => 'required',
                'content' => 'required',
            ]);

            if ($validator->fails()) {
                $response['data'] = $validator->errors();
                $response['status_code'] = 403;
                $response['message'] = 'Bad Request!';

                return $this->errorResponse($response, 500);
            }
               
            $comment = new Comment();
            $comment->user = strip_tags($request->user);
            $comment->post_id = 1;
            $comment->parent_id = $request->parent_id ?? null;
            $comment->content = strip_tags($request->content);
            $response = [];

            if($comment->save()) {
                $response['data'] = $comment;
                $response['status_code'] = 200;
                $response['message'] = 'Comment added successfully!';

                return $this->successResponse($response);

            } else {
                $response['data'] = [];
                $response['status_code'] = 500;
                $response['message'] = 'something went to wrong!';

                return $this->errorResponse($response, 500);
            }

        } catch (\Exception $exception) {
            dd($exception->getMessage());
            $response['data'] = [];
            $response['status_code'] = 500;
            $response['message'] = 'something went to wrong!';

            return $this->errorResponse($response, 500);
        }
    }
}
