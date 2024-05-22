@extends('layouts.app')
@section('content')


    @if(isset($bannerData) && !empty($bannerData))
        <section class="page-title" style="background-image: url({{asset('banner/'.$bannerData->banner_image)}});">
    @else
        <section class="page-title" style="background-image: url({{asset('banner/no-image.jpg')}});">
    @endif
        <div class="auto-container">
            <div class="content-box">
                <div class="title centred">
                    @if(isset($bannerData) && !empty($bannerData))
                        <h1>{{$bannerData->banner_title}}</h1>
                    @else
                        <h1>No Banner title</h1>
                    @endif
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{url('/')}}">{{__('messages.Home')}}</a></li>
                    <li>
                        @if(isset($pathPageTitle) && !empty($pathPageTitle))
                            <a href=" {{route('archive_index')}}">
                        @endif

                        {{$pageTitle}}
                        @if(isset($pathPageTitle) && !empty($pathPageTitle))
                            </a>
                        @endif
                    </li>
                    @if(isset($pathPageTitle) && !empty($pathPageTitle))
                        <li>{{$pathPageTitle}}</li>
                    @endif
                    @if(isset($subPathPageTitle) && !empty($subPathPageTitle))
                        <li>{{$subPathPageTitle}}</li>
                    @endif

                </ul>
            </div>
        </div>
    </section>


    <!-- events-list -->
    <section class="events-list sec-pad-2">
        <div class="auto-container">
            <div class="event-list-content">
                {!! Form::open(array('method' => 'get', 'route' => 'archive_search', 'files'=>true,'id'=>'contact-form','class'=>'default-form','novalidate'=>'novalidate','autocomplete'=>'off')) !!}
                <div class="filter-box clearfix">
                    <div class="form-group" style="width: 95%">
                        <div class="select-box">
                            <input type="text" name="keyword" value="{{$keyword?$keyword:''}}" placeholder="{{__('messages.Search_Keyword')}}" id="keyword" required>
                        </div>
                    </div>
                    {{--<div class="form-group">
                        <i class="flaticon-calendar"></i>
                        <input type="text" name="date" placeholder="Date" id="datepicker">
                    </div>--}}
                    <div class="search-btn">
                        <button type="submit">{{__('messages.Search')}}</button>
                    </div>
                </div>
                {!! Form::close() !!}

                <div class="schedule-inner">
                    <h2 style="font-size: 15px;border-bottom: 1px solid;padding-bottom: 5px;font-weight: bold;">{{$archives->total()}} {{__('messages.Results_Records_in_Archives')}} </h2>
                    @if(count($archives)>0)
                @foreach($archives as $archive)

                        <div class="schedule-block-three">
                            <div class="inner-box" style="padding: 0px">
                                <div class="inner view-model" data-toggle="modal" data-target="#exampleModalCenter" archive-id="{{$archive->id}}" data-href="{{route('get_archive_multiple_attachment')}}" style="min-height: 122px">
                                    <div class="schedule-date" style="top: 15px;left: 15px;">
                                        {{--<h2 style="font-size: 0px;padding: 0px;line-height: 0px;"> <span class="year" style="padding: 8px 10px;
    display: block;">Event</span></h2>--}}
                                        <ul class="list clearfix" style="padding-bottom: 3px;cursor: pointer">
{{--                                            <a href="{{route('archive_download_user',$archive->id)}}">--}}
                                            <li><b><i class="fas fa-cloud-download"></i>&nbsp;<u style="color: red">{{'Download General Informations'}}<br>{{' and Results'}}</u></b></li>
                                                <li><i class="flaticon-clock-circular-outline"></i>{{date_format($archive->created_at,'d-F-Y').' '.date('h:i A', strtotime($archive->created_at))}}</li>
{{--                                            </a>--}}
                                        </ul>
                                    </div>

                                    <div class="text " style="padding-top: 15px;cursor: pointer">
                                        <h3>{{$archive->archive_name}}</h3>
                                        <p><?php echo $archive->sub_title;?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @endif
                </div>
            </div>
            <div class="pagination-wrapper centred">
                {{ $archives->links('includes.pagination-view') }}
            </div>
        </div>
    </section>
    <!-- events-list end -->

                <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Archive Attachment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Attachment</th>
                                        <th scope="col">Caption</th>
                                        <th scope="col">Download</th>
                                    </tr>
                                    </thead>
                                    <tbody class="more-attach">

                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>


@endsection

    @push('scripts')
        <script type="text/javascript">

            $(document).delegate('.view-model','click',function () {
                let archiveID = $(this).attr('archive-id');
                let route = $(this).attr('data-href');
                $.ajax({
                    url: route,
                    method: "GET",
                    dataType: "json",
                    data: {archiveID: archiveID},
                    beforeSend: function( xhr ) {

                    }
                }).done(function( response ) {
                    if(response.status == 'ok'){
                        $('.more-attach').html(response.content);
                    }else{
                        $('.more-attach').html('');
                    }
                }).fail(function( jqXHR, textStatus ) {

                });
                return false;
            });
        </script>
    @endpush

@push('styles')
    <style>
        .pager{
            padding: 0px;
        }

        .pager li{
            display: inline;
        }
        .pagination_custom_style{
            border: 1px solid;
            padding: 5px 10px;
            font-size: 15px;
            font-weight: bold;
            background: #e41e2f;
            color: #fff;
        }
        .active{
            background: #fff;
            color: #e41e2f;
        }

        .schedule-block-three .inner-box:hover h3{
            color: #fff;
        }

    </style>
@endpush
