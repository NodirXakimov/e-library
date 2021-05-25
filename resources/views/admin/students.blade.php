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
                                <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
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
                                            <tr><td>Firstname:</td><td>Nodir</td></tr>
                                            <tr><td>Lastname:</td><td>Xakimov</td></tr>
                                            <tr><td>Middlename:</td><td>Sayfullayevich</td></tr>
                                            <tr><td>Email:</td><td>nodirxakimov@yandex.ru</td></tr>
                                            <tr><td>Group:</td><td>310-16</td></tr>
                                            <tr><td>Course:</td><td>4</td></tr>
                                            <tr><td>Phone number:</td><td>+998999905518</td></tr>
                                            <tr><td>Is debtor?:</td><td>No</td></tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col col-5">
                                    <img src="" alt="Student image" style="width:300px; border-radius:20%">
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
                    $("#StudentShowModal img").attr('src', "storage/" + res.data.image);
                    console.log(res.data.image);
                })
                .catch(err => {
                    console.error(err); 
                })
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('New message to ' + 1)
                modal.find('.modal-body input').val(1)
            })
        });
    </script>
@endsection