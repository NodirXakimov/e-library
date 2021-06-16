@extends('layouts.master')

@section('content')
    <h2 class="title-1 m-b-25 text-center">Edit student</h2>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <strong>Edit</strong> student
                </div>
                <div class="card-body card-block my-4">
                    <form action="{{ route("students.update", ['student' => $student]) }}" method="post" enctype="multipart/form-data" class="form-horizontal" id="form">
                        @csrf
                        @method('PUT')
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="firstname" class="form-control-label">Firstname</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="firstname" name="firstname" placeholder="Firstname" class="form-control" value="{{ $student->firstname }}">
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
                                <input type="text" id="lastname" name="lastname" placeholder="Lastname" class="form-control" value="{{ $student->lastname }}">
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
                                <input type="text" id="middlename" name="middlename" placeholder="Middlename" class="form-control" value="{{ $student->middlename }}">
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
                                <input type="email" id="email" name="email" placeholder="Enter Email" class="form-control" value="{{ $student->email }}">
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
                                <input type="text" id="group" name="group" placeholder="Group" class="form-control" value="{{ $student->group }}">
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
                                    <option value="1" @if ($student->course == 1) selected @endif>1</option>
                                    <option value="2" @if ($student->course == 2) selected @endif>2</option>
                                    <option value="3" @if ($student->course == 3) selected @endif>3</option>
                                    <option value="4" @if ($student->course == 4) selected @endif>4</option>
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
                                <input type="phone" id="phone_number" name="phone_number" placeholder="Phone number" class="form-control" value="{{ $student->phone_number }}">
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
                                <input type="password" id="password" name="password" placeholder="Update the password (Not required)" class="form-control">
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
                        <i class="fa fa-save"></i> Save
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
