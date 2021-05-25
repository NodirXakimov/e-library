@extends('layouts.master')

@section('content')
        <h2 class="title-1 m-b-25 text-center">Import books from Excel</h2>
       <div class="row">
           <div class="col col-md-3"></div>
           <div class="col col-md-6">
            <div class="card">
                <div class="card-header">Import books data</div>
                <div class="card-body">
                    <form action="{{ route('import_books') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file" class="control-label mb-1">Choose excel file only</label>
                            <input id="file" name="file" type="file" class="form-control" aria-required="true" aria-invalid="false" >
                        </div>
                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                <i class="fa fa-plus fa-lg"></i>&nbsp;
                                <span id="payment-button-amount">Import</span>
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
