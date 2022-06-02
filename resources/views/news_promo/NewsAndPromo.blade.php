@extends('layouts.app2')

@section('content')
<div class="content-wrapper">   
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>News And Promo</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Make sure the data entered is correct!</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="/news-promo/store" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                    <div class="card-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name="content" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <!-- <input type="text" class="form-control" name="category"> -->
                        <select name="category" class="form-control">
                            <option value="News">News</option>
                            <option value="Promo">Promo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">image</label>
                        <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                        <label class="form-check-label" for="exampleCheck1">I HAVE CHECKED THE CONSULTATION DATA AND IT IS CORRECT.</label>
                    </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>            
            </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection