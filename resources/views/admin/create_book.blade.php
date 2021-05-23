@extends('layouts.master')

@section('content')
        <h2 class="title-1 m-b-25 text-center">Add book</h2>
       <div class="row">
           <div class="col col-md-3"></div>
           <div class="col col-md-6">
            <div class="card">
                <div class="card-header">Book's info</div>
                <div class="card-body">
                    <form action="{{ route('books.store') }}" method="post" novalidate="novalidate">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="control-label mb-1">Name of book</label>
                            <input id="name" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                        </div>
                        <div class="form-group has-success">
                            <label for="author" class="control-label mb-1">Author</label>
                            <input id="author" name="author" type="text" class="form-control name valid" data-val="true" data-val-required="Please enter the name on card"
                                autocomplete="name" aria-required="true" aria-invalid="false" aria-describedby="name-error">
                            <span class="help-block field-validation-valid" data-valmsg-for="name" data-valmsg-replace="true"></span>
                        </div>
                        <div class="form-group">
                            <label for="published_year" class="control-label mb-1">Published year</label>
                            <input id="published_year" name="published_year" type="number" class="form-control number identified visa" value="" data-val="true"
                                autocomplete="number" max="2100" min="1900">
                            <span class="help-block" data-valmsg-for="number" data-valmsg-replace="true"></span>
                        </div>
                        <div class="form-group">
                            <label for="publisher_name" class="control-label mb-1">Publisher name</label>
                            <input id="publisher_name" name="publisher_name" type="tel" class="form-control number identified visa" value="" data-val="true"
                                data-val-required="Please enter the card number" data-val-number="Please enter a valid card number"
                                autocomplete="number">
                            <span class="help-block" data-valmsg-for="number" data-valmsg-replace="true"></span>
                        </div>
                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                <i class="fa fa-plus fa-lg"></i>&nbsp;
                                <span id="payment-button-amount">Add book</span>
                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
           </div>
       </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("#nav li[class='active']").removeClass('active');
            $("#nav #books_nav").addClass('active');
        });
    </script>
@endsection
