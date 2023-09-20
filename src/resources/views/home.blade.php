@extends('layouts.app')

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
                <a href="{{ route('blog.post') }}" class="btn btn-outline-primary">{{ __('Post Blog') }}</a>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Blog List') }}</div>
                <div class="card-body">
                    <div class="list-group">
                        @forelse ($blogs as $blog)
                        <a href="{{ route('blog.detail', $blog->id) }}" class="list-group-item list-group-item-action list-group-item-light">
                            <div class="row">
                                <div class="col-12"><h3>{{ $blog->title }}</h3></div>
                                <div class="col-6">{{ __('Post Date') }}:&nbsp;{{ $blog->post_date->format('Y/m/d') }}</div>
                                <div class="col-6">{{ __('Update Date') }}:&nbsp;{{ $blog->updated_at->format('Y/m/d H:i:s') }}</div>
                            </div>
                        </a>
                        @empty
                            {{ __('No contents') }}
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
