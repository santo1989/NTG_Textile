<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CPB Production Dashboard</title>
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

<body style="background: #455560">

    <div class="container-fluid text-center text-light">
        <!-- First Row -->
        <div class="row mb-3">
            <div class="row ">
                <div class="col-md-4 d-flex flex-column justify-content-left align-items-left">
                    <p> <img src="{{ asset('images/assets/logo.png') }}" alt="" heigt=350px; width=150px;
                            class="logo" style="margin: 1%; "></p>
                </div>
                <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
                    <h2>CPB Production Dashboard</h2>
                </div>
                <div
                    class="col-md-4 today-date text-light d-flex flex-column justify-content-center align-items-center">
                    <strong>
                        Today's Date: <span id="currentDate"></span> <br>
                        Current Time: <span id="currentTime"></span>
                    </strong>



                </div>

            </div>
            {{-- <div class="row text-center text-light">
                <div class="col-md-12">
                    <h2>CPB Production Dashboard</h2>
                </div>
            </div> --}}
        </div>


        <!-- Second Row -->
        <div class="row mb-3" id="card-container">

        </div>


        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3 text-light" style="background: #0e6252; border: 1px solid #ffffff;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center"
                        style="height: 20vh">
                        <h2 class="card-text" style="font-size:2vw;"> Total Target (KG)</h2>
                        <h3 class="card-title" id="total_target_kg" style="font-size:5vw;">{{ $total_target_kg }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3 text-light" style="background: #0e6252; border: 1px solid #ffffff;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center"
                        style="height: 20vh">
                        <h2 class="card-title"style="font-size:2vw;"> Total Actual Production (KG)</h2>
                        <h3 class="card-title" id="total_actual_production_kg" style="font-size:5vw;">
                            {{ $total_actual_production_kg }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3 text-light" style="background: #0e6252; border: 1px solid #ffffff;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center"
                        style="height: 20vh">
                        <h2 class="card-title"style="font-size:2vw;">Total Achievement </h2>
                        <h3 class="card-text" id="total_achievement" style="font-size:5vw;">{{ $total_achievement }} %
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cards will be dynamically added here -->
    </div>

    <!-- Add jQuery and AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to update the card view
        // Keep track of the current index to show
        var currentIndex = 0;

        function updateCardView() {
            $.ajax({
                url: '{{ route('get_cpbs') }}',
                type: 'GET',
                dataType: 'json',

                $data = [
                    'today' => '{{ now()->sub(Carbon\CarbonInterval::seconds(24 * 60 * 60))->format('Y-m-d') }}'
                ];

                success: function(response) {
                    // Get the current CPB data to show
                    var cpb = response[currentIndex];
                    console.log(cpb);
                    // Clear previous cards
                    $('#card-container').empty();

                    // Add the current card

                    var cardHtml = `<!-- First Column -->
            <div class="col-md-4">
                <div class="card mb-3 text-light" style=" border: 1px solid #ffffff; background: rgba(0, 0, 0, 0.4); color: #f1f1f1;" >
                    <div class="card-body d-flex flex-column justify-content-center align-items-center" style="height: 50vh">
                        <h2 class="card-title" style="font-size:2vw;">MC No</h2>
                        <h2 class="card-text" style="font-size:5vw;">` + cpb.mc_no + `</h2>
                        
                    </div>
                </div>
            </div>

            <!-- Second Column -->
            <div class="col-md-4" >
                <!-- First Row of Second Column -->
                <div class="row mb-3" >
                    <div class="col-6">
                        <div class="card text-light" style="background: #384268; border: 1px solid #ffffff;">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center" style="height: 20vh;">
                                <h2 class="card-title" style="font-size:2vw;">Target(KG)</h2>
                                <h2 class=" card-text " style="font-size:5vw;">` + cpb.target_kg.toString().replace(
                            /\B(?=(\d{3})+(?!\d))/g, ',') + `</h2>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card text-light" style="` + cpb.style + `">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center" style="height: 20vh">
                                <h2 class="card-title" style="font-size:2vw;">Actual(KG)</h2>
                                <h2 class="card-text" style="font-size:5vw;">` + cpb.actual_production_kg.toString()
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ',') + `</h2>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Second Row of Second Column -->
                <div class="row">
                    <div class="col-12">
                        <div class="card text-light" style="background:#774F32; border: 1px solid #ffffff;" >
                            <div class="card-body d-flex flex-column justify-content-center align-items-center" style="height: 28vh">
                                <h2 class="card-title" style="font-size:2vw;">Variance (KG)</h2>
                                <h3 class="card-text" style="font-size:5vw;` + cpb.arrow_icon + `">` + cpb.variance
                        .toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') + ` </h3> 
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Third Column -->
            <div class="col-md-4">
                <div class="card mb-3 text-light" style="border: 1px solid #ffffff; background: rgba(0, 0, 0, 0.4); color: #f1f1f1; border: 1px solid #ffffff;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center" style="height: 50vh">
                        <h2 class="card-title" style="font-size:2vw;">Acheivement</h2>
                        <h3 class=" card-text "style="font-size:5vw;">` + cpb.acheivement + ` %</h3>
                        
                    </div>
                </div>
            </div>`;
                    $('#card-container').append(cardHtml);

                    // Increment the current index to show the next CPB data on the next AJAX call
                    currentIndex++;
                    if (currentIndex >= response.length) {
                        currentIndex = 0;
                    }
                },
                complete: function() {
                    // Refresh the card view every second
                    setTimeout(updateCardView, 3000);
                }
            });
        }

        // Call the function to update the card view
        updateCardView();



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

        function updateTotalCardView() {
            $.ajax({
                url: '{{ route('getCPBs_total') }}',
                type: 'GET',
                dataType: 'json',
                $data = [
                    'today' => '{{ now()->sub(Carbon\CarbonInterval::seconds(24 * 60 * 60))->format('Y-m-d') }}'
                ];
                success: function(response) {
                    // Update the values of total_achievement, total_actual_production_kg, and total_achievement
                    // $('#total_achievement').text(response.total_achievement);
                    document.getElementById('total_target_kg').textContent = response.total_target_kg.toString()
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                    // $('#total_actual_production_kg').text(response.total_actual_production_kg);
                    document.getElementById('total_actual_production_kg').textContent = response
                        .total_actual_production_kg.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                    // $('#total_achievement').text('' + response.total_achievement + '%');
                    document.getElementById('total_achievement').textContent = response.total_achievement + '%';

                },
                complete: function() {
                    // Refresh the card view every second
                    setTimeout(updateTotalCardView, 1000);
                }
            });
        }

        // Call the function to start updating the card view
        updateTotalCardView();
    </script>
</body>

</html>
