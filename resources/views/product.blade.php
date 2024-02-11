@extends('app')
@section('content')

<div class="container-fluid">
  <div class="row">
    <!-- left column -->
    <div class="col-12">
      <a class="btn btn-success m-2"  data-toggle="modal" data-target="#createModal">  {{ __('words.create_product')  }} </a>

      <!-- start modal create -->
      <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"> {{ __('words.create_product')  }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                @csrf
                <div class="form-group">
                  <label>{{ __('words.Category') }}:</label>
                  <select class="form-control" name="category_id">
                  @foreach ($categories as $category)
                  
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    
                  @endforeach  
                  </select>
                </div>
                <div class="form-group">
                  <input type="text" name="name" class="form-control" placeholder="Name" required>
                </div>
                <div class="form-group">
                  <textarea name="description" placeholder="Description" id="" cols="30" rows="3" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3">
                      <input type="text" name="size" class="form-control" placeholder="Size" required>
                    </div>
                    <div class="col-sm-3">
                      <input type="color" name="color" class="form-control" placeholder="Color" required>
                    </div>
                    <div class="col-sm-3">
                      <input type="number" name="quantity" class="form-control" placeholder="Quantity" required>
                    </div>
                    <div class="col-sm-3">
                      <input type="number" name="price" class="form-control" placeholder="Price" required>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">Upload</span>
                    </div>
                  </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('words.close') }}</button>
                <button type="submit" class="btn btn-primary"  >{{ __('words.save') }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- end modal create -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{ strtoupper($title) }}</h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>{{ __('words.ID') }}</th>
                      <th>{{ __('words.category') }}</th>
                      <th>{{ __('words.name') }}</th>
                      <th>{{ __('words.image') }}</th>
                      <th>{{ __('words.price') }}</th>
                      <th>{{ __('words.status') }}</th>
                      <th>{{ __('words.Options') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $product)
                      <tr>
                        <td>{{ $loop->index + 1  }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->name }}</td>
                        <td><img src='{{url("images/$product->image")}}' alt=""></td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->status }}</td>
                        <td><a class="btn btn-secondary"  data-toggle="modal" data-target="#ModalEdit{{ $product->id }}"> {{ __('words.Edit')   }}</a> <a class="btn btn-danger" data-toggle="modal" data-target="#Modal{{ $product->id }}"> {{ __('words.Delete')   }}</a></td>
                      </tr>

                      <!-- Modal Edit -->
                      <div class="modal fade" id="ModalEdit{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{ route('product.update', $product->id) }}" method="post">
                              @csrf
                              @method('PUT')
                              <input type="text" name='id' value='{{ $product->id }}' hidden>
                              <div class="modal-body">
                                <div class="form-group">
                                  <label>{{ __('words.Category') }}:</label>
                                  <select class="form-control" name="category_id">
                                  @foreach ($categories as $category)
                                  
                                    <option value="{{$category->id}}" @if($category->name == $product->category->name) selected @endif>{{$category->name}}</option>
                                    
                                  @endforeach  
                                  </select>
                                </div>
                                <div class="form-group">
                                  <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Name" required>
                                </div>
                                <div class="form-group">
                                  <textarea name="description" placeholder="Description" id="" cols="30" rows="3" class="form-control" required>{{ $product->description }}</textarea>
                                </div>
                                <div class="form-group">
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <input type="text" name="size" value="{{ $product->size }}" class="form-control" placeholder="Size" required>
                                    </div>
                                    <div class="col-sm-3">
                                      <input type="color" name="color" value="{{ $product->color }}" class="form-control" placeholder="Color" required>
                                    </div>
                                    <div class="col-sm-3">
                                      <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control" placeholder="Quantity" required>
                                    </div>
                                    <div class="col-sm-3">
                                      <input type="number" name="price" value="{{ $product->price }}" class="form-control" placeholder="Price" required>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputFile">File input</label>
                                  <div class="input-group">
                                    <div class="custom-file">
                                      <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                      <span class="input-group-text">Upload</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Confirm</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      
                      <!-- Modal Delete -->
                      <div class="modal fade" id="Modal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{ route('product.destroy', $product->id) }}" method="post">
                              @csrf
                              @method('DELETE')
                              <input type="text" name='id' value='{{ $product->id }}' hidden>
                              <div class="modal-body">
                                Are you sure to delete  {{ $product->name }} ?
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Confirm</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
  </div>
  <!-- /.row -->
</div>


@endsection