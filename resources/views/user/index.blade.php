@extends("layouts.app")
@section('content')
    <div class="container">
        <div class="row gutters">
            <div class="col-xl col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <h2>My profile</h2>
                                <h5 class="user-name">Name: {{ Auth::User()->name }}</h5>
                                <h6 class="user-email">Email: {{ Auth::User()->email }}</h6>
                                <small class="text-muted">Created At: {{ Auth::User()->created_at }}</small>
                                @if (Auth::User()->created_at != Auth::User()->updated_at)
                                    <small class="text-muted">Updated At: {{ Auth::User()->updated_at }}</small>
                                @endif
                            </div>
                            <div class="about">
                                <div class="row gutters">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="text-right">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#updateModal" data-whatever="@mdo">Update Profile</button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#deleteModal" data-whatever="@mdo">Delete Account</button>
                                        </div>
                                        @if (request()->get('success'))
                                            <br>
                                            <div style="margin:auto; text-align:center;"
                                                class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 alert alert-success"
                                                role="alert">
                                                Se ha actualizado correctamente.
                                            </div>
                                        @endif
                                        @if ($errors->any())
                                            <br>
                                            <div style="margin:auto;"
                                                class="d-flex justify-content-center align-items-center col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 alert alert-danger"
                                                role="alert">
                                                <ul>
                                                    {!! implode('', $errors->all('<li>:message</li>')) !!}
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModal">New profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.update', Auth::User()->id) }}" method="POST">
                            @csrf
                            @method("PUT")
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Name:</label>
                                <input type="text" name="name" value="{{ Auth::User()->name }}" class="form-control"
                                    id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label">Email:</label>
                                <input type="email" name="email" value="{{ Auth::User()->email }}" class="form-control"
                                    id="email">
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-form-label">New password:</label>
                                <input type="password" name="password" value="" class="form-control" id="password">
                            </div>
                            <div class="form-group">
                                <label for="password-confirm" class="col-form-label">Confirm new password:</label>
                                <input type="password" name="password_confirmation" value="" class="form-control"
                                    id="password-confirm">
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
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModal">New profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.destroy', Auth::User()->id) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <small class="text-muted">Question</small>
                            <p>Are you sure you want to delete the account?</p>
                            <small class="text-muted">Yes</small>
                            <p>If you are press Delete Account button.</p>
                            <small class="text-muted">No</small>
                            <p>If you aren't, press X or Cancel button.</p>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
