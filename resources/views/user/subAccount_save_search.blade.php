@extends('layouts.app')
@section('content')
    <!-- Header start -->
    @include('includes.header')
    <!-- Header end -->

    @include('includes.employer_tab')

    <section id="dashboard">
        <div class="container">
            <div class="imr">
                <div class="im-12">
                    <div class="dashboard-inner">
                        @include('flash::message')
                        @include('includes.subAccount_dashboard_menu')

                        <div class="dashboard-tab-content">
                            <div class="profile-main">
                                <div class="jobseeker-inner" style="padding:35px;">
                                    <div class="jobseeker-form">
                                        <div class="form-items">
                                            <h4 style="font-weight: bold;">Save Search</h4>
                                            {{--@if(isset($saveSearchCount))
                                                <p>{{ $saveSearchCount}} Search Saved</p>
                                            @endif--}}
                                                <div class="pt-3" >
                                                    <table id="saveSearch" class="saveSearchTable">
                                                        <thead>
                                                        <tr>
                                                            <th width="60%"><div>Title</div></th>
                                                            <th width="25%"><div>Date Saved</div></th>
                                                            <th width="15%" style="text-align: center;">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(isset($jobSeekerSearchSave))
                                                            @foreach($jobSeekerSearchSave as $item)
                                                                <tr>


                                                                    <td><a href="{{ $item->search_request_url}}" style="color: #000;">{{ $item->title}}</a></td>
                                                                    <td>{{ date('M d, Y', strtotime($item->created_at)) }}</a></td>
                                                                    <td style="text-align: center;">
                                                                            <a href="javascript:void(0)" data-id="{{$item->id}}" class="save_search_remove" style="color: #EC521E;">
                                                                            <i class="fas fa-trash"></i>
                                                                        </a>

                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                        </tbody>
                                                    </table>

                                                </div>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    @include('includes.footer_social')
@endsection

@push('styles')


    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{asset('/')}}css/custom-bootstrap.min.css" rel="stylesheet">
@endpush

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $(".save_search_remove").on('click', function(){
                var element = $(this);
                var id = $(this).attr('data-id');
                if(id!= ''){
                    $.post("{{ route('delete.save.search') }}", {id: id,_method: 'POST', _token: '{{ csrf_token() }}'})
                        .done(function (response) {
                            $('.alert').remove();
                            if(response=='success'){
                                $(element).closest('tr').remove();
                                $('.dashboard-inner').before('<div class="alert alert-success" role="alert">This Save Search has been removed form list.</div>')
                            }
                        });
                }
            });

        });

    </script>

    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>

        $('th').on("click", function (event) {
            if($(event.target).is("div"))
                event.stopImmediatePropagation();
        });

        $(document).ready( function () {
            $('#saveSearch').DataTable({
                'filter' : false,
                'order' : [],
                'bPaginate' : false,
                "autoWidth": false,
                "columnDefs": [ {
                    "targets":  [0,2],
                    "orderable": false
                } ],
                'bInfo' : false
            });
        } );
    </script>


    @include('includes.immediate_available_btn')
@endpush
