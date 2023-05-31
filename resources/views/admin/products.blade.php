@extends("admin.layout")
@section("main")
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Responsive Hover Table</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append">
                                <a href="{{url("/admin/products/create")}}" class="btn btn-outline-primary">
                                   Create new product
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Thumbnail</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Category</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td><img src="{{$item->thumbnail}}" class="img-thumbnail" width="100"/> </td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->qty}}</td>
                                <td>{{$item->Category->name}}</td>
                                <td>
                                    <a href="{{url("/admin/products",["product"=>$item->id])}}" class="btn btn-outline-info">Edit</a>
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
@endsection
