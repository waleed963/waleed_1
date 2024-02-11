@extends('app')
@section('content')

<div class="container-fluid">
  <div class="row">
    <!-- left column -->
    <div class="col-12">
      <a class="btn btn-success m-2"  data-toggle="modal" data-target="#createModal">  {{ __('words.create_category')  }} </a>

      <!-- start modal create -->
      <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"> {{ __('words.create_category')  }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('category.store') }}" method="post">
              <div class="modal-body">
                @csrf
                <div class="form-group">
                  <input type="text" name="name" class="form-control" placeholder="Name" required>
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
                      <th>{{ __('words.Name') }}</th>
                      <th>{{ __('words.Options') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($categories as $category)
                      <tr>
                        <td>{{ $loop->index + 1  }}</td>
                        <td>{{ $category->name }}</td>
                        <td><a class="btn btn-secondary"  data-toggle="modal" data-target="#ModalEdit{{ $category->id }}"> {{ __('words.Edit')   }}</a> <a class="btn btn-danger" data-toggle="modal" data-target="#Modal{{ $category->id }}"> {{ __('words.Delete')   }}</a></td>
                      </tr>

                      <!-- Modal Edit -->
                      <div class="modal fade" id="ModalEdit{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{ route('category.update', $category->id) }}" method="post">
                              @csrf
                              @method('PUT')
                              <input type="text" name='id' value='{{ $category->id }}' hidden>
                              <div class="modal-body">
                              <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{$category->name}}" required>
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
                      <div class="modal fade" id="Modal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{ route('category.destroy', $category->id) }}" method="post">
                              @csrf
                              @method('DELETE')
                              <input type="text" name='id' value='{{ $category->id }}' hidden>
                              <div class="modal-body">
                                Are you sure to delete  {{ $category->name }} ?
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