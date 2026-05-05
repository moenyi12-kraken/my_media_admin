@extends('admin.layout.index')

@section('content')
    <div class="col-12">
        <div class="card">
            @session('deleteSuccess')
                <div class="alert alert-danger alert-dismissible fade show col-4" role="alert">
                    {{ Session::get('deleteSuccess') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endsession
            <div class="card-header">
                <h3 class="card-title">Admin List Table</h3>

                <div class="card-tools">
                    <form action="{{ route('admin#AdminListSearch') }}" method="POST">
                        @csrf
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
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($adminList as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->address }}</td>
                                <td>{{ $item->gender }}</td>
                                <td>
                                    {{-- <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button> --}}
                                    @if ($item->id != Auth::user()->id)
                                        <form action="{{ route('admin#AdminListDelete', $item->id) }}" method="get">
                                            @csrf
                                            <button type="submit" class="btn btn-sm bg-danger text-white"><i
                                                    class="fas fa-trash-alt"></i></button>

                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
