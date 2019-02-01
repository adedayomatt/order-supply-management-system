<!DOCTYPE html>
<html lang="en">
    <head>
        <script src="{{asset('js/stackbox/main.js')}}"></script>    <!--This include JQuery, Popper.js, Bootstrap.js and select2.js-->
        <link rel="stylesheet" href="{{asset('css/stackbox/main.css')}}"> <!--This already include Bootstrap.css, select2.css-->
        <title>Dashboard</title>
    </head>
    <body>
    @include('business.dashboard.components.side-nav')
    @include('business.dashboard.components.top-bar')
        <div class="content-wrapper">
        @include('business.dashboard.widgets.quick-report')
            <div class="container">
                <div class="box-layout">
                    <div class="main-layout" style="width:100%">
                        @yield('main')
                    </div>
                    <div class="side-layout">
                        @yield('side')
                    </div>
                </div>
            </div>
        </div>
        <script>
			$(document).ready(function() {
				var lineChart = $("#line-chart")
				var lineData = {
					labels: ["02.00", "02.30", "03.00", "03.30", "04.00", "04.30", "02.00", "02.30", "03.00", "02.00", "02.30"],
					datasets: [{
						label: "Visitors Graph",
						borderColor: "#fbd5007a",
						pointRadius: 2,
						borderWidth: 1,
						backgroundColor: "transparent",
						pointBackgroundColor: "#fbd500",
						data: [1, 5, 10, 4, 20, 5, 10, 2, 12, 5, 1]
					},
					{
						label: "Visitors Graph",
						borderColor: "#48527270",
						pointRadius: 2,
						borderWidth: 1,
						backgroundColor: "transparent",
						pointBackgroundColor: "#5b6b98",
						data: [5, 32, 5, 42, 50, 59, 5, 32, 5, 40, 5]
					}]
				};

				var myLineChart = new Chart(lineChart, {
					type: 'line',
					data: lineData,
					options: {
						legend: {
							display: false
						},
						scales: {
							xAxes: [{
								ticks: {
									fontSize: '11',
									fontColor: '#969da5'
								},
								gridLines: {
									color: '#f6f8fd',
									zeroLineColor: '#f6f8fd'
								}
							}],
							yAxes: [{
								gridLines: {
									color: '#f6f8fd',
									zeroLineColor: '#f6f8fd'
								},
								ticks: {
									fontSize: '11',
									fontColor: '#969da5'
								}
							}]
						}
					}
				})
			})
		</script>
    </body>

</html>