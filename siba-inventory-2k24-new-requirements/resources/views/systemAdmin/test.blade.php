<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Test</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <!-- Then include DataTables CSS-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
</head>

<body>


    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <!-- / Menu -->

            <!-- Layout container -->
                <!-- Navbar -->



                <!-- / Navbar -->

                <!-- Content wrapper -->
                    <!-- Content -->

                    <div class="card-body">
                        <div id="show_all_user_data"></div>
                    </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            //fetch user data from database function
            fetchAllUserData();

            function fetchAllUserData() {
                $.ajax({
                    url: '{{ route('fetchAllUserData') }}',
                    method: 'get',
                    success: function(response) {
                        // console.log(response);
                        $('#show_all_user_data').html(response);
                        // //Make table a data table
                        $('#studentDetailsTable').DataTable({
                            "scrollX": true,
                            // Enable horizontal scrolling
                        });
                    }


                });
            }

        });
    </script>


    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/ui-modals.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    {{-- Then include DataTables JavaScript  --}}
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

</body>

</html>
