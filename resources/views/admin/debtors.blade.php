@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <h3 class="title-5 m-b-35">data table</h3>
        <div class="table-data__tool">
            <div class="table-data__tool-left">
                <div class="rs-select2--light rs-select2--md">
                    <select class="js-select2" name="property">
                        <option selected="selected">All Properties</option>
                        <option value="">Option 1</option>
                        <option value="">Option 2</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>
                <div class="rs-select2--light rs-select2--sm">
                    <select class="js-select2" name="time">
                        <option selected="selected">Today</option>
                        <option value="">3 Days</option>
                        <option value="">1 Week</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>
                <button class="au-btn-filter">
                    <i class="zmdi zmdi-filter-list"></i>filters</button>
            </div>
            <div class="table-data__tool-right">
                <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                    <select class="js-select2" name="type">
                        <option selected="selected">Export</option>
                        <option value="">Option 1</option>
                        <option value="">Option 2</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>
            </div>
        </div>
        <div class="table-responsive table-responsive-data2">
            @if (isset($debtors))
            <table class="table table-data2">
                <thead>
                    <tr>
                        <th>
                            <label class="au-checkbox">
                                <input type="checkbox">
                                <span class="au-checkmark"></span>
                            </label>
                        </th>
                        <th>Student</th>
                        <th>Group</th>
                        <th>Phone number</th>
                        <th>Book</th>
                        <th>Take on</th>
                        <th>Expire at</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($debtors as $debtor)
                    <tr class="tr-shadow">
                        <td>
                            <label class="au-checkbox">
                                <input type="checkbox">
                                <span class="au-checkmark"></span>
                            </label>
                        </td>
                        <td>{{ $debtor->student->lastname }} {{ $debtor->student->firstname }}</td>
                        <td>
                            <span class="block-email">{{ $debtor->student->group }}</span>
                        </td>
                        <td class="desc">{{ $debtor->student->phone_number }}</td>
                        <td>{{ $debtor->book->name }}</td>
                        <td>{{ $debtor->student->created_at }}</td>
                        <td>
                            <span class="status--process">{{ $debtor->expiration_date }}</span>
                        </td>
                        <td>
                            <div class="table-data-feature">
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                    <i class="zmdi zmdi-mail-send"></i>
                                </button>
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="zmdi zmdi-edit"></i>
                                </button>
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <i class="zmdi zmdi-delete"></i>
                                </button>
                                <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                    <i class="zmdi zmdi-more"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="spacer"></tr>
                   @endforeach
                </tbody>
            </table>
            <!-- Pagination links -->
            {{ $debtors->links() }}
            @endif
        </div>
        <!-- END DATA TABLE -->
    </div>
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