@extends('layouts.master')

@section('content')
    <h2 class="title-1 m-b-25 text-center">Add student</h2>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <strong>Add new</strong> student
                </div>
                <div class="card-body card-block my-4">
                    <form action="{{ route("students.store") }}" method="post" enctype="multipart/form-data" class="form-horizontal" id="form">
                        @csrf
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="firstname" class="form-control-label">Firstname</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="firstname" name="firstname" placeholder="Firstname" class="form-control">
                                @error('firstname')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="lastname" class="form-control-label">Lastname</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="lastname" name="lastname" placeholder="Lastname" class="form-control">
                                @error('lastname')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="middlename" class="form-control-label">Middlename</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="middlename" name="middlename" placeholder="Middlename" class="form-control">
                                @error('middlename')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="email" class=" form-control-label">Email</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="email" id="email" name="email" placeholder="Enter Email" class="form-control">
                                @error('email')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="group" class=" form-control-label">Group</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="group" name="group" placeholder="Group" class="form-control">
                                @error('group')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="course" class=" form-control-label">Select course</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="course" id="course" class="form-control">
                                    <option></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                @error('course')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="phone_number" class=" form-control-label">Phone number</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="phone" id="phone_number" name="phone_number" placeholder="Phone number" class="form-control">
                                @error('phone_number')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="password" class=" form-control-label">Password</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="password" id="password" name="password" placeholder="Set a password" class="form-control">
                                @error('password')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="file-input" class=" form-control-label">Select picture</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="file" id="image" name="image" class="form-control-file">
                                <small class="text-primary">* Not required</small>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary" form="form">
                        <i class="fa fa-save"></i> Create
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("#nav li[class='active']").removeClass('active');
            $("#nav #students_nav").addClass('active');
        });
    </script>
@endsection
