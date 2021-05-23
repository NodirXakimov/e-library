@extends('layouts.master')

@section('content')
<div class="alert alert-success alert-dismissible" id="alert_attached" style="display: none">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Success!</strong> Books succesfully attached.
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
                    <div class="alert alert-danger" style="display: none" id="alert">
                        <strong>Warning!</strong> Student not found.
                    </div>  
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <strong>Select book(s)</strong>
                <small> Form</small>
            </div>
            <div class="card-body card-block">
                <div class="card-title">
                    <h3 class="text-center title-2">Book info</h3>
                </div><hr>
                <div class="row my-3">
                    <div class="col-sm-12">
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
                    </div>
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
            <i class="fa fa-lock fa-lg"></i>&nbsp;
            <span id="attachButton">Attach</span>
            <span id="payment-button-sending" style="display:none;">Sending…</span>
        </button>
    </div>
</div>
@endsection

@section('script')
    <script>
        let stored_books = [];
        let stored_student_id = null;
        $(document).ready(function(){

            $("#nav li[class='active']").removeClass('active');
            $("#nav #dashboard_nav").addClass('active');
            $("#getStudentButton").on('click', function(){
                let student_id = $("#student_id").val();
                if(student_id > 0){
                    axios.get(`api/students/${student_id}`, {
                        id: student_id
                    }).then(result => {
                        console.log(result);
                        stored_student_id = result.data.id;
                        $("#alert").hide();
                        $('#card-header').html(result.data.lastname + " " + result.data.firstname + ' ' + result.data.middlename);   
                        let body = `
                            <p>Group: <strong>${result.data.group}</strong></p>
                            <p>Phone number: <strong>${result.data.phone_number}</strong></p>
                            <p>Email: <strong>${result.data.email}</strong></p>
                        `;
                        $('#card-body').html(body);   
                        $("#card").show();
                    }).catch(error => {
                        console.log("An error occured " + error);
                        $("#card").hide();
                        $("#alert").show();
                    });
                } else {
                    $("#alert").show();
                }
            });
            $("#getBookButton").on('click', function(){
                let book_id = $("#book_id").val();
                $("#book_alert").hide();

                if (book_id < 1) {
                    $("#book_alert").show();
                } else {
                    $("#book_alert").hide();
                    axios.get(`/api/books/${book_id}`)
                    .then(result => {
                        console.log('Book_id = ' + book_id);
                        console.log(result);
                        if(!hasBookStored(book_id))
                            stored_books.push(result.data);
                        else 
                            $("#book_alert").show();
                        console.log(stored_books);
                        hookBooks();
                    }).catch(error => {
                        console.log('error accured in getting book');
                        $("#book_alert").show();
                    })
                }
            });
            $("#attachButton").on('click', function(){
                if(attachable()){
                    console.log(stored_books);
                    console.log(stored_student_id);
                    axios.post("/api/attach", {
                        student_id: stored_student_id,
                        books: stored_books
                    }).then(response => {
                        console.log(response);
                        $('#alert_attached').show();
                        $('#alert_attached').fadeOut(3000, 'swing');
                        clearAttaches();
                        // location.reload();
                    }).catch(error => {
                        console.log(error);
                    });
                }
                else
                    alert('Not attachable');
            });
        });

        function hookBooks(){
            if(stored_books.length >= 1){
                let tbody = '';
                stored_books.forEach(book => {
                console.log(stored_books);
                    tbody += `
                    <tr class="tr-shadow">
                        <td>${book.name}</td>
                        <td>${book.author}</td>
                        <td>${book.publisher_name}</td>
                        <td>
                            <div class="table-data-feature">
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <i class="zmdi zmdi-delete"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="spacer"></tr>
                    `;
                });
                $('#book_table_body').html('');
                $('#book_table_body').html(tbody);
                $('#book_table').show();
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
    </script>
@endsection