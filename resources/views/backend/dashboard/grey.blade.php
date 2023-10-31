<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grey Fabrics Dashboard</title>
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
                    <h1 style="font-size: 4.5rem;"> Tosrifa Industries Ltd. </h1>
                    <h5> 121/1, Beraierchala, Sreepur, Gazipur </h5>
                     
                    <p class="text-bold" style="font-size: 2rem;"><strong> Wearhouse Stock Grey Fabrics Information Dashboard</strong></h3>
                </div>

                <div
                    class="col-md-3 today-date text-light d-flex flex-column justify-content-center align-items-center">
                    <strong>
                        Today's Date: <span id="currentDate"></span> <br>
                        Current Time: <span id="currentTime"></span>
                    </strong>



                </div>

                {{--  <div
                    class="col-md-2 today-date text-light d-flex flex-column justify-content-center align-items-center">
                     <select name="buyer_name" id="buyer_name" class="form-control">
                        <option value="all">All Buyer</option>
                        @php
                            $buyers = DB::table('trims_accessories_stores')
                                ->select('buyer_name')
                                ->distinct()
                                ->get();
                        @endphp

                        @foreach ($buyers as $buyer)
                            <option value="{{ $buyer->buyer_name }}">{{ $buyer->buyer_name }}</option>
                        @endforeach
                    </select> 

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-filter" viewBox="0 0 16 16">
                            <path
                                d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                        </svg>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Select Buyer</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <select name="buyer_name" id="buyer_name" class="form-control">
                                        <option value="all">All Buyer</option>
                                        @php
                                            $buyers = DB::table('fabric_information_boards')
                                                ->select('buyer_name')
                                                ->distinct()
                                                ->get();
                                        @endphp

                                        @foreach ($buyers as $buyer)
                                            <option value="{{ $buyer->buyer_name }}">{{ $buyer->buyer_name }}</option>
                                        @endforeach
                                    </select>



                                    <script>
                                        $(document).ready(function() {
                                            $('#buyer_name').select2();
                                        });
                                    </script> 
                                </div>
                                <div class="modal-footer"> 
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save
                                        changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div> --}}

            </div>

            <!-- 3rd Row -->
            {{-- <div class=" mb-3" id="card-container"> --}}
            <table class="table table-bordered  text-center no-wrap text-light pt-2" style="boder: #454545">
                <thead style="background-color:#183D3D ">
                    <tr style="font-size: 2.8rem;">
                        <!-- <th>Sl#</th> -->
                        <th>Date</th>
                        <th>Opening Qty</th>
                        <th>Received Qty</th>
                        <th>Received Qumilative Qty</th>
                        <th>Issue Qty</th>
                        <th>Issue Qumilative Qty</th>
                        <th>Stock in Hand</th>
                    </tr>
                </thead>
                <tbody style="font-size: 2.5rem;">
                    @php $sl=0 @endphp
                    @foreach ($grey_fabrics as $grey_fabric)
                        <tr>
                            <!-- <td>{{ ++$sl }}</td> -->
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


            <!-- Cards will be dynamically added here -->
        </div>

        <!-- Add jQuery and AJAX -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $.ajax({
                    url: '{{ route('get_grey_dashboard') }}',
                    type: 'GET',
                    dataType: 'json',

                    success: function(response) {
                        console.log(response);
                        data = response; // Store the response data
                        currentIndex = 0; // Reset the index
                        displayNextBatch(); // Start displaying data in batches
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error);
                    }
                });
            });

            var batchSize = 7; // Number of rows to display in each batch
            var currentIndex = 0; // Index to keep track of the current batch
            var data = []; // Array to store the data

            function displayNextBatch() {
                if (currentIndex >= data.length) {
                    // All data has been displayed
                    return;
                }

                var end = Math.min(currentIndex + batchSize, data.length);
                var batchData = data.slice(currentIndex, end);

                // Clear previous table rows
                $('tbody').empty();

                $.each(batchData, function(key, value) {
                    var date = new Date(value.date);
                    var day = date.getDay();
                    var tr = `<tr style="background-color: ${day === 5 ? 'red' : 'transparent'}">  `;

                    
                    tr +=
                        `<td > ${date.toLocaleDateString(undefined, { day: 'numeric' })}
                            </td>`;

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

                    $('tbody').append(tr);
                });

                currentIndex = end;

                if (currentIndex < data.length) {
                    // Schedule the next batch with a 10-second delay
                    setTimeout(displayNextBatch, 5000);
                    //if data length end then start from 0
                } else {
                    currentIndex = 0;
                    setTimeout(displayNextBatch, 5000);
                }
            }

            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
            // // Get the data from the server
            // $('#buyer_name').change(function() {
            //     var buyer_name = $(this).val();
            //     $.ajax({
            //         url: '{{ route('get_grey_dashboard') }}',
            //         type: 'GET',
            //         dataType: 'json',
            //         data: {
            //             buyer_name: buyer_name
            //         },
            //         success: function(response) {
            //             // console.log(response);
            //             data = response; // Store the response data
            //             currentIndex = 0; // Reset the index
            //             displayNextBatch(); // Start displaying data in batches
            //         },
            //         error: function(xhr, status, error) {
            //             console.log('Error:', error);
            //         }
            //     });
            // });


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
