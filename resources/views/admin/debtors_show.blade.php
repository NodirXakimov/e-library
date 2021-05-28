@extends('layouts.master')

@section('content')
<div class="row">
   @if (isset($student))
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title mb-3">Student's profile</strong>
                </div>
                <div class="card-body">
                    <div class="mx-auto d-block">
                        <img class="rounded-circle mx-auto d-block" width="300px" src="{{ asset('storage/' . $student->image) }}" alt="Card image cap">
                        <h3 class="text-sm-center mt-2 mb-1">{{ $student->lastname . ' ' . $student->firstname }}</h3>
                        <div class="location text-center">
                            Group: {{ $student->group }}
                        </div>
                        <div class="location text-center">
                            Phone number: {{ $student->phone_number }}
                        </div>
                        <div class="location text-center">
                            Email: {{ $student->email }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
   @endif

    @if (isset($books))
         <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title mb-3">Student's taken books</strong>
                </div>
                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        <div class="row">
                            <div class="col-md-1"><b>№</b></div>
                            <div class="col-md-3"><b>Book name</b></div>
                            <div class="col-md-3"><b>Author</b></div>
                            <div class="col-md-3"><b>Publisher</b></div>
                            <div class="col-md-2"><b>Published year</b></div>
                        </div>
                    </div>
                    @foreach ($books as $key => $book)
                        <div class="alert alert-primary" role="alert">
                            <div class="row">
                                <div class="col-md-1">{{ $key+1 }}</div>
                                <div class="col-md-3">{{ $book->name }}</div>
                                <div class="col-md-3">{{ $book->author }}</div>
                                <div class="col-md-3">{{ $book->publisher_name }}</div>
                                <div class="col-md-2">{{ $book->published_year }}</div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    @endif

</div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("#nav li[class='active']").removeClass('active');
            $("#nav #debtors_nav").addClass('active');
        });
    </script>
@endsection