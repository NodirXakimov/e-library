@extends('layouts.master')

@section('content')
    @if(isset($books))
        <h2 class="title-1 m-b-25">Books</h2>
        <div class="table-data__tool">
            <div class="table-data__tool-left">
                <div class="rs-select2--light rs-select2--md">
                    <select class="js-select2" name="property">
                        <option selected="selected">All Categories</option>
                        <option value="">Option 1</option>
                        <option value="">Option 2</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>
            </div>
            <div class="table-data__tool-right">
                <a class="au-btn au-btn-icon au-btn--blue au-btn--small" style="color: white" href="{{ route("importBook") }}">
                    <i class="zmdi zmdi-download"></i>Import from Excel</a>
                <a class="au-btn au-btn-icon au-btn--green au-btn--small" style="color: white" href="{{ route("books.create") }}">
                    <i class="zmdi zmdi-plus"></i>add book</a>
            </div>
        </div>
        @if (session('status'))
            <div class="alert alert-success" id="status_alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="table-responsive table--no-card m-b-20">
            <table class="table table-borderless table-striped table-earning">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Published year</th>
                        <th>Author(s)</th>
                        <th>Publishing</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->name }}</td>
                            <td>{{ $book->published_year }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->publisher_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $books->links() }}
    @else
        <p>There is no any books</p>
    @endif
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("#nav li[class='active']").removeClass('active');
            $("#nav #books_nav").addClass('active');
            $('#status_alert').fadeOut(3000, 'swing');
        });
    </script>
@endsection