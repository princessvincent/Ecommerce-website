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

    </title>
    @extends('layouts.head')
    @section('content')
        <div class="card">


            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            @if (session('upcat'))
                <script>
                    swal("{{ session('upcat') }}");
                </script>
            @endif


            <div class="card-body">
                <div class="card-header">
                    <h3> <strong>Registered Users</strong></h3>
                </div>


                <table class="table table-borderd table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($user as $users)
                            <tr>
                                <td>{{ $users->id }}</td>
                                <td>{{ $users->name . ' ' . $users->lname}}</td>
                                <td>{{ $users->email }}</td>
                                <td>{{ $users->phone }}</td>
                                <td><a type="button" href="{{ url('viewuser/' . $users->id) }}" class="btn btn-primary">View</a></td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>


        </div>
    @endsection
    </body>

</html>
