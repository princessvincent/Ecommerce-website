<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        {{-- Material Dashboard 2 by Creative Tim --}}
    </title>
    @extends('layouts.head')
    @section('content')
        <div class="card">


 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if(session('upcat'))
   <script> 
   swal("{{ session('upcat') }}");
   
   </script> 
@endif

        {{-- @if(session()->has('upcat'))
            <div class="alert alert-success">
            {{ session()->get('upcat') }}
            </div>
        
        @endif

          @if(session()->has('upc'))
            <div class="alert alert-danger">
            {{ session()->get('upc') }}
            </div>
        
        @endif

         @if(session()->has('updecat'))
            <div class="alert alert-success">
            {{ session()->get('updecat') }}
            </div>
        
        @endif

          @if(session()->has('dec'))
            <div class="alert alert-danger">
            {{ session()->get('dec') }}
            </div>
        
        @endif --}}
            <div class="card-body">
                <div class="card-header"><h3> <strong>List Of Categories</strong></h3></div>


                            <table class="table table-borderd table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($categ as $categs)
                        <tr>
                            <td>{{ $categs->id }}</td>
                            <td>{{ $categs->name }}</td>
                            <td>{{ $categs->description }}</td>
                            <td><img src=" {{ asset('img/category/' . $categs->image ) }}" class='d-flex mr-3' height="64" alt="Image"></td>
                            <td>
                           <a  type="button"  href="{{ url('editcat/' . $categs->id) }}" class="btn btn-primary">Edit</a>

                            <a  type="button"  href="{{ url('deletecat/'. $categs->id) }}" class="btn btn-danger">Delete</a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>

            </div>


        </div>
    @endsection
    </body>

</html>
