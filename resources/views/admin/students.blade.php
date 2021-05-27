@extends('layouts.master')

@section('content')
    @if(isset($students))
        <h2 class="title-1 m-b-25">Students</h2>
        <div class="table-data__tool">
            <div class="table-data__tool-left">
                <div class="rs-select2--light rs-select2--md">
                    <select class="js-select2" name="property">
                        <option selected="selected">Group by</option>
                        <option value="">Option 1</option>
                        <option value="">Option 2</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>
            </div>
            <div class="table-data__tool-right">
                <a class="au-btn au-btn-icon au-btn--blue au-btn--small" style="color: white" href="{{ route("importStudents") }}">
                    <i class="zmdi zmdi-download"></i>Import from Excel</a>
                <a class="au-btn au-btn-icon au-btn--blue au-btn--small" style="color: white" href="{{ route("students.create") }}">
                    <i class="zmdi zmdi-plus"></i>add student</a>
            </div>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="table-responsive table--no-card m-b-20">
            <table class="table table-borderless table-striped table-earning">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Middlename</th>
                        <th>Group</th>
                        <th>Course</th>
                        <th>Phone number</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->firstname }}</td>
                            <td>{{ $student->lastname }}</td>
                            <td>{{ $student->middlename }}</td>
                            <td>{{ $student->group }}</td>
                            <td>{{ $student->course }}</td>
                            <td>{{ $student->phone_number }}</td>
                            <td>{{ $student->email }}</td>
                            <td>
                                <a type="button" class="view" title="View" data-toggle="modal" data-target="#StudentShowModal" data-id="{{ $student->id }}"><i class="material-icons">&#xE417;</i></a>
                                <a href="{{ route('students.edit', ['student' => $student]) }}" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $students->links() }}
    @else
        <p>There is no any students</p>
    @endif
    <!-- modal large -->
			<div class="modal fade" id="StudentShowModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" >
				<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="largeModalLabel">Large Modal</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="row">
                                <div class="col col-7">
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr><td>Firstname:</td><td id="firstname">Nodir</td></tr>
                                            <tr><td>Lastname:</td><td id="lastname">Xakimov</td></tr>
                                            <tr><td>Middlename:</td><td id="middlename">Sayfullayevich</td></tr>
                                            <tr><td>Email:</td><td id="email">nodirxakimov@yandex.ru</td></tr>
                                            <tr><td>Group:</td><td id="group">310-16</td></tr>
                                            <tr><td>Course:</td><td id="course">4</td></tr>
                                            <tr><td>Phone number:</td><td id="phone_number">+998999905518</td></tr>
                                            <tr><td>Is debtor?:</td><td>No</td></tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col col-5">
                                    <img src="" alt="Student image" style="width:300px; border-radius:10%">
                                </div>
                            </div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
	<!-- end modal large -->
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("#nav li[class='active']").removeClass('active');
            $("#nav #students_nav").addClass('active');
            
            $('#StudentShowModal').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget) // Button that triggered the modal
                let id = button.data('id') // Extract info from data-* attributes
                let url = "api/students/" + id;
                axios.get(url)
                .then(res => {
                    console.log(res.data);
                    $("#StudentShowModal img").attr('src', "storage/" + res.data.image)
                    $("#StudentShowModal #firstname").html(res.data.firstname)
                    $("#StudentShowModal #lastname").html(res.data.lastname)
                    $("#StudentShowModal #middlename").html(res.data.middlename)
                    $("#StudentShowModal #email").html(res.data.email)
                    $("#StudentShowModal #group").html(res.data.group)
                    $("#StudentShowModal #course").html(res.data.course)
                    $("#StudentShowModal #phone_number").html(res.data.phone_number)
                    
                    let modal = $(this)
                    modal.find('.modal-title').text(res.data.lastname + ' ' + res.data.firstname)
                })
                .catch(err => {
                    console.error(err);
                    $("#StudentShowModal").modal('hide'); 
                })
            })
        });
    </script>
@endsection