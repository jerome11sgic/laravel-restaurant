<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Starter Template for Bootstrap</title>



    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style>
        body {
            padding-top: 5rem;
        }

        .starter-template {
            padding: 3rem 1.5rem;
            text-align: center;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">Taste Restaurant</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Waiters Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Add Dishes to Menu</a>
                </li>
            </ul>

        </div>
    </nav>

    <main role="main" class="container">

        <div class="row">
            <div class="col-md-8" id="section-item">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-main-dish" role="tab" aria-controls="nav-home" aria-selected="true">Main Dish</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-side-dish" role="tab" aria-controls="nav-profile" aria-selected="false">Side Dish</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-main-dish" role="tabpanel" aria-labelledby="nav-home-tab">
                        <table id="table-main-dish" class="table mt-5">
                            <thead class="thead-dark">
                                <th>Id</th>
                                <th>Food Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <!-- Append Items goes here -->
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="nav-side-dish" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <table id="table-side-dish" class="table mt-5">
                            <thead class="thead-dark">
                                <th>Id</th>
                                <th>Food Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <!-- Append Items goes here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4" id="section-menu">
                <table class="table" id="table-bill">
                    <thead>
                        <th>Food Name</th>
                        <th>Unit price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </thead>

                    <tbody>
                        <!-- bill contents goes here -->
                    </tbody>

                    <tfoot>
                        <!-- total goes here -->
                    </tfoot>

                </table>
            </div>
        </div>

    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
    <script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {

            $.ajax({
                url: "/maindish",
                type: 'GET',
                success: function(res) {

                    res.forEach(function(food) {
                        $("#table-main-dish tbody").append(
                            `<tr>
                       
                            <td>${food['id']}</td>
                            <td>${food['foodname']}</td>
                            <td>${food['price']}</td>
                            <td>
                            
                            <input type="Number" />
                            <button class='btn btn-xs btn-success btn-order' data-attr='${food['id']}' data-price='${food['price']}' data-name='${food['foodname']}'>Order</button>
                            </td>
                           
                        </tr>`);

                    });

                }
            });

            $.ajax({
                url: "/sidedish",
                type: 'GET',
                success: function(res) {

                    res.forEach(function(food) {
                        $("#table-side-dish tbody").append(
                            `<tr>
                       
                            <td>${food['id']}</td>
                            <td>${food['foodname']}</td>
                            <td>${food['price']}</td>
                            <td>
                            <input type="Number"/>
                            <button class='btn btn-small btn-success btn-order' data-attr='${food['id']}' data-price='${food['price']}' data-name='${food['foodname']}'>Order</button>
                            </td>
                           
                        </tr>`);

                    });

                }
            });


            let dishArray = [];
            $(document).on('click', ".btn-order", function() {
                let dishId = this.getAttribute("data-attr");
                let dishName = this.getAttribute("data-name");
                let price = this.getAttribute("data-price");
                let qty = $(this).siblings("input")[0].value;

                let obj = {
                    'dishName': dishName,
                    'price': price,
                    'qty': qty
                };

                dishArray[dishId] = obj;

                $("#table-bill tbody").html("");
                let total = 0;
                dishArray.forEach(function(dish) {
                    console.log(dish);
                    let subtotal = dish['qty'] * dish['price']
                    total = total + subtotal;
                    $("#table-bill tbody").append(
                        `<tr>
                       
                            <td>${dish['dishName']}</td>
                            <td>${dish['price']}</td>
                            <td>${dish['qty']} </td>
                            <td>${subtotal} </td>
                  
                           
                        </tr>`);
                });

                $("#table-bill tfoot").html(
                    `<tr>
                <td colspan=3 align=right>Total is</td>
                <td>${total}</td>
                </tr>`);



            })



        });
    </script>
</body>

</html>