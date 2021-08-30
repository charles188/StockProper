<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>StockProper: Inventory Control System</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style2.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <a class="logo" href=".">
                    <img src="../assets/images/stockproper2.png" alt="stockproper" height="50">
                  </a>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="."><i class="fas fa-user-circle"></i> Profile</a>
                </li>
                <li>
                  <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-clipboard-list"></i> Product Sales Info</a>
                  <ul class="collapse list-unstyled" id="homeSubmenu">
                      <li>
                          <a href="?additem">Add New</a>
                      </li>
                      <li>
                          <a href="?allitems">Product Sales</a>
                      </li>
                  </ul>
              </li>
              <li class="active">
                <a href="?create-order"><i class="fas fa-clipboard"></i> Create Order</a>
            </li>
              <li>
                  <a href="?saved-orders"><i class="fas fa-cloud"></i> Saved Orders</a>
              </li>
              <li>
                  <a href="?evaluate-policies"><i class="fas fa-cogs"></i> Evaluate Policies</a>
              </li>
              <li>
                  <a href="?saved-reports"><i class="fas fa-clipboard-list"></i> Saved Reports</a>
              </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="../contact.html" class="download">Help Center</a>
                </li>
                <li>
                    <a href="?logout" class="article">Log Out</a>
                </li>
            </ul>
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../about.html" style="font-size: medium;">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../privacy.html" style="font-size: medium;">Privacy Policy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../terms.html" style="font-size: medium;">Terms & Conditions</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="../contact.html">Help Center</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <h3>Create Order</h3>
            <p>Choose an ordering policy to create an order</p>

            <div class="line"></div>
            

            <div class="row py-5">
              <div class="col-lg-10 mx-auto">
              <form method="POST">
                    <?php if(isset($_SESSION['message'])) {  ?>
                        <div class="alert alert-warning">
                            <h5><?php echo $_SESSION['message'] ?></h5>
                        </div>
                    <?php } ?>
                    <?php if(isset($_SESSION['success'])) {  ?>
                        <div class="alert alert-success">
                            <h5><?php echo $_SESSION['success'] ?></h5>
                        </div>
                    <?php } ?>
                  <div class="row g-3">
                      <div class="col-md-4">
                        <select class="form-select form-select-lg mb-3" name="order-policy" aria-label=".form-select-lg example" style="height: 40px; width: 300px;">
                          <option value="nil" selected>Choose an ordering policy</option>
                          <option value="minmax-method">Minimum/Maximum method</option>
                          <option value="replenish-method">Replenishment Cycle Method</option>
                        </select>
                        </div>
                        
                        <div class="col-md-3">
                          <button type="submit" name="create-order" class="btn btn-sm btn-dark pull-left" style="padding: 8px;"><i class="fas fa-caret-square-right"></i>  Create Order</button>
                        </div>
                    </div>
                    </form>
              </div>
            </div>
                                     
            <div class="line"></div>

            <div class="row py-5">
                <div class="col-lg-10 mx-auto">
                      <div class="table-responsive">
                        <table id="example" style="width:100%" class="table table-striped table-bordered">
                          
                          <div>
                              <h5><?php echo $method ?></h5>
                              <br> <p>Products to order for one month stock</p>
                          </div>
                          <thead class="thead-dark">
                            <tr>
                              <th>ID</th>
                              <th>Product</th>
                              <th>Category</th>
                              <th>Supplier</th>
                              <th>Retail Price (£)</th>
                              <th>Cost Price (£)</th>
                              <th>Order Quantity</th>
                              <th>Total Retail Price (£)</th>
                              <th>Total Cost Price (£)</th>
                              <th>Cost of Keeping Stock (£)</th>
                              <th>Ordering Cost (£)</th>
                              <th>Life Span</th>
                              <th>Expected Delivery Date</th>
                              <th>Estimated Profit (£)</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php if (!$orders){ echo '<tr><td>No Record Found</td></tr>'; } else{ foreach ($orders as $order): ?>
                            <tr>
                              <td><?php echo $order['productid']; ?></td>
                              <td><?php echo $order['product_name']; ?></td>
                              <td><?php echo $order['category']; ?></td>
                              <td><?php echo $order['supplier']; ?></td>
                              <td>£<?php echo $order['retail_price']; ?></td>
                              <td><?php echo $order['cost_price']; ?></td>
                              <td><?php echo $order['order_qty']; ?></td>
                              <td>£<?php echo $order['total_retail']; ?></td>
                              <td>£<?php echo $order['total_cost']; ?></td>
                              <td>£<?php  echo round($order['keeping_cost'], 2);?></td>
                              <td>£<?php echo $order['ordering_cost']; ?></td>
                              <td><?php  echo $order['lifespan'];?> Days</td>
                              <td><?php  echo $order['dev_date'];?></td>
                              <td>£<?php echo $order['estimated_profit'];  ?></td>
                            </tr>
                            <?php endforeach; } ?>
                          </tbody>
                        </table>
                      </div>
                </div>
              </div> 


              <div class="row py-5">
                    <div class="col-lg-10 mx-auto">
                          <div class="table-responsive">
                            <table id="example" style="width:100%" class="table table-striped table-bordered">
                             
                              
                              <div>
                                  <br> <p>Summary</p>
                              </div>
                              <thead class="thead-dark">
                                <tr>
                                  <th>ID</th>
                                  <th style="width:120px">Date</th>
                                  <th>Sum of Total Retail Price (£)</th>
                                  <th>Sum of Total Cost Price (£)</th>
                                  <th>Sum of Cost of Keeping Stock (£)</th>
                                  <th>Sum of Ordering Cost (£)</th>
                                  <th>Sum of Estimated Profit (£)</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>1</td>
                                  <td><?php if(isset($date)) { echo $date; }?></td>
                                  <td>£<?php if(isset($retail_sum)) { echo $retail_sum; } ?></td>
                                  <td>£<?php if(isset($cost_sum)){ echo $cost_sum; } ?></td>
                                  <td>£<?php if(isset($keeping_sum)) { echo $keeping_sum; } ?></td>
                                  <td>£<?php if(isset($ordering_sum)) { echo $ordering_sum; } ?></td>
                                  <td>£<?php if(isset($profit_sum)) { echo $profit_sum; } ?></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                    </div>
                  </div>


              <div class="col-md-8">
                <form method="POST">
                    <input type="hidden" name="order-policy" value=<?php echo $method?> />
                    <button type="submit" name="save-order" class="btn btn-sm btn-dark pull-left" style="margin-left: 150px; padding: 10px;"><i class="fas fa-check-circle"></i> Save Order</a>
                 </form>
            </div>

            <div class="line"></div>

        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>