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
    <script language="JavaScript1.2"> 
            function printFunc() {
		var prtContent = document.getElementById('report-content');
		var WinPrint = window.open(prtContent);
		WinPrint.document.write('<html><head>');
		WinPrint.document.write('<link rel="stylesheet" href="../assets/css/style.css" type="text/css" />');
		WinPrint.document.write('</head><body onload="print();close();">');
		WinPrint.document.write('<style type="text/css">' +
        'body { ' +
          'margin : 0 auto 0 auto' +
          '}' +
        'tr, th {' +
        'border: 1px solid #000;' +
        'padding: 0.2em;' +
		    'font-size: 24px'+
        '}' + 
        'td { ' +
        'border-bottom: 1px solid #000;' +
        'border-right: 1px solid #000;' +
        '}' +
		'table tfoot {' +
        'padding;0.2em;' +
		'font-size: 24px'+
        '}' + 
		'body {' + 
		'line-height:1.5em;' +
		'font-size: 22px'+
		'}' +
		'table thead, legend, h4 { ' +
		'font-weight: bold' +
		'}' +
		'h4 {' +
		'font-size: 38px'+
		'marging-bottom: 5px' +
		'}'+
        '</style>');
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.write('</body></html>');
		WinPrint.document.close();
		WinPrint.focus();
    }
    </script>
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
              <li>
                <a href="?create-order"><i class="fas fa-clipboard"></i> Create Order</a>
              </li>
              <li>
                  <a href="?saved-orders"><i class="fas fa-cloud"></i> Saved Orders</a>
              </li>
              <li>
                  <a href="?evaluate-policies"><i class="fas fa-cogs"></i> Evaluate Policies</a>
              </li>
              <li class="active">
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
            <div id="report-content">
              <h3 style="text-align: center;">Saved Reports</h3>
                <p style="text-align: center;">Reports from the evaluation of the ordering policies<P>

                <div class="line"></div>
              <div class="row py-5" id="report-content">
              <div class="col-lg-10 mx-auto">
                        <div class="table-responsive">
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
                          <table id="example" style="width:100%" class="table table-striped table-bordered">
                            <thead class="thead-dark">
                              <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Policy</th>
                                <th>Date</th>
                                <th>View/Delete Order </th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php if (!$evaluations){ echo '<tr><td>No Record Found</td></tr>'; } else{ foreach ($evaluations as $evaluation): ?>
                            <form method="POST">
                              <tr>
                                <td><?php echo $evaluation['evaluationsid']; ?></td>
                                <td><?php echo $evaluation['fullname']; ?></td>
                                <td><?php echo $evaluation['policy']; ?></td>
                                <td><?php echo $evaluation['date']; ?></td>
                                <td><ul class="action-list">
                                    <input type="hidden" name="evaluationid" value="<?php echo $evaluation['evaluationsid']; ?>" >
                                    <li><button type="submit" class="btn btn-primary" name="view-evaluation-report"><i class="fa fa-list"></i></button></li>
                                    <li><button type="submit" class="btn btn-danger" name="delete-evaluation"><i class="fa fa-times"></i></button></li>
                                </ul></td>
                              </tr>
                              </form>
                                <?php endforeach; } ?>
                            </tbody>
                          </table>
                    </div>
                  </div>
              
                <div class="col-lg-10 mx-auto">
                      <div class="table-responsive">
                        <table id="example" style="width:100%" class="table table-striped table-bordered">
                          
                        <div>
                              <br> <p>Minimum/Maximum method</p>
                          </div>
                          <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Cost Price (??)</th>
                                <th>Order Quantity</th>
                                <th>Total Retail Price (??)</th>
                                <th>Total Cost Price (??)</th>
                                <th>Cost of Keeping Stock (??)</th>
                                <th>Ordering Cost (??)</th>
                                <th>Estimated Profit (??)</th>
                                <th>Average No. of Sales</th>
                                <th>Standard Deviation of Sales</th>
                                <th>Percentage Deviation of Sales (%)</th>
                                <th>Chance of being Out-of-Stock/Overstock</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php if (!$minmaxreport){ echo '<tr><td>No Record Found</td></tr>'; } else{ foreach ($minmaxreport as $order): ?>
                              <tr>
                                <td><?php echo $order['productid'] ?></td>
                                <td><?php echo $order['product_name'] ?></td>
                                <td>??<?php echo $order['cost_price'] ?></td>
                                <td><?php echo $order['order_qty'] ?></td>
                                <td>??<?php echo $order['total_retail'] ?></td>
                                <td>??<?php echo $order['total_cost'] ?></td>
                                <td>??<?php echo $order['keeping_cost'] ?></td>
                                <td>??<?php echo $order['ordering_cost'] ?></td>
                                <td>??<?php echo $order['estimated_profit'] ?></td>
                                <td><?php echo $order['average_sales'] ?></td>
                                <td><?php echo $order['std_dev_sales'] ?></td>
                                <td><?php echo $order['percent_dev'] ?>%</td>
                                <td><?php if($order['chance'] < 0) {
                                  echo abs($order['chance'])."% chance of being out-of-stock";
                                 }else{ echo $order['chance']."% chance of being overstock"; } ?></td>
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
                                  <th>Sum of Total Retail Price (??)</th>
                                  <th>Sum of Total Cost Price (??)</th>
                                  <th>Sum of Cost of Keeping Stock (??)</th>
                                  <th>Sum of Ordering Cost (??)</th>
                                  <th>Sum of Estimated Profit (??)</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>1</td>
                                  <td><?php if(isset($date_minmax)) { echo $date_minmax; } ?></td>
                                  <td>??<?php if(isset($retail_sum_minmax)) { echo $retail_sum_minmax; }?></td>
                                  <td>??<?php if(isset($cost_sum_minmax)){ echo $cost_sum_minmax; } ?></td>
                                  <td>??<?php if(isset($keeping_sum_minmax)) {echo $keeping_sum_minmax; }?></td>
                                  <td>??<?php if(isset($ordering_sum_minmax)){ echo $ordering_sum_minmax; } ?></td>
                                  <td>??<?php if(isset($profit_sum_minmax)) { echo $profit_sum_minmax; }?></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                    </div>
                  </div>


              <div class="line"></div>

              <div class="row py-5">
                  <div class="col-lg-10 mx-auto">
                        <div class="table-responsive">
                          <table id="example" style="width:100%" class="table table-striped table-bordered">
                           
                            
                            <div>
                                <br> <p>Replenishment Cycle Method</p>
                            </div>
                            <thead class="thead-dark">
                              <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Cost Price (??)</th>
                                <th>Order Quantity</th>
                                <th>Total Retail Price (??)</th>
                                <th>Total Cost Price (??)</th>
                                <th>Cost of Keeping Stock (??)</th>
                                <th>Ordering Cost (??)</th>
                                <th>Estimated Profit (??)</th>
                                <th>Average No. of Sales</th>
                                <th>Standard Deviation of Sales</th>
                                <th>Percentage Deviation of Sales (%)</th>
                                <th>Chance of being Out-of-Stock/Overstock</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php if (!$replenishreport){ echo '<tr><td>No Record Found</td></tr>'; } else{ foreach ($replenishreport as $order): ?>
                              <tr>
                                <td><?php echo $order['productid'] ?></td>
                                <td><?php echo $order['product_name'] ?></td>
                                <td>??<?php echo $order['cost_price'] ?></td>
                                <td><?php echo $order['order_qty'] ?></td>
                                <td>??<?php echo $order['total_retail'] ?></td>
                                <td>??<?php echo $order['total_cost'] ?></td>
                                <td>??<?php echo $order['keeping_cost'] ?></td>
                                <td>??<?php echo $order['ordering_cost'] ?></td>
                                <td>??<?php echo $order['estimated_profit'] ?></td>
                                <td><?php echo $order['average_sales'] ?></td>
                                <td><?php echo $order['std_dev_sales'] ?></td>
                                <td><?php echo $order['percent_dev'] ?>%</td>
                                <td><?php if($order['chance'] < 0) {
                                  echo abs($order['chance'])."% chance of being out-of-stock";
                                 }else{ echo $order['chance']."% chance of being overstock"; } ?></td>
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
                                  <th>Sum of Total Retail Price (??)</th>
                                  <th>Sum of Total Cost Price (??)</th>
                                  <th>Sum of Cost of Keeping Stock (??)</th>
                                  <th>Sum of Ordering Cost (??)</th>
                                  <th>Sum of Estimated Profit (??)</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                <td>1</td>
                                  <td><?php if(isset($date_replenish)){ echo $date_replenish; } ?></td>
                                  <td>??<?php if(isset($retail_sum_replenish)) {echo $retail_sum_replenish; } ?></td>
                                  <td>??<?php if(isset($cost_sum_replenish)) {echo $cost_sum_replenish; }?></td>
                                  <td>??<?php if(isset($keeping_sum_replenish)) { echo $keeping_sum_replenish; } ?></td>
                                  <td>??<?php if(isset($ordering_sum_replenish)) { echo $ordering_sum_replenish; } ?></td>
                                  <td>??<?php if(isset($profit_sum_replenish)) { echo $profit_sum_replenish; } ?></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                    </div>
                  </div>
            <div class="line"></div>
            <div class="row">
                <div class="col-sm-8 col-xs-12">
                    <button class="btn btn-sm btn-dark pull-left" style="margin-left: 150px; padding: 10px;" onclick='printFunc();'><i class="fas fa-check-circle"></i> Print Report</button>
                </div>
            </div>

            <div class="line"></div>
          </div>                       
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
    <style>
        /* ---------------------------------------------------
    table style
----------------------------------------------------- */


.table tbody .action-list{
    padding: 0;
    margin: 0;
    list-style: none;
}
.table tbody .action-list li{ display: inline-block; }
.panel .panel-body .table tbody .action-list li a{
    color: #fff;
    font-size: 13px;
    line-height: 20px;
    height: 20px;
    width: 33px;
    padding: 0;
    border-radius: 0;
    transition: all 0.3s ease 0s;
}
.table tbody .action-list li a:hover{ box-shadow: 0 0 5px #ddd; }
  </style>
</body>

</html>