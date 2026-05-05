@extends('admin.layout.index')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Trend Post Table</h3>

                <div class="card-tools">
                    <form action="{{ route('admin#TrendPost') }}" method="get">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="searchKey" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>View</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (count($posts) == 0)
                            <tr>
                                <td colspan="7">There is no data..</td>
                            </tr>
                        @else
                            @foreach ($posts as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td><img style="width: 100px"
                                            src="{{ asset($item->image != null ? 'postImage/' . $item->image : 'default/default.jpg') }}">
                                    </td>
                                    <td>{{ $item->view_count }}</td>
                                    <td>
                                        <a href="{{ route('admin#TrendPostDetail', $item->id) }}"
                                            class="btn btn-sm btn-outline-secondary rounded"><i
                                                class="fa-solid fa-circle-info"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>

                <div class="d-flex justify-content-end mt-2 mr-3">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
