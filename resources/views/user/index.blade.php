@section('content')
    @foreach($users as $user)
        @if(Auth::User()->name == $user->name)
            <div class="container">
                <div class="row gutters">
                    <div class="col-xl col-lg-3 col-md-12 col-sm-12 col-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="account-settings">
                                    <div class="user-profile">
                                        <div class="user-avatar">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Maxwell Admin">
                                        </div>
                                        <h5 class="user-name">{{$user->name}}</h5>
                                        <h6 class="user-email">{{$user->email}}</h6>
                                        <small class="text-muted">Created At: {{$user->created_at}}</small>
                                        <small class="text-muted">Updated At: {{$user->updated_at}}</small>
                                    </div>
                                <div class="about">
                                    <h5>About</h5>
                                    <p>I'm {{$user->name}}. Full Stack Designer I enjoy creating user-centric, delightful and human experiences.</p>
                                    <div class="row gutters">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Update Profile</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New profile</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <div class="modal-body">
                        <form action="{{route('profile.update',$user->id)}}" method="POST">
                            @csrf
                            @method("PUT")
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Name:</label>
                                <input type="text" name="name" value="{{$user->name}}" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label">Email:</label>
                                <input type="email" name="email" value="{{$user->email}}" class="form-control" id="email">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Change Profile</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection

