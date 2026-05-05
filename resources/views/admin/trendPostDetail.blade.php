@extends('admin.layout.index')

@section('content')
    <div class="col-6 offset-3 my-5">
        <div class="card shadow-lg">
            <div><a href="{{ route('admin#TrendPost') }}" class="text-secondary ml-2 fs-4"><i
                        class="fa-solid fa-arrow-left"></i></a>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <img style="width: 200px" class="img-thumbnail shadow-sm"
                        src="{{ asset($post->image ? 'postImage/' . $post->image : 'default/default.jpg') }}" alt="">
                    <hr>
                    <h3 class="mb-5">
                        {{ $post->title }}
                    </h3>
                    <div>
                        {{ $post->description }}
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
@endsection
