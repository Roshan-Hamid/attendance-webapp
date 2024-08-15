<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
	<!--begin::Toolbar wrapper-->
	<div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
		<!--begin::Page title-->
		<div class="page-title d-flex flex-column justify-content-center gap-1 me-3 ms-1">
			<!--begin::Breadcrumb-->
			<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7">
				<!--begin::Item-->
				<li class="breadcrumb-item text-gray-700 fw-bold lh-1 mx-n1">
					<a href="<?= base_url() ?>dashboard" class="text-hover-primary">
					<i class="ki-outline ki-home text-gray-700 fs-6"></i>
					</a>
				</li>
				<!--end::Item-->
				<!--begin::Item-->
				<li class="breadcrumb-item">
					<i class="ki-outline ki-right fs-7 text-gray-700"></i>
				</li>
				<!--end::Item-->
				<!--begin::Item-->
				<li class="breadcrumb-item text-gray-500 mx-n1"><?php print_r($folder); ?></li>
              	<!--end::Item-->
			</ul>
			<!--end::Breadcrumb-->
			<!--begin::Title-->
			<h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 ms-n1"></h1>
			<!--end::Title-->
		</div>
		<!--end::Page title-->
		<!--begin::Actions-->
		<div class="d-flex align-items-center gap-2 gap-lg-3">
			<!-- <a href="#" class="btn btn-flex btn-outline btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold" data-bs-toggle="modal"data-bs-target="#material_add_modal">Add Branch</a> -->
			<!-- <a href="#" class="btn btn-flex btn-primary h-40px fs-7 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_create_campaign">New Device</a> -->
		</div>
		<!--end::Actions-->
	</div>
	<!--end::Toolbar wrapper-->
</div>
<!--end::Toolbar-->
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-7" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Dashboard-->

            <!--begin::Row-->
            <div class="row">

                <div class="col-xl-3">
					<!--begin::Statistics Widget 5-->
					<a href="#" class="card bg-warning hoverable card-xl-stretch mb-5 mb-xl-8">
						<!--begin::Body-->
						<div class="card-body">
							<i class="ki-outline bi bi-people text-white fs-2x ms-n1"></i>
							<div class="text-white fw-bold fs-2 mb-2 mt-5"><?= $staffs_count ?></div>
							<div class="fw-semibold text-white">Staffs</div>
						</div>
						<!--end::Body-->
					</a>
					<!--end::Statistics Widget 5-->
				</div>

                <div class="col-xl-3">
					<!--begin::Statistics Widget 5-->
					<a href="#" class="card bg-info hoverable card-xl-stretch mb-5 mb-xl-8">
						<!--begin::Body-->
						<div class="card-body">
							<i class="ki-outline bi-building-fill text-white fs-2x ms-n1"></i>
							<div class="text-white fw-bold fs-2 mb-2 mt-5"><?= $branch_count ?></div>
							<div class="fw-semibold text-white">Branches</div>
						</div>
						<!--end::Body-->
					</a>
					<!--end::Statistics Widget 5-->
				</div>

                <div class="col-xl-3">
					<!--begin::Statistics Widget 5-->
					<a href="#" class="card bg-danger hoverable card-xl-stretch mb-5 mb-xl-8">
						<!--begin::Body-->
						<div class="card-body">
							<i class="ki-outline bi-person-badge text-white fs-2x ms-n1"></i>
							<div class="text-white fw-bold fs-2 mb-2 mt-5"><?= $manager ?></div>
							<div class="fw-semibold text-white">Manager</div>
						</div>
						<!--end::Body-->
					</a>
					<!--end::Statistics Widget 5-->
				</div>

            </div>

            <!--end::Dashboard-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->


<!-- <script src="https://www.gstatic.com/charts/loader.js"></script> -->


<script type="text/javascript">
  $('.menu-item-active').removeClass('menu-item-active');
  $('#home_1').addClass('menu-item-active');

  $('body').on('click', '#sign_in_btn', function() {
    var txt = $(this).html();
    if(txt=='SIGN IN'){
        $(this).html('SIGN OUT');
        $(this).removeClass('btn-transparent-success').addClass('btn-transparent-danger')
    }else{
        $(this).html('SIGN IN');
        $(this).addClass('btn-transparent-success').removeClass('btn-transparent-danger')
    }
});


  var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };
// var colours = array

var element = document.getElementById("pcm_chart_1");
var options = {
        // series: [{
        //     name: 'Net Profit',
        //     data: [30, 40, 40, 90, 90, 70, 70]
        // }],

        theme: {
            palette: 'palette10'
        },

        series: [{
            name: 'Sales Man 1',
            data: [31, 40, 28, 32, 42, 109, 100]
        }, 


        {
            name: 'Sales Man 2',
            data: [11, 32, 45, 32, 34, 52, 41]
        },{
            name: 'Sales Man 3',
            data: [20, 32, 55, 32, 84, 62, 11]
        }


            // ,{
            //     name: 'Sales Man 4',
            //     data: [14, 14, 25, 25, 34, 87, 79]
            // }

            ],

            chart: {
                type: 'line',
                height: 350,
                toolbar: {
                    show: true
                }
            },
            plotOptions: {

            },
            legend: {
                show: true

            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'solid',
                opacity: 1
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 3,
            // colors: [KTAppSettings['colors']['theme']['base']['info']]
            colours: undefined
        },
        xaxis: {
            categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false
            },
            labels: {
                style: {
                    // colors: KTAppSettings['colors']['gray']['gray-500'],
                    fontSize: '12px',
                    fontFamily: KTAppSettings['font-family']
                }
            },
            crosshairs: {
                position: 'front',
                stroke: {
                    color: KTAppSettings['colors']['theme']['base']['info'],
                    width: 1,
                    dashArray: 3
                }
            },
            tooltip: {
                enabled: true,
                formatter: undefined,
                offsetY: 0,
                style: {
                    fontSize: '12px',
                    fontFamily: KTAppSettings['font-family']
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    // colors: KTAppSettings['colors']['gray']['gray-500'],
                    fontSize: '12px',
                    fontFamily: KTAppSettings['font-family']
                }
            }
        },
        states: {
            normal: {
                filter: {
                    type: 'none',
                    value: 0
                }
            },
            hover: {
                filter: {
                    type: 'none',
                    value: 0
                }
            },
            active: {
                allowMultipleDataPointsSelection: false,
                filter: {
                    type: 'none',
                    value: 0
                }
            }
        },
        tooltip: {
            style: {
                fontSize: '12px',
                fontFamily: KTAppSettings['font-family']
            },
            y: {
                formatter: function (val) {
                    return val + " Hours"
                },

                title: {
                    formatter: function(value, { series, seriesIndex, dataPointIndex, w }) {
                      return false
                  }
              }
          }
      },
        // colors: [KTAppSettings['colors']['theme']['light']['info']],
        grid: {
            borderColor: KTAppSettings['colors']['gray']['gray-200'],
            strokeDashArray: 4,
            yaxis: {
                lines: {
                    show: true
                }
            }
        },
        markers: {
                //size: 5,
                //colors: [KTAppSettings['colors']['theme']['light']['danger']],
                strokeColor: KTAppSettings['colors']['theme']['base']['info'],
                strokeWidth: 3
            }
        };

        // var chart = new ApexCharts(element, options);
        // chart.render();












        var element2 = document.getElementById("pcm_chart_2");
        var options2 = {
        // series: [{
        //     name: 'Net Profit',
        //     data: [30, 40, 40, 90, 90, 70, 70]
        // }],

        theme: {
            palette: 'palette9'
        },

        series: [{
            name: 'Manager 1',
            data: [31, 40, 28, 51, 42, 109, 100]
        }, 


        {
            name: 'Manager 2',
            data: [11, 32, 45, 32, 34, 52, 41]
        },{
            name: 'Manager 3',
            data: [20, 32, 55, 02, 84, 62, 11]
        }


            // ,{
            //     name: 'Sales Man 4',
            //     data: [14, 14, 25, 25, 34, 87, 79]
            // }

            ],

            chart: {
                type: 'line',
                height: 350,
                toolbar: {
                    show: true
                }
            },
            plotOptions: {

            },
            legend: {
                show: true

            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'solid',
                opacity: 1
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 3,
            // colors: [KTAppSettings['colors']['theme']['base']['info']]
            colours: undefined
        },
        xaxis: {
            categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false
            },
            labels: {
                style: {
                    // colors: KTAppSettings['colors']['gray']['gray-500'],
                    fontSize: '12px',
                    fontFamily: KTAppSettings['font-family']
                }
            },
            crosshairs: {
                position: 'front',
                stroke: {
                    color: KTAppSettings['colors']['theme']['base']['info'],
                    width: 1,
                    dashArray: 3
                }
            },
            tooltip: {
                enabled: true,
                formatter: undefined,
                offsetY: 0,
                style: {
                    fontSize: '12px',
                    fontFamily: KTAppSettings['font-family']
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    // colors: KTAppSettings['colors']['gray']['gray-500'],
                    fontSize: '12px',
                    fontFamily: KTAppSettings['font-family']
                }
            }
        },
        states: {
            normal: {
                filter: {
                    type: 'none',
                    value: 0
                }
            },
            hover: {
                filter: {
                    type: 'none',
                    value: 0
                }
            },
            active: {
                allowMultipleDataPointsSelection: false,
                filter: {
                    type: 'none',
                    value: 0
                }
            }
        },
        tooltip: {
            style: {
                fontSize: '12px',
                fontFamily: KTAppSettings['font-family']
            },
            y: {
                formatter: function (val) {
                    return val + " Hours"
                },

                title: {
                    formatter: function(value, { series, seriesIndex, dataPointIndex, w }) {
                      return false
                  }
              }
          }
      },
        // colors: [KTAppSettings['colors']['theme']['light']['info']],
        grid: {
            borderColor: KTAppSettings['colors']['gray']['gray-200'],
            strokeDashArray: 4,
            yaxis: {
                lines: {
                    show: true
                }
            }
        },
        markers: {
                //size: 5,
                //colors: [KTAppSettings['colors']['theme']['light']['danger']],
                strokeColor: KTAppSettings['colors']['theme']['base']['info'],
                strokeWidth: 3
            }
        };

        // var chart2 = new ApexCharts(element2, options2);
        // chart2.render();






        const apexChart = "#chart_3";
        var options = {
            series: [{
                name: 'Net Profit',
                data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
            }, {
                name: 'Revenue',
                data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
            }, {
                name: 'Free Cash Flow',
                data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            },
            yaxis: {
                title: {
                    text: '$ (thousands)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return "$ " + val + " thousands"
                    }
                }
            },
            colors: ["#3699FF", "#1BC5BD", "#FFA800"]
        };

        // var chart = new ApexCharts(document.querySelector(apexChart), options);
        // chart.render();

    </script>
