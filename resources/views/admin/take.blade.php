@extends('layouts.master')

@section('content')
<div class="alert alert-success alert-dismissible" id="alert_detach" style="display: none">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Success!</strong> Books succesfully detached.
</div>
<div class="row" id="app">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header"><b>Select Student ( Put the card to the scanner )</b></div>
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Student info</h3>
                </div>
                <hr>
                <div class="form-group has-success">
                    <div class="row my-3">
                        <div class="col-sm-12">
                            <label for="student_id" class="control-label mb-1">Student's ID</label>
                        </div>
                        <div class="col col-sm-6">
                            <input type="number" id="student_id" class="form-control" placeholder="ID number of student" min="1">
                        </div>
                        <div class="col col-sm-6">
                            <button id="getStudentButton" class="btn btn-info btn-block">
                                <i class="fa fa-user fa-lg"></i>&nbsp;
                                <span id="payment-button-amount">Get student</span>
                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                            </button>
                        </div>
                    </div>
                    
                    <div class="card mt-5" style="display: none" id="card">
                        <div class="card-header" id="card-header"></div>
                        <div class="card-body" id="card-body"></div>
                    </div>
                    {{-- <div class="alert alert-danger" style="display: none" id="alert">
                        <strong>Warning!</strong> Student not found.
                    </div>   --}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <strong>Select book ( Scan QR code of the book )</strong> 
            </div>
            <div class="card-body card-block">
                <div class="card-title">
                    <h3 class="text-center title-2">Book info</h3>
                </div><hr>
                <div class="row my-3">
                    {{-- <div class="col-sm-12">
                        <label for="id" class="control-label mb-1">Book's ID</label>
                    </div>
                    <div class="col col-sm-6">
                        <input type="number" id="book_id" class="form-control" placeholder="ID number of book" min="1">
                    </div>
                    <div class="col col-sm-6">
                        <button id="getBookButton" class="btn btn-info btn-block">
                            <i class="fa fa-book fa-lg"></i>&nbsp;
                            <span id="payment-button-amount">Get Book</span>
                            <span id="payment-button-sending" style="display:none;">Sending…</span>
                        </button>
                    </div> --}}
                </div>
                <div class="alert alert-danger" style="display: none" id="book_alert">
                    <strong>Warning!</strong> Book is not available
                </div>
                <div class="row mt-5" style="display: none" id="book_table">
                        <!-- DATA TABLE -->
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Book name</th>
                                        <th>Author</th>
                                        <th>Publisher</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="book_table_body">
                                   
                                </tbody>
                            </table>
                        </div>
                        <!-- END DATA TABLE -->
                </div>

            </div>
        </div>
    </div>
    <div>
        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
            <i class="fa fa-unlock fa-lg"></i>&nbsp;
            <span id="detachButton">Detach</span>
            <span id="payment-button-sending" style="display:none;">Sending…</span>
        </button>
    </div>
</div>

@endsection

@section('script')
    <script>
        let stored_books = [];
        let stored_student_id = null;
        let checkedBooks = [];
        $(document).ready(function(){

            $("#nav li[class='active']").removeClass('active');
            $("#nav #take_book_nav").addClass('active');
            $("#getStudentButton").on('click', function(){
                let student_id = $("#student_id").val();
                if(student_id > 0){
                    axios.get(`api/students/debtors/${student_id}`, {
                        id: student_id
                    }).then(result => {
                        console.log(result);
                        stored_student_id = result.data.student.id;
                        getBooksOfDebtor(stored_student_id);
                        // $("#alert").hide();
                        $('#card-header').html(result.data.student.lastname + " " + result.data.student.firstname + ' ' + result.data.student.middlename);   
                        let body = `
                        <div class="row">
                            <div class="col col-md-7">
                                <p>Group: <strong>${result.data.student.group}</strong></p>
                                <p>Phone number: <strong>${result.data.student.phone_number}</strong></p>
                                <p>Email: <strong>${result.data.student.email}</strong></p>
                            </div>
                            <div class="col col-md-5">
                                <img src="{{ asset('storage/${result.data.student.image}') }}" alt="Student's photo" style="width:300px; border-radius:5%">
                            </div>
                        </div>  
                        `;
                        $('#card-body').html(body);   
                        $("#card").show();
                    }).catch(error => {
                        console.log("An error occured " + error);
                        $("#card").hide();
                        // $("#alert").show();
                        Swal.fire({
                        icon: 'success',
                        title: 'You do not have any credits',
                        text: 'You are free as a bird!'
                        })
                        
                    });
                } else {
                    // $("#alert").show();
                    Swal.fire({
                        icon: 'error',
                        title: 'Student not found',
                        text: 'Something went wrong!'
                        })
                }
            });
            $("#detachButton").on('click', function(){
                $('input[type=checkbox]:checked').each(function() {
                    checkedBooks.push($(this).val());
                });
                if(attachable()){
                    console.log(stored_books);
                    console.log(stored_student_id);
                    axios.post("/api/detach", {
                        student_id: stored_student_id,
                        books: checkedBooks
                    }).then(response => {
                        console.log(response);
                        $('#alert_detach').show();
                        $('#alert_detach').fadeOut(3000, 'swing');
                        clearAttaches();
                        // location.reload();
                    }).catch(error => {
                        console.log(error);
                    });
                }
                else
                    Swal.fire({
                    icon: 'warning',
                    title: 'Student or book did not selected'
                    })
            });
        });

        function hookBooks(){
            if(stored_books.length >= 1){
                let tbody = '';
                stored_books.forEach(book => {
                    tbody += `
                    <tr class="tr-shadow">
                        <td>${book.name}</td>
                        <td>${book.author}</td>
                        <td>${book.publisher_name}</td>
                        <td>
                            <div class="table-data-feature">
                                <label class="au-checkbox">
                                    <input type="checkbox" name="book_id" value="${book.id}">
                                    <span class="au-checkmark"></span>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr class="spacer"></tr>
                    `;
                });
                if(tbody == '')
                $('#book_table_body').html('');
                $('#book_table_body').html(tbody);
                $('#book_table').show();
            } else {
                $('#book_table_body').html('');
            }
        }
        function hasBookStored(id){
            let stored = false;
            stored_books.forEach(book => {
                if(book.id == id){
                    stored = true;
                }
            });
            return stored; 
        }
        function attachable(){
            if(stored_books.length > 0 && stored_student_id)
            return true;
            return false;
        }
        function clearAttaches(){
            stored_books = [];
            stored_student_id = null;
            $("#book_table_body").html("");
            $("#card-header").html("");
            $("#card-body").html("");
            $("#book_table").hide();
            $("#card").hide();
            $("#student_id").val("");
            $("#book_id").val("");
        }
        function removeFromStoredBooks(id) {
            let removableIndex = -1;
            stored_books.forEach((book, i) => {
                if(book.id == id)
                removableIndex = i;
            });
            if(removableIndex >= 0){
                stored_books.splice(removableIndex, 1);
                hookBooks();
            }
        }
        function getBooksOfDebtor(id) {
            // alert(id);
            axios.get(`api/students/debtors/${id}/books`, { id: id})
                .then(result => {
                    stored_books = result.data;
                    console.log(result.data);
                    hookBooks();
                }).catch(err => {
                    console.log(err);
                })
        }
    </script>
@endsection