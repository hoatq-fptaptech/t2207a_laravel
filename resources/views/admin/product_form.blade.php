@extends("admin.layout")
@section("main")
    <form action="{{url("/admin/products/create")}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput1">Name</label>
            <input name="name" type="text"  class="form-control" placeholder="">
        </div>
        <div class="form-group">
            <label for="exampleFormControlFile1">Thumbnail</label>
            <input type="file" name="thumbnail" class="form-control-file" id="exampleFormControlFile1">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Price</label>
            <input name="price" type="number"  class="form-control" placeholder="">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Qty</label>
            <input name="qty" type="number"  class="form-control" placeholder="">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Category</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Description</label>
            <textarea class="form-control" name="description"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection
