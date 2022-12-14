<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Sale Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <style>
        *{
            background: #ffffff;
        }
        table, th, td {
            border: 1px solid;
        }
    </style>
</head>


<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Start right Content here -->

        <div class="content-page">
            <!-- Start content -->
            <div class="container bg-light">
                <div class="row">
                    <h1>Daily Sales Report</h1>
                </div>
                <div class="row mt-5">

                    <div class="col m-auto">

                    </div>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Branch</th>
                            <th scope="col">Motorcycles</th>
                            <th scope="col">Tricycles</th>
                            <th scope="col">Amount</th>
                          </tr>
                        </thead>
                        <tbody>
                        @php
                            $amount = 0;
                        @endphp
                        @foreach ($reports as $report)
                            @php
                                $amount = $amount + $report['amount'];
                            @endphp
                            <tr>
                                <td>{{$report['date']}}</td>
                                <td>{{$report['branch']}}</td>
                                <td>{{$report['motorcycles']}}</td>
                                <td>{{$report['tricycles']}}</td>
                                <td>N{{number_format($report['amount'])}}</td>
                            </tr>
                        @endforeach




                          <tr>
                            <td><span class="fw-bold">TOTAL</span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="3"><span class="fw-bold">N{{number_format($amount)}}</span></td>

                          </tr>
                        </tbody>
                    </table>
                </div>

                <footer class="footer">
                    © 2022 Allrounder
                </footer>
            </div>
            <!-- content -->



        </div>
        <!-- End Right content here -->

    </div>
    <!-- END wrapper -->




</body>

</html>
