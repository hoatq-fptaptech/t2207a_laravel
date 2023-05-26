@extends("admin.layout")
@section("main")
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Responsive Hover Table</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
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
                            <th>Guest</th>
                            <th>Created At</th>
                            <th>Phone</th>
                            <th>Payment method</th>
                            <th>Is Paid</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->firstname. " ".$item->lastname}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{$item->payment_method}}</td>
                                <td>
                                    @if($item->is_paid)
                                        <span class="text-success">Paid</span>
                                    @else
                                        <span class="text-danger">unPaid</span>
                                    @endif
                                </td>
                                <td>
                                    @switch($item->status)
                                        @case(0)<span class="text text-dark">Pending</span>@break
                                        @case(1)<span class="text text-blue">Confirmed</span>@break
                                        @case(2)<span class="text text-warning">Shipping</span>@break
                                        @case(3)<span class="text text-warning">Shipped</span>@break
                                        @case(4)<span class="text text-success">Completed</span>@break
                                        @case(5)<span class="text text-warning">Cancel</span>@break
                                    @endswitch
                                </td>
                                <td>
                                    <a href="#" class="btn btn-outline-info">View</a>
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
