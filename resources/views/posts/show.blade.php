@extends('layouts.app')


    @section('title')
        Show
    @endsection

    @section('content')
        <div class="card mt-4">
            <h5 class="card-header">post info</h5>
            <div class="card-body">
                <h5 class="card-title">Title: {{$post['title']}} </h5>
                <p class="card-text">Description: {{$post['description']}}</p>
            </div>
        </div>
        <div class="card mt-4">
            <h5 class="card-header">post creator info</h5>
            <div class="card-body">        
                <h5 class="card-title">name:{{$post->user ? $post->user->name : 'Not found'}}</h5>
                <p class="card-text">Email:{{$post->user ? $post->user->email: 'Not found'}}</p>
                <p class="card-text">created at: {{$post->user ? $post->user->created_at: 'Not found'}}</p>
            </div>

    @endsection
