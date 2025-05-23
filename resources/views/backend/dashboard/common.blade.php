<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Fabrics Dashboard</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <!-- Bootstrap icon CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
    <!-- Custom CSS -->
    <style>
        /* .logo {
            max-height: 50px;
        } */

        .today-date {
            text-align: right;
        }

        /* .body {
            margin: 10px 10px 10px 10px;
        } */
    </style>
</head>

<body style="background: #263037">

    <div class="container-fluid text-center text-light">
        <!-- First Row -->
        <div class="row mb-3">
            <div class="row ">
            <div class="col-md-3 d-flex flex-column justify-content-left align-items-left">
                    <p> <img src="{{ asset('images/assets/logo.png') }}" alt="" heigt=350px; width=150px;
                            class="logo" style="margin: 1%; "></p>
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
                <h1 style="font-size: 4.5vw;"> Tosrifa Industries Ltd. </h1>
                    <h5 style="font-size: 1vw;"> 121/1, Beraider Chala, Sreepur, Gazipur </h5>
                     
                    <p class="text-bold" style="font-size: 1vw;"><strong> Warehouse  Stock Yarn & Grey Fabrics Information Dashboard</strong></h3>
                </div>

                <div
                    class="col-md-3 today-date text-light d-flex flex-column justify-content-center align-items-center">
                    <strong style="font-size: 1vw;">
                        Today's Date: <span id="currentDate"></span> <br>
                        Current Time: <span id="currentTime"></span>
                    </strong>



                </div>
            </div>

            <!-- 3rd Row -->
            <div class="col-md-6 col-sm-12">
                <table class="table table-bordered  text-center no-wrap text-light pt-2">
                    <thead style="background-color: #000000"> 
                            <tr>
                                <!-- <th>Sl#</th> -->
                                <th>Date</th>
                                <th>Opening</th>
                                <th>Received</th>
                                <th>Received Cumulative</th>
                                <th>Issue</th>
                                <th>Issue Cumulative</th>
                                <th>Stock in Hand</th>
                            </tr>
                        </thead>
                    <tbody id="yarns_tbody">
                        @php $sl=0 @endphp
                        @foreach ($yarns as $grey_fabric)
                            <tr>
                                <td>{{ ++$sl }}</td>
                                <!-- if friday then this row will be red but now data show in this row -->
                                @php
                                    $date = date('d', strtotime($grey_fabric->date));
                                    $day = date('D', strtotime($grey_fabric->date));
                                @endphp
                                @if ($day == 'Fri')
                                    <td style="background-color: red">{{ $grey_fabric->date }}</td>
                                @else
                                    <td>{{ $grey_fabric->date }}</td>
                                @endif
                                <td>
                                    @if (date('d', strtotime($grey_fabric->date)) === '01')
                                        {{ number_format($grey_fabric->opening_qty, 0) }}
                                    @endif
                                </td>
                                <td>{{ number_format($grey_fabric->received_qty, 0) }}</td>
                                <td>{{ number_format($grey_fabric->received_qumilative_qty, 0) }}</td>
                                <td>{{ $grey_fabric->issue_qty }}</td>
                                <td> {{ number_format($grey_fabric->issue_qumilative_qty, 0) }}</td>
                                <td> {{ number_format($grey_fabric->stock_in_hand, 0) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6 col-sm-12">
                <table class="table table-bordered  text-center no-wrap text-light pt-2">
                    <thead style="background-color: #000000"> 
                            <tr>
                                <!-- <th>Sl#</th> -->
                                <th>Date</th>
                                <th>Opening</th>
                                <th>Received</th>
                                <th>Received Cumulative</th>
                                <th>Issue</th>
                                <th>Issue Cumulative</th>
                                <th>Stock in Hand</th>
                            </tr>
                        </thead>
                    <tbody id="grey_fabric_tbody">
                        @php $sl=0 @endphp
                        @foreach ($grey_fabrics as $grey_fabric)
                            <tr>
                                <td>{{ ++$sl }}</td>
                                <!-- if friday then this row will be red but now data show in this row -->
                                @php
                                    $date = date('d', strtotime($grey_fabric->date));
                                    $day = date('D', strtotime($grey_fabric->date));
                                @endphp
                                @if ($day == 'Fri')
                                    <td style="background-color: red">{{ $grey_fabric->date }}</td>
                                @else
                                    <td>{{ $grey_fabric->date }}</td>
                                @endif
                                <td>
                                    @if (date('d', strtotime($grey_fabric->date)) === '01')
                                        {{ number_format($grey_fabric->opening_qty, 0) }}
                                    @endif
                                </td>
                                <td>{{ number_format($grey_fabric->received_qty, 0) }}</td>
                                <td>{{ number_format($grey_fabric->received_qumilative_qty, 0) }}</td>
                                <td>{{ $grey_fabric->issue_qty }}</td>
                                <td> {{ number_format($grey_fabric->issue_qumilative_qty, 0) }}</td>
                                <td> {{ number_format($grey_fabric->stock_in_hand, 0) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>


            <!-- Cards will be dynamically added here -->
        </div>

        <!-- Add jQuery and AJAX -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $.ajax({
                    url: '{{ route('getcommonDashboard') }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        data = response; // Store the response data
                        currentIndexYarns = 0; // Reset the index for yarns
                        currentIndexGreyFabrics = 0; // Reset the index for grey fabrics
                        displayNextBatch1();
                        displayNextBatch2();
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error);
                    }
                });
            });

            var batchSize = 6;
            var currentIndexYarns = 0;
            var currentIndexGreyFabrics = 0;
            var data = [];

            function displayNextBatch1() {
                if (currentIndexYarns >= data.yarns.length) {
                    currentIndexYarns = 0;
                }

                var end = Math.min(currentIndexYarns + batchSize, data.yarns.length);
                var batchData = data.yarns.slice(currentIndexYarns, end);

                displayBatch('yarns_tbody', batchData);

                currentIndexYarns = end;
                setTimeout(displayNextBatch1, 5000);
            }

            function displayNextBatch2() {
                if (currentIndexGreyFabrics >= data.grey_fabrics.length) {
                    currentIndexGreyFabrics = 0;
                }

                var end = Math.min(currentIndexGreyFabrics + batchSize, data.grey_fabrics.length);
                var batchData = data.grey_fabrics.slice(currentIndexGreyFabrics, end);

                displayBatch('grey_fabric_tbody', batchData);

                currentIndexGreyFabrics = end;
                setTimeout(displayNextBatch2, 5000);
            }

            function displayBatch(targetTableId, batchData) {
                var targetTableBody = $('#' + targetTableId);

                // Clear previous table rows
                targetTableBody.empty();

                $.each(batchData, function(key, value) {
                    var tr = `<tr> `;

                    var date = new Date(value.date);
                    var day = date.getDay();
                    var bgColor = day === 5 ? 'red' : 'transparent';
                    tr += `<td style="background-color: ${bgColor}">${date.toDateString()}</td>`;

                    if (date.getDate() === 1) {
                        tr += `<td>${numberWithCommas(value.opening_qty)}</td>`;
                    } else {
                        tr += '<td></td>';
                    }

                    tr += `<td>${numberWithCommas(value.received_qty)}</td>
                <td>${numberWithCommas(value.received_qumilative_qty)}</td>
                <td>${value.issue_qty}</td>
                <td>${numberWithCommas(value.issue_qumilative_qty)}</td>
                <td>${numberWithCommas(value.stock_in_hand)}</td>
            </tr>`;

                    targetTableBody.append(tr);
                });
            }

            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
            // Function to update the current date and time
            function updateDateTime() {
                var currentDate = new Date().toLocaleDateString(undefined, {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
                var currentTime = new Date().toLocaleTimeString(undefined, {
                    hour: '2-digit',
                    minute: '2-digit'
                });

                document.getElementById('currentDate').textContent = currentDate;
                document.getElementById('currentTime').textContent = currentTime;
            }

            // Call the function to update the date and time immediately
            updateDateTime();

            // Update the date and time every second (1000 milliseconds)
            setInterval(updateDateTime, 1000);
        </script>
</body>

</html>
