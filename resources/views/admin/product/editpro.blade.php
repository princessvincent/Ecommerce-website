<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Products
    </title>
    @extends('layouts.head')
    @section('content')
        <div class="card">


            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            @if (session('prod'))
                <script>
                    swal("{{ session('prod') }}");
                </script>
            @endif


            <div class="card-header">
                <h4>Edit/Update Product</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('updpr/' . $editpr->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <select class="form-select form-control" aria-label="Default select example">
                                <option value="">{{ $editpr->category->name }}</option>

                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="">name</label>
                            <input type="text" class="form-control" value="{{ $editpr->name }}" name="name">
                        </div>
                        <div class="col-md-6">
                            <label for="">Slug</label>
                            <input type="text" class="form-control" value="{{ $editpr->slug }}" name="slug">
                        </div>
                        <div class="col-md-6">
                            <label for="">Small Description</label>
                            <input type="text" class="form-control" value="{{ $editpr->small_description }}"
                                name="small_description">
                        </div>
                        <div class="col-md-12">
                            <label for="">Description</label>
                            <textarea name="description" rows="5" class="form-control">{{ $editpr->description }}</textarea>
                        </div>
                        <div class="col-md-12">
                             <label for="">Original Price</label>
                            <input type="number" name="original_price" value="{{ $editpr->original_price }}" rows="5"
                                class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="">Selling Price</label>
                            <input type="number" name="selling_price" value="{{ $editpr->selling_price }}" rows="5"
                                class="form-control">
                        </div>

                        <div class="col-md-6">
                            <input type="file" name="image" class="form-control">
                            <img src="{{ asset('img/product/' . $editpr->image) }}" alt="Product Image">
                        </div>

                        <div class="col-md-12">
                            <label for="">Quantity</label>
                            <input type="number" name="qty" value="{{ $editpr->qty }}" rows="5"
                                class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="">Tax</label>
                            <input type="number" name="tax" value="{{ $editpr->tax }}" rows="5"
                                class="form-control"></textarea>
                        </div>

                        <div class="col-md-6">
                            <label for="">Status</label>
                            <input type="checkbox" name="status" {{ $editpr->status == '1' ? 'checked' : '' }}>
                        </div>
                        <div class="col-md-6">
                            <label for="">Trending</label>
                            <input type="checkbox" name="trending" {{ $editpr->trending == '1' ? 'checked' : '' }}>
                        </div>
                        <div class="col-md-6">
                            <label for="">Meta Title</label>
                            <input type="text" name="metal_title" value="{{ $editpr->metal_title }}"
                                class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="">Meta Keywords</label>
                            <input name="metal_keywords" type="text" value="{{ $editpr->metal_keywords }}"
                                class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="">Meta Description</label>
                            <input name="metal_description" type="text" value="{{ $editpr->metal_description }}"
                                class="form-control">
                        </div>
                        <div class="col-md-12">
                            <button type="submit" name="submit" class="btn btn-primary">Update Product</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    @endsection
    </body>

</html>
