@extends('layout.mainlayout')

@section('content')
    <div class="container">
        @if(count($posts))
            <div class="float-end">
                <a href="{{ route('profile', ['sort' => $sort]) }}">Sort by publish date</a>
            </div>
        @endif
        <div class="row">
            @foreach ($posts as $post)
                <div class="post-preview">
                    <h3 class="post-title">{{ $post->title }}</h3>
                    <h5 class="post-subtitle">{{ $post->description }}</h5>
                    <p class="post-meta">
                        Posted by
                        {{ $post->user->name }}
                        on {{date('d-m-Y', strtotime($post->created_at))}}
                    </p>
                </div>
                <hr class="my-4"/>
            @endforeach
            {!! $posts->links() !!}
        </div>
        <div class="row">
            <h1>Create Post</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <form action="{{ url('posts') }}" class="form" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" cols="3" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary mt-2">Save</button>
                </div>
            </form>
        </div>
@endsection
