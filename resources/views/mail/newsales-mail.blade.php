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
                    @if($status)
                    <h1>Product Sales</h1>
                    @else
                    <h1 style="color:#f54248;">Sales Cancellation</h1>
                    @endif

                </div>
                <div class="row mt-5">

                    <div class="col">
                        <p>Branch:{{' '.$sale->branch->name}}</p>
                        <p>Billed By:{{' '.$sale->user->name}}</p>
                        <p>Billed To:{{' '.$sale->name}}</p>
                        <p>Phone Number:{{' '.$sale->number}}</p>
                        <p>Date/Time:{{' '.$sale->created_at}}</p>
                    </div>
                    @if ($items != null)
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">S/N</th>
                            <th scope="col">Item</th>
                            <th scope="col">Engine Number</th>
                            <th scope="col">Chasis Number</th>
                            <th scope="col">Amount</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 0;
                            @endphp
                            @foreach ( $items as $item )
                            @php
                            $no ++;
                             @endphp
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$item->product->spec->name}}</td>
                                <td>{{$item->product->enginenumber}}</td>
                                <td>{{$item->product->chasisnumber}}</td>
                                <td>N{{number_format($item->price)}}</td>
                            </tr>

                            @endforeach
                            <tr>
                                <th>TOTAL</th>
                                <td>N{{number_format($sale->price)}}</td>
                            </tr>
                        </tbody>
                    </table>
                    @else
                    <table class="table">
                        <thead>
                          <tr>

                            <th scope="col">Item</th>
                            <th scope="col">No of Item</th>
                            <th scope="col">Amount</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$sale->ckd_type}}</td>
                                <td>{{$sale->no_of_ckd}}</td>
                                <td>N{{number_format($sale->price)}}</td>
                            </tr>
                        </tbody>
                    </table>
                    @endif


                </div>

                <footer class="footer">
                    © 2023 Allrounder
                </footer>
            </div>
            <!-- content -->



        </div>
        <!-- End Right content here -->

    </div>
    <!-- END wrapper -->




</body>

</html>
