@extends('layouts.app')

@section('title', 'Makku Frozen Food - Dashboard')

@section('vendorCSS')
<link rel="stylesheet" href="/lte/assets/css/shared/iconly.css">
@endsection

@section('content')
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h3>Dashboard</h3>
</div>

<div class="page-content">
    <section class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-6 mb-1">
                    <div class="card border-left-primary shadow py-2">
                        <div class="card-header">
                            <form id="sumViewsForm">
                                <div class="row">
                                    {{ csrf_field() }}
                                    <div class="col-lg-12 mb-1">
                                        <div class="form-floating">
                                            <select class="form-select" name="days" id="rangeSumViews">
                                                <option value="today">Today</option>
                                                <option value="yesterday">Yesterday</option>
                                                <option value="thisweek">This week</option>
                                                <option value="thismonth" selected selected>This month</option>
                                                <option value="thisyear">This year</option>
                                                <option value="lastweek">Last week</option>
                                                <option value="lastmonth">Last month</option>
                                                <option value="lastyear">Last year</option>
                                            </select>
                                            <label for="rangeSumViews">Range</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <h6 class="text-muted font-semibold">Views</h6>
                                    <div id="loaderSumViews" style='display: none;'>
                                        <img src="/lte/assets/images/svg-loaders/circles.svg" class="me-4" style="width: 3rem;" alt="audio"/>
                                    </div>
                                    <h6 id="sumViewsData" class="font-extrabold mb-0"></h6>
                                </div>

                                <div class="col-auto">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-1">
                    <div class="card border-left-primary shadow py-2">
                        <div class="card-header">
                            <form id="sumVisitorsForm">
                                <div class="row">
                                    {{ csrf_field() }}
                                    <div class="col-lg-12 mb-1">
                                        <div class="form-floating">
                                            <select class="form-select" name="days" id="rangeSumVisitors">
                                                <option value="today">Today</option>
                                                <option value="yesterday">Yesterday</option>
                                                <option value="thisweek">This week</option>
                                                <option value="thismonth" selected selected>This month</option>
                                                <option value="thisyear">This year</option>
                                                <option value="lastweek">Last week</option>
                                                <option value="lastmonth">Last month</option>
                                                <option value="lastyear">Last year</option>
                                            </select>
                                            <label for="rangeSumVisitors">Range</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <h6 class="text-muted font-semibold">Visitors</h6>
                                    <div id="loaderSumVisitors" style='display: none;'>
                                        <img src="/lte/assets/images/svg-loaders/circles.svg" class="me-4" style="width: 3rem;" alt="audio"/>
                                    </div>
                                    <h6 id="sumVisitorsData" class="font-extrabold mb-0"></h6>
                                </div>

                                <div class="col-auto">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="card border-left-primary shadow py-2">
                        <div class="card-header">
                            <form id="sumReturningVisitorsForm">
                                <div class="row">
                                    {{ csrf_field() }}
                                    <div class="col-lg-12 mb-1">
                                        <div class="form-floating">
                                            <select class="form-select" name="days" id="rangeSumReturningVisitors">
                                                <option value="today">Today</option>
                                                <option value="yesterday">Yesterday</option>
                                                <option value="thisweek">This week</option>
                                                <option value="thismonth" selected>This month</option>
                                                <option value="thisyear">This year</option>
                                                <option value="lastweek">Last week</option>
                                                <option value="lastmonth">Last month</option>
                                                <option value="lastyear">Last year</option>
                                            </select>
                                            <label for="rangeSumReturningVisitors">Range</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <h6 class="text-muted font-semibold">Returning Visitors</h6>
                                    <div id="loaderSumReturningVisitors" style='display: none;'>
                                        <img src="/lte/assets/images/svg-loaders/circles.svg" class="me-4" style="width: 3rem;" alt="audio"/>
                                    </div>
                                    <h6 id="sumReturningVisitorsData" class="font-extrabold mb-0"></h6>
                                </div>

                                <div class="col-auto">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="card border-left-primary shadow py-2">
                        <div class="card-header">
                            <form id="sumAvgSessionsForm">
                                <div class="row">
                                    {{ csrf_field() }}
                                    <div class="col-lg-12 mb-1">
                                        <div class="form-floating">
                                            <select class="form-select" name="days" id="rangeSumAvgSessions">
                                                <option value="today">Today</option>
                                                <option value="yesterday">Yesterday</option>
                                                <option value="thisweek">This week</option>
                                                <option value="thismonth" selected>This month</option>
                                                <option value="thisyear">This year</option>
                                                <option value="lastweek">Last week</option>
                                                <option value="lastmonth">Last month</option>
                                                <option value="lastyear">Last year</option>
                                            </select>
                                            <label for="rangeSumAvgSessions">Range</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <h6 class="text-muted font-semibold">Average Sessions (seconds)</h6>
                                    <div id="loaderSumAvgSessions" style='display: none;'>
                                        <img src="/lte/assets/images/svg-loaders/circles.svg" class="me-4" style="width: 3rem;" alt="audio"/>
                                    </div>
                                    <h6 id="sumAvgSessionsData" class="font-extrabold mb-0"></h6>
                                </div>

                                <div class="col-auto">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
            </div>

            {{-- Most Views By Page --}}
            <div class="row">
                <div class="col-12">
                    <div class="card border-left-primary shadow py-2">
                        <div class="card-header">
                            <form id="mostViewsByPageForm">
                                <div class="row">
                                    <div class="col-6 mb-1">
                                        <h4>Most Views by Page</h4>
                                    </div>
                                    {{ csrf_field() }}
                                    <div class="col-lg-2 mb-1">
                                        <div class="form-floating">
                                            <select class="form-select" name="days" id="rangeMostViewsByPage">
                                            <option value="today">Today</option>
                                            <option value="yesterday">Yesterday</option>
                                            <option value="thisweek">This week</option>
                                            <option value="thismonth" selected>This month</option>
                                            <option value="thisyear">This year</option>
                                            <option value="lastweek">Last week</option>
                                            <option value="lastmonth">Last month</option>
                                            <option value="lastyear">Last year</option>

                                            </select>
                                            <label for="rangeMostViewsByPage">Range</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 mb-1">
                                        <div class="form-floating">
                                            <input type="text" name="count" class="form-control" id="floatingCount" placeholder="Count" value="10">
                                            <label for="floatingCount">Count</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 mb-1">
                                        <button class='btn btn-outline-primary' id="applyFilterMostViews">Apply Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-body text-center">
                            <div id="loaderMostViews" style='display: none;'>
                                <img src="/lte/assets/images/svg-loaders/audio.svg" class="me-4" style="width: 3rem;" alt="audio"/>
                            </div>
                            <div id="chart-most-views"></div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End of Most Views By Page --}}

            {{-- Total Visitors By Date --}}
            <div class="row">
                <div class="col-12">
                    <div class="card border-left-primary shadow py-2">
                        <div class="card-header">
                            <form id="totalVisitorsByDateForm">
                                <div class="row">
                                    <div class="col-10 mb-1">
                                        <h4>Total Visitors by Date</h4>
                                    </div>
                                    {{ csrf_field() }}
                                    <div class="col-lg-2 mb-1">
                                        <div class="form-floating">
                                            <select class="form-select" name="days" id="rangeTotalVisitorsByDate">
                                            <option value="today">Today</option>
                                            <option value="yesterday">Yesterday</option>
                                            <option value="thisweek">This week</option>
                                            <option value="thismonth" selected>This month</option>
                                            <option value="thisyear">This year</option>
                                            <option value="lastweek">Last week</option>
                                            <option value="lastmonth">Last month</option>
                                            <option value="lastyear">Last year</option>

                                            </select>
                                            <label for="rangeTotalVisitorsByDate">Range</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-body text-center">
                            <div id="loaderTotalVisitors" style='display: none;'>
                                <img src="/lte/assets/images/svg-loaders/audio.svg" class="me-4" style="width: 3rem;" alt="audio"/>
                            </div>
                            <div id="chart-total-visitors"></div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End of Total Visitors By Date --}}
        </div>
    </section>
</div>

@endsection

@section('vendorScript')
<script src="/lte/assets/extensions/jquery/jquery.min.js"></script>
<script src="/lte/assets/extensions/apexcharts/apexcharts.min.js"></script>
<script src="/lte/assets/js/pages/dashboard.js"></script>

<script>
    $(document).ready(function(){
        $("#loaderSumViews").hide();
        $("#loaderMostViews").hide();
        $("#loaderTotalVisitors").hide();

        // ============== Card Data ==============
        //Init load handler (views)
        $.ajax({
            beforeSend: function(){
                $("#rangeSumViews").attr("disabled", true);
                $("#sumViewsData").hide();
                $("#loaderSumViews").show();
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'POST',
            url: '{{ route('admin.dashboard.filterSumViews') }}',
            data: $("#sumViewsForm").serialize()
        })
        .done(function(data){
            console.log(data);
            $("#loaderSumViews").hide();

            $("#sumViewsData").show();
            $("h6#sumViewsData").text(data);

            $("#rangeSumViews").attr("disabled", false);
        })
        .fail(function() {
            alert( "Posting failed." );
        });

        //Init load handler (visitors)
        $.ajax({
            beforeSend: function(){
                $("#rangeSumVisitors").attr("disabled", true);
                $("#sumVisitorsData").hide();
                $("#loaderSumVisitors").show();
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'POST',
            url: '{{ route('admin.dashboard.filterSumVisitors') }}',
            data: $("#sumVisitorsForm").serialize()
        })
        .done(function(data){
            console.log(data);
            $("#loaderSumVisitors").hide();

            $("#sumVisitorsData").show();
            $("h6#sumVisitorsData").text(data);

            $("#rangeSumVisitors").attr("disabled", false);
        })
        .fail(function() {
            alert( "Posting failed." );
        });

        //Init load handler (returning visitors)
        $.ajax({
            beforeSend: function(){
                $("#rangeSumReturningVisitors").attr("disabled", true);
                $("#sumReturningVisitorsData").hide();
                $("#loaderSumReturningVisitors").show();
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'POST',
            url: '{{ route('admin.dashboard.filterSumReturningVisitors') }}',
            data: $("#sumReturningVisitorsForm").serialize()
        })
        .done(function(data){
            var strData = 0;
            var obj = jQuery.parseJSON(data);
            $.each(obj, function(key,value) {
                if(value.newVsReturning == 'returning') {
                    strData = value.totalUsers;
                    return false;
                }
            });

            $("#loaderSumReturningVisitors").hide();

            $("#sumReturningVisitorsData").show();
            $("h6#sumReturningVisitorsData").text(strData);

            $("#rangeSumReturningVisitors").attr("disabled", false);
        })
        .fail(function() {
            alert( "Posting failed." );
        });

        //Init load handler (average sessions)
        $.ajax({
            beforeSend: function(){
                $("#rangeSumAvgSessions").attr("disabled", true);
                $("#sumAvgSessionsData").hide();
                $("#loaderSumAvgSessions").show();
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'POST',
            url: '{{ route('admin.dashboard.filterSumAvgSessions') }}',
            data: $("#sumAvgSessionsForm").serialize()
        })
        .done(function(data){
            $("#loaderSumAvgSessions").hide();

            $("#sumAvgSessionsData").show();
            var roundUpData = Number(data).toFixed(2);
            $("h6#sumAvgSessionsData").text(roundUpData);

            $("#rangeSumAvgSessions").attr("disabled", false);
        })
        .fail(function() {
            alert( "Posting failed." );
        });

        //Filter handler (views)
        $('#rangeSumViews').change(function(e) {
            e.preventDefault();
            $.ajax({
                beforeSend: function(){
                    $("#sumViewsData").hide();
                    $("#rangeSumViews").attr("disabled", true);
                    $("#loaderSumViews").show();
                },
                headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                type: 'POST',
                url: '{{ route('admin.dashboard.filterSumViews') }}',
                data: $("#sumViewsForm").serialize()
            })
            .done(function(data){
                console.log(data);
                $("#loaderSumViews").hide();

                $("#sumViewsData").show();
                $("h6#sumViewsData").text(data);

                $("#rangeSumViews").attr("disabled", false);
            })
            .fail(function() {
                alert( "Posting failed." );
            });
            return false;
        });

        //Filter handler (visitors)
        $('#rangeSumVisitors').change(function(e) {
            e.preventDefault();
            $.ajax({
                beforeSend: function(){
                    $("#sumVisitorsData").hide();
                    $("#rangeSumVisitors").attr("disabled", true);
                    $("#loaderSumVisitors").show();
                },
                headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                type: 'POST',
                url: '{{ route('admin.dashboard.filterSumVisitors') }}',
                data: $("#sumVisitorsForm").serialize()
            })
            .done(function(data){
                console.log(data);
                $("#loaderSumVisitors").hide();

                $("#sumVisitorsData").show();
                $("h6#sumVisitorsData").text(data);

                $("#rangeSumVisitors").attr("disabled", false);
            })
            .fail(function() {
                alert( "Posting failed." );
            });
            return false;
        });

        //Filter handler (returning visitors)
        $('#rangeSumReturningVisitors').change(function(e) {
            e.preventDefault();
            $.ajax({
                beforeSend: function(){
                    $("#sumReturningVisitorsData").hide();
                    $("#rangeSumReturningVisitors").attr("disabled", true);
                    $("#loaderSumReturningVisitors").show();
                },
                headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                type: 'POST',
                url: '{{ route('admin.dashboard.filterSumReturningVisitors') }}',
                data: $("#sumReturningVisitorsForm").serialize()
            })
            .done(function(data){
                console.log(data);
                var strData = 0;
                var obj = jQuery.parseJSON(data);
                $.each(obj, function(key,value) {
                    if(value.newVsReturning == 'returning') {
                        strData = value.totalUsers;
                        return false;
                    }
                });
                
                $("#loaderSumReturningVisitors").hide();

                $("#sumReturningVisitorsData").show();
                $("h6#sumReturningVisitorsData").text(strData);

                $("#rangeSumReturningVisitors").attr("disabled", false);
            })
            .fail(function() {
                alert( "Posting failed." );
            });
            return false;
        });

        //Filter handler (average sessions)
        $('#rangeSumAvgSessions').change(function(e) {
            e.preventDefault();
            $.ajax({
                beforeSend: function(){
                    $("#sumAvgSessionsData").hide();
                    $("#rangeSumAvgSessions").attr("disabled", true);
                    $("#loaderSumAvgSessions").show();
                },
                headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                type: 'POST',
                url: '{{ route('admin.dashboard.filterSumAvgSessions') }}',
                data: $("#sumAvgSessionsForm").serialize()
            })
            .done(function(data){
                console.log(data);
                $("#loaderSumAvgSessions").hide();

                $("#sumAvgSessionsData").show();
                var roundUpData = data.toFixed(2);
                $("h6#sumAvgSessionsData").text(roundUpData);

                $("#rangeSumAvgSessions").attr("disabled", false);
            })
            .fail(function() {
                alert( "Posting failed." );
            });
            return false;
        });

        // ============== End of Card Data ==============
        
        //Init Graphic Data
        $.ajax({
            beforeSend: function(){
                $("#rangeMostViewsByPage").attr("disabled", true);
                $("#floatingCount").attr("disabled", true);
                $("#loaderMostViews").show();
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'POST',
            url: '{{ route('admin.dashboard.filterMostViewsByPage') }}',
            data: $("#mostViewsByPageForm").serialize()
        })
        .done(function(data){
            var objData = [], objCategory = [];
            var lenData = 0;
            var obj = jQuery.parseJSON(data);
            $.each(obj, function(key,value) {
                lenData++;
                objData.push(value.screenPageViews);
                objCategory.push(value.pageTitle);
            });
            initMostViewsByPage(objData, objCategory);
            $("#loaderMostViews").hide();
            $("#rangeMostViewsByPage").attr("disabled", false);
            $("#floatingCount").attr("disabled", false);
        })
        .fail(function() {
            alert( "Posting failed." );
        });

        $.ajax({
            beforeSend: function(){
                $("#rangeTotalVisitorsByDate").attr("disabled", true);
                $("#loaderTotalVisitors").show();
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'POST',
            url: '{{ route('admin.dashboard.filterTotalUsersByDate') }}',
            data: $("#totalVisitorsByDateForm").serialize()
        })
        .done(function(data){
            var objData = [], objCategory = [];

            var lenData = 0;
            var obj = jQuery.parseJSON(data);
            $.each(obj, function(key,value) {
                lenData++;
                objData.push(value.totalUsers);
                
                var tempDate = value.date;
                var year = tempDate.substring(0, 4);
                var month = tempDate.substring(4, 6);
                var day = tempDate.substring(6, 8);
                var strDate = day+"-"+month+"-"+year;

                objCategory.push(strDate);
            });
            initTotalVisitorsByDate(objData, objCategory);
            $("#loaderTotalVisitors").hide();
            $("#rangeTotalVisitorsByDate").attr("disabled", false);
        })
        .fail(function() {
            alert( "Posting failed." );
        });
        //End of Init Graphic Data

        //Filter Handler
        $("#applyFilterMostViews").click(function(e){
            e.preventDefault();
            $.ajax({
                beforeSend: function(){
                    $("#rangeMostViewsByPage").attr("disabled", true);
                    $("#floatingCount").attr("disabled", true);
                    $("#loaderMostViews").show();
                },
                headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                type: 'POST',
                url: '{{ route('admin.dashboard.filterMostViewsByPage') }}',
                data: $("#mostViewsByPageForm").serialize()
            })
            .done(function(data){
                // var data = '[{"pageTitle":"Makku Frozen Food","screenPageViews":"2"},{"pageTitle":"Makku Frozen Food - Our Company","screenPageViews":"2"}]';
                var objData = [], objCategory = [];

                var lenData = 0;
                var obj = jQuery.parseJSON(data);
                $.each(obj, function(key,value) {
                    lenData++;
                    // alert(value.screenPageViews);
                    objData.push(value.screenPageViews);
                    objCategory.push(value.pageTitle);
                });
                filterDataMostViewsByPage(objData, objCategory);
                $("#loaderMostViews").hide();
                $("#rangeMostViewsByPage").attr("disabled", false);
                $("#floatingCount").attr("disabled", false);
            })
            .fail(function() {
                alert( "Posting failed." );
            });
        });

        $("#rangeTotalVisitorsByDate").change(function(e){
            e.preventDefault();
            $.ajax({
                beforeSend: function(){
                    $("#rangeTotalVisitorsByDate").attr("disabled", true);
                    $("#loaderTotalVisitors").show();
                },
                headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                type: 'POST',
                url: '{{ route('admin.dashboard.filterTotalUsersByDate') }}',
                data: $("#totalVisitorsByDateForm").serialize()
            })
            .done(function(data){
                var objData = [], objCategory = [];

                var lenData = 0;
                var obj = jQuery.parseJSON(data);
                $.each(obj, function(key,value) {
                    lenData++;
                    objData.push(value.totalUsers);
                    
                    var tempDate = value.date;
                    var year = tempDate.substring(0, 4);
                    var month = tempDate.substring(4, 6);
                    var day = tempDate.substring(6, 8);
                    var strDate = day+"-"+month+"-"+year;

                    objCategory.push(strDate);
                });
                filterDataTotalVisitorsByDate(objData, objCategory);
                $("#loaderTotalVisitors").hide();
                $("#rangeTotalVisitorsByDate").attr("disabled", false);
            })
            .fail(function() {
                alert( "Posting failed." );
            });
        });
        //End of Filter Handler

        

    });
</script>

@endsection