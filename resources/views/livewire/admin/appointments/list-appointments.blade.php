<div>
    <div class="content-header">
        <div class="container-fluid">

         


          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Appoinments</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Appointments</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>


       <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

          @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong><i class="fa fa-check-circle mr-1"></i> {{ session('message') }}</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> 
          @endif
          

          <div class="row">
            <div class="col-lg-12">
              <div class="d-flex justify-content-end mb-2">
                <a href="{{ route('admin.appointments.create') }}">
                    <button class="btn btn-primary">
                    <i class="fa fa-plus-circle mr-1"> Add New Appointments</i>
                    </button>
                </a>
              </div>
              
              <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Client Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Status</th>
                            <th scope="col">Options</th>
                          </tr>
                        </thead>
                        <tbody>
                         
                            @foreach ($appointments as $appointment)
                                <tr>
                                  <th class="row">{{ $loop->iteration }}</th>
                                  <td>{{ $appointment->client->name }}</td>
                                  <td>{{ $appointment->date->toFormattedDate() }}</td>
                                  <td>{{ $appointment->time->toFormattedTime() }}</td>
                                  <td>
                                    <span class="badge badge-{{ $appointment->status_badge }}">
                                    {{ $appointment->status }}
                                    </span>
                                  </td>
                                  <td></td>
                                </tr>
                            @endforeach
                         
                        </tbody>
                      </table>
                </div>
                <div class="card-footer">
                  
                </div>
              </div>
            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->




      <!-- Modal -->
      <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
          <form autocomplete="off">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                    <span>Add New User</span>
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                  <label for="name">Full Name</label>
                  <input type="text" wire:model.defer="state.name" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="nameHelp" placeholder="Enter Full Name">
                  @error('name')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" wire:model.defer="state.email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                  @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" wire:model.defer="state.password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                  @error('password')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="passwordConfirmation">Confirm Password</label>
                  <input type="password" wire:model.defer="state.password_confirmation" class="form-control" id="passwordConfirmation" placeholder="Password">
                </div>
               
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancel</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                    <span>Save</span>
              </button>
            </div>
          </div>
          
        </form>
        </div>
      </div>



      <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header"><h5>Delete User</h5></div>
          

            <div class="modal-body">
              <h4>Are you sure you want to delete this user?</h4>
            </div>

            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancel</button>
              <button type="button" wire:click.prevent="deleteUser" class="btn btn-danger"><i class="fa fa-trash mr-1"></i> Delete User</button>
            </div>
          </div>
        </div>
      </div>

</div>
