<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
<div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <ul class="page-sidebar-menu page-header-fixed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
        <li class="sidebar-toggler-wrapper hide">
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <div class="sidebar-toggler"> </div>
            <!-- END SIDEBAR TOGGLER BUTTON -->
        </li>
        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
        <li class="sidebar-search-wrapper">
            <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
            <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
            <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
            <!-- END RESPONSIVE QUICK SEARCH FORM -->
        </li>
        <li class="nav-item start active"> <a href="{{ route('admin.home') }}" class="nav-link"> <i class="icon-home"></i> <span class="title">Dashboard</span> </a> </li>
        @include('admin/shared/side_bars/admin_user')

        <li class="heading">
            <h3 class="uppercase">Modules</h3>
        </li>

        @include('admin/shared/side_bars/archive')

        @include('admin/shared/side_bars/site_user')
        @include('admin/shared/side_bars/club')
        @include('admin/shared/side_bars/event')
        @include('admin/shared/side_bars/financial_partner')
        @include('admin/shared/side_bars/Judges_Jury')
        @include('admin/shared/side_bars/arms')
        @include('admin/shared/side_bars/news_and_notice')
        @include('admin/shared/side_bars/members')
{{--        @include('admin/shared/side_bars/committee_executive_members')--}}
{{--        @include('admin/shared/side_bars/committee_camp_commandant_members')--}}
        @include('admin/shared/side_bars/committee_office_administration_members')
{{--        @include('admin/shared/side_bars/committee_sub_committee_members')--}}

        @if(Module::has('PhotoGallery'))
        @include('photogallery::layouts.nav')
        @endif
{{--        @include('admin/shared/side_bars/industry')--}}


       


		@if(APAuthHelp::check(['SUP_ADM']))
            @include('admin/shared/side_bars/cms')
            @include('admin/shared/side_bars/banner')
            {{--        @include('admin/shared/side_bars/testimonial')--}}
            {{--        @include('admin/shared/side_bars/hear_about_us')--}}
            @include('admin/shared/side_bars/faq')
            {{--        @include('admin/shared/side_bars/package')--}}
            {{--        @include('admin/shared/side_bars/payment_history')--}}
            @include('admin/shared/side_bars/slider')
        {{--<li class="heading">
            <h3 class="uppercase">Translation</h3>
        </li>--}}
{{--        @include('admin/shared/side_bars/language')--}}
 -->



        {{--<li class="heading">
            <h3 class="uppercase">Manage Location</h3>
        </li>--}}
{{--        @include('admin/shared/side_bars/country')--}}
{{--        @include('admin/shared/side_bars/country_detail')--}}
{{--        @include('admin/shared/side_bars/state')--}}
{{--        @include('admin/shared/side_bars/city')--}}


       



        <li class="heading">
            <h3 class="uppercase">Attributes</h3>
        </li>
            @include('admin/shared/side_bars/profession')
            @include('admin/shared/side_bars/event_type')
            @include('admin/shared/side_bars/career_level')
{{--        @include('admin/shared/side_bars/language')--}}
        @include('admin/shared/side_bars/gender')
{{--        @include('admin/shared/side_bars/industry')--}}
{{--        @include('admin/shared/side_bars/job_experience')--}}
        {{--@include('admin/shared/side_bars/job_title')
        @include('admin/shared/side_bars/job_type')
        @include('admin/shared/side_bars/degree_level')
        @include('admin/shared/side_bars/salary_period')--}}

        @include('admin/shared/side_bars/site_setting')
		@endif



    </ul>
    <!-- END SIDEBAR MENU -->
    <!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR