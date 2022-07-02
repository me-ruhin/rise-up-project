@extends('admin.app')


@section('title','Dashboard')
@push('css')

@endpush

@section('content')
<!-- Welcome Area -->
   <div class="welcome-area">
                <div class="row m-0 align-items-center">
                    <div class="col-lg-5 col-md-12 p-0">
                        <div class="welcome-content">
                            <h1 class="mb-2">Hi,{{Auth::user()->name ?? ''}}!</h1>
                            <p class="mb-0">Just Do Somethings Better</p>
                        </div>
                    </div>

                    <div class="col-lg-7 col-md-12 p-0">
                        <div class="welcome-img">
                            <img src="{{asset('backend/assets/img/welcome-img.png')}}" alt="image">
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Welcome Area -->



@endsection

@push('js')
  <!-- ApexCharts JS -->
  <script src="{{asset('backend/assets/js/apexcharts/apexcharts.min.js')}}"></script>
        <script src="{{asset('backend/assets/js/apexcharts/apexcharts-stock-prices.js')}}"></script>
        <script src="{{asset('backend/assets/js/apexcharts/apexcharts-irregular-data-series.js')}}"></script>
        <script src="{{asset('backend/assets/js/apexcharts/apex-custom-line-chart.js')}}"></script>
        <script src="{{asset('backend/assets/js/apexcharts/apex-custom-pie-donut-chart.js')}}"></script>
        <script src="{{asset('backend/assets/js/apexcharts/apex-custom-area-charts.js')}}"></script>
        <script src="{{asset('backend/assets/js/apexcharts/apex-custom-column-chart.js')}}"></script>
        <script src="{{asset('backend/assets/js/apexcharts/apex-custom-bar-charts.js')}}"></script>
        <script src="{{asset('backend/assets/js/apexcharts/apex-custom-mixed-charts.js')}}"></script>
        <script src="{{asset('backend/assets/js/apexcharts/apex-custom-radialbar-charts.js')}}"></script>
        <script src="{{asset('backend/assets/js/apexcharts/apex-custom-radar-chart.js')}}"></script>




        <!-- ChartJS -->
        <script src="{{asset('backend/assets/js/chartjs/chartjs.min.js')}}"></script>
        <div class="chartjs-colors"> <!-- To use template colors with Javascript -->
            <div class="bg-primary"></div>
            <div class="bg-primary-light"></div>
            <div class="bg-secondary"></div>
            <div class="bg-info"></div>
            <div class="bg-success"></div>
            <div class="bg-success-light"></div>
            <div class="bg-danger"></div>
            <div class="bg-warning"></div>
            <div class="bg-purple"></div>
            <div class="bg-pink"></div>
        </div>

        <!-- jvectormap Min JS -->
        <script src="{{asset('backend/assets/js/jvectormap-1.2.2.min.js')}}"></script>
        <!-- jvectormap World Mil JS -->
        <script src="{{asset('backend/assets/js/jvectormap-world-mill-en.js')}}"></script>
@endpush
