        <div class="footer_part">
            <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer_iner text-center">
                        {{-- <p>2020 © Influence - Designed by <a href="#"> <i class="ti-heart"></i> </a><a href="#"> Dashboard</a></p> --}}
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>
    <div id="back-top" style="display: none;">
        <a title="Go to Top" href="#">
            <i class="ti-angle-up"></i>
        </a>
    </div>

    {{-- Modals  --}}
    <div class="modal" id="confirmDeleteModal1" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="confirmDeleteModalLabel">
                        Confirm Delete
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    Are you sure you want to delete this item?
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <form action="" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="delete" />
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    


    <script src="{{asset('admin-assets/js/jquery1-3.4.1.min.js')}}"></script>
    <script src="{{asset('admin-assets/js/popper1.min.js')}}"></script>
    <script src="{{asset('admin-assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin-assets/js/metisMenu.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/count_up/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/chartlist/Chart.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/count_up/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/niceselect/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/owl_carousel/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/datatable/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/datatable/js/jszip.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/datepicker/datepicker.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/datepicker/datepicker.en.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/datepicker/datepicker.custom.js')}}"></script>
    <script src="{{asset('admin-assets/js/chart.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/chartjs/roundedBar.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/progressbar/jquery.barfiller.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/tagsinput/tagsinput.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/am_chart/amcharts.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/scroll/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/scroll/scrollable-custom.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/vectormap-home/vectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/vectormap-home/vectormap-world-mill-en.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/apex_chart/apex-chart2.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/apex_chart/apex_dashboard.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/echart/echarts.min.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/chart_am/core.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/chart_am/charts.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/chart_am/animated.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/chart_am/kelly.js')}}"></script>
    <script src="{{asset('admin-assets/vendors/chart_am/chart-custom.js')}}"></script>
    <script src="{{asset('admin-assets/js/dashboard_init.js')}}"></script>
    <script src="{{asset('admin-assets/js/custom.js')}}"></script>
    <script>
        $(document).on('click', '.modalDeleteButton', function() {
            var form_action = $(this).data('form-action');
            var form = $("#confirmDeleteModal1 .modal-footer").find("form");
            $(form).attr('action', form_action);
        });
        $(".metismenu .has-arrow").click(function(e) {
            // Prevent default behavior (if necessary)
            e.preventDefault();

            // Get the parent 'li' element
            var parentLi = $(this).parent('li');

            // Toggle the active class on the clicked item
            parentLi.toggleClass("mm-active");

            // Toggle the submenu
            var submenu = parentLi.children('ul');
            if (submenu.length) {
                submenu.slideToggle(300).toggleClass("mm-show");
            }

            // Optionally, close other open submenus if you want only one to be open at a time
            parentLi.siblings().removeClass("mm-active").children("ul.mm-show").slideUp(300).removeClass("mm-show");
        });
    </script>
    @yield('js')
    
 </body>
 </html>