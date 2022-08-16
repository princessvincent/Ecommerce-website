@php
   if(Auth::user()->role_as == '0')
   {
      return redirect('/')->with('status','Access Denied! as you are not as admin');
   }
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
       Edit Category
    </title>
    @extends('layouts.head')
    @section('content')
        <div class="card">

        
            <div class="card-header">
                <h4>Edit Category</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('updatecat/'.$edit->id) }}" method="Post" enctype="multipart/form-data">
                @csrf
                {{-- @method('put') --}}
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">name</label>
                            <input type="text" value="{{ $edit->name }}" class="form-control" name="name">
                        </div>
                        <div class="col-md-6">
                            <label for="">slug</label>
                            <input type="text"   value="{{ $edit->slug }}"class="form-control" name="slug">
                        </div>
                        <div class="col-md-12">
                            <label for="">Description</label>
                            <textarea name="description" rows="5" class="form-control">{{ $edit->description }}</textarea>
                        </div>
                         <div class="col-md-6">
                            <label for="">Meta Title</label>
                            <input type="text"   value="{{ $edit->meta_title }}" name="meta_title" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="">Meta Keywords</label>
                            <input name="meta_keywords"  value="{{ $edit->meta_keywords }}" type="text" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="">Meta Description</label>
                            <input name="meta_descrip"  value="{{ $edit->meta_descrip }}" type="text" class="form-control">
                        </div>
                        <div class="col-md-6">
                                    <input id="image" type="file" class="form-control"  name="image" accept="image/*">
                                    <img src="{{ asset('img/category/'.$edit->image) }}" width='50'height='50' class="img img-responsive" />
                                </div>
                        <div class="col-md-6">
                            <label for="">Status</label>
                            <input type="checkbox" {{ $edit->status == '1'? "checked" : "" }} name="status">
                        </div>
                        <div class="col-md-6">
                            <label for="">Popular</label>
                            <input type="checkbox" {{ $edit->popular == '1'? "checked" : "" }} name="popular">
                        </div>
                        <div class="col-md-12">
                            <button type="submit" name="submit" class="btn btn-primary">Update Category</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    @endsection
    </body>

</html>
