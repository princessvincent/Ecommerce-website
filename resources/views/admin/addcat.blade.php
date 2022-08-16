<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
       E-shop
    </title>
    @extends('layouts.head')
    @section('content')
        <div class="card">

@php
   if(Auth::user()->role_as == '0')
   {
      return redirect('/')->with('status','Access Denied! as you are not as admin');
   }
@endphp
        {{-- @if(session()->has('cat'))
            <div class="alert alert-success">
            {{ session()->get('cat') }}
            </div>
        
        @endif

          @if(session()->has('ca'))
            <div class="alert alert-success">
            {{ session()->get('ca') }}
            </div>
        
        @endif --}}

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if(session('cat'))
   <script> 
   swal("{{ session('cat') }}");
   
   </script> 
@endif
        

            <div class="card-header">
                <h4>Add Category</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('insert_cat') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="col-md-6">
                            <label for="">slug</label>
                            <input type="text" class="form-control" name="slug">
                        </div>
                        <div class="col-md-12">
                            <label for="">Description</label>
                            <textarea name="description" rows="5" class="form-control"></textarea>
                        </div>
                         <div class="col-md-6">
                            <label for="">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="">Meta Keywords</label>
                            <input name="meta_keywords" type="text" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="">Meta Description</label>
                            <input name="meta_descrip" type="text" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="">Status</label>
                            <input type="checkbox" name="status">
                        </div>
                        <div class="col-md-6">
                            <label for="">Popular</label>
                            <input type="checkbox" name="popular">
                        </div>
                        <div class="col-md-12">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    @endsection
    </body>

</html>
