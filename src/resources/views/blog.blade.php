@extends('layouts.app')
@php
    $isDetail = Route::currentRouteName() === 'blog.detail';
@endphp
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
            @endforeach
            <div class="d-grid d-md-flex justify-content-md-end">
                @if($isDetail)
                <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-outline-primary">{{ __('Edit') }}</a>
                @else
                <a href="javascript:document.form.submit()" class="btn btn-outline-primary">{{ __('Register') }}</a>
                @if($blog->exists)
                <a href="{{ route('blog.delete', $blog->id) }}" class="btn btn-outline-danger">{{ __('Delete') }}</a>
                @endif
                @endif
            </div>
            <div class="card">
                <form method="POST" action="{{ route('blog.register', $blog->id ?? null) }}" name="form">
                    @csrf
                    @if($isDetail || !$blog->exists)
                    <div class="card-header">
                        <h4>{{ __('Post Date') }}</h4>
                        @if($isDetail)
                        {{ $blog->post_date->format('Y/m/d') }}
                        @else
                        <input
                        type="text"
                        name="post_date"
                        value="{{ old('post_date') }}"
                        class="form-control" />
                        @endif
                    </div>
                    @endif
                    <div class="card-header">
                        <h4>{{ __('Title') }}</h4>
                        @if($isDetail)
                        {{ $blog->title }}
                        @else
                        <input
                        type="text"
                        name="title"
                        value="{{ old('title', $blog->title)}}"
                        class="form-control" />
                        @endif
                    </div>
                    <div class="card-body">
                        <h4>{{ __('Content') }}</h4>
                        @if($isDetail)
                        {!! nl2br(e($blog->content)) !!}
                        @else
                        <textarea
                        name="content"
                        class="form-control"
                        rows="8">{{old('content', $blog->content)}}</textarea>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
