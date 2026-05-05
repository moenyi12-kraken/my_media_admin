@extends('admin.layout.index')

@section('content')
    <div class="col-10 offset-1">
        <div class="row">
            <div class="col-4 ">
                <form action="{{ route('admin#CategoryUpdate', $category->id) }}" method="POST">
                    @csrf
                    <div class="div">
                        Title: <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $category->title) }}" placeholder="Enter Title..">

                        Description
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30"
                            rows="5" id="" placeholder="Enter Description">{{ old('description', $category->description) }}</textarea>

                        <input type="submit" value="Update" class="btn btn-primary mt-2">
                        <a href="{{ route('admin#Category') }}"><input type="button" value="Back to Create"
                                class="btn btn-dark mt-2"></a>
                    </div>
                </form>
            </div>
            <div class="col-lg-8 col-md-6 col-10 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Category Table</h3>

                        <div class="card-tools">
                            <form action="{{ route('admin#Category') }}" method="GET">

                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="searchKey" class="form-control float-right"
                                        placeholder="Search by Title" value="{{ request('searchKey') }}">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($categories as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ Str::words($item->description, '6', '...') }}</td>
                                        <td>
                                            <a href="{{ route('admin#CategoryEdit', $item->id) }}"
                                                class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></a>
                                            @if ($category->id != $item->id)
                                                <a href="{{ route('admin#CategoryDelete', $item->id) }}"
                                                    class="btn btn-sm bg-danger text-white"><i
                                                        class="fas fa-trash-alt"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
