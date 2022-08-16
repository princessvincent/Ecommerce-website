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

       
            <div class="card-body">
                <div class="card-header"><h3> <strong>List Of Products</strong></h3></div>


                            <table class="table table-borderd table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Original Price</th>
                        <th>Selling Price</th>
                        <th>Image</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($viewpr as $viewprs)
                        <tr>
                            <td>{{ $viewprs->id }}</td>
                            <td>{{ $viewprs->category->name }}</td>
                            <td>{{ $viewprs->name }}</td>
                            <td>{{ $viewprs->description }}</td>
                            <td>{{ $viewprs->original_price }}</td>
                            <td>{{ $viewprs->selling_price }}</td>
                            <td><img src=" {{ asset('img/product/' . $viewprs->image ) }}" class='d-flex mr-3' height="64" alt="Image"></td>
                            <td>
                           <a  type="button"  href="{{ url('editp/' . $viewprs->id) }}" class="btn btn-primary">Edit</a>

                            <a  type="button"  href="{{ url('delepro/'. $viewprs->id) }}" class="btn btn-danger">Delete</a>
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
