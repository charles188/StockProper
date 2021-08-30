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
                <li class="active">
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

            <h2 style="text-align: center;">Product Sales Information</h2>
            <div class="line"></div>
                <div class="row py-5">
                    <?php if(isset($_SESSION['message'])) {  ?>
                        <div class="alert alert-warning">
                            <h5><?php echo $_SESSION['message'] ?></h5>
                        </div>
                    <?php } ?>
                  <div class="col-lg-10 mx-auto">
                        <div class="table-responsive">
                          <table id="example" style="width:100%" class="table table-striped table-bordered">
                           
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <a href="?additem" class="btn btn-sm btn-dark pull-left"><i class="fa fa-plus-circle"></i> Add Product Sales Info</a>
                                </div>
                            </div>

                            
                            <div>
                                <br> <p>Showing all product sales for a month</p>
                            </div>
                            <thead class="thead-dark">
                              <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>SKU</th>
                                <th>Supplier</th>
                                <th>Cost Price (£)</th>
                                <th>Retail Price (£)</th>
                                <th>Quantity Sold</th>
                                <th>Inventory Position</th>
                                <th>Min. Stock Qty.</th>
                                <th>Max. Stock Qty.</th>
                                <th>Total Retail Price (£)</th>
                                <th>Total Cost Price (£)</th>
                                <th>Cost of Keeping Stock (£)</th>
                                <th>Ordering Cost (£)</th>
                                <th>Life Span</th>
                                <th>Delivery Time</th>
                                <th>Edit/Delete Product </th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php if (!$products){ echo '<tr><td>No Record Found</td></tr>'; } else{ foreach ($products as $product): ?>
                            <form method="POST">
                              <tr>
                                <td><?php echo $product['productid']; ?></td>
                                <td><?php echo $product['product_name']; ?></td>
                                <td><?php echo $product['category']; ?></td>
                                <td><?php echo $product['sku']; ?></td>
                                <td><?php echo $product['supplier']; ?></td>
                                <td>£<?php echo $product['cost_price']; ?></td>
                                <td>£<?php echo $product['retail_price']; ?></td>
                                <td><?php echo $product['quantity_sold']; ?></td>
                                <td><?php echo $product['inventory_position']; ?></td>
                                <td><?php echo $product['min_stock_qty']; ?></td>
                                <td><?php echo $product['max_stock_qty']; ?></td>
                                <td>£<?php echo $product['total_retail']?></td>
                                <td>£<?php echo $product['total_cost']; ?></td>
                                <td>£<?php echo round($product['keeping_cost'], 2); ?></td>
                                <td>£<?php echo $product['ordering_cost']; ?></td>
                                <td><?php echo $product['lifespan'];  ?> Days</td>
                                <td><?php  echo $product['delivery_time']; ?> Days</td>
                                <td><ul class="action-list">
                                    <input type="hidden" name="productid" value="<?php echo $product['productid']; ?>" >
                                    <li><button type="submit" class="btn btn-primary" name="edit-product"><i class="fa fa-pencil-alt"></i></button></li>
                                    <li><button type="submit" class="btn btn-danger" name="delete-product"><i class="fa fa-times"></i></button></li>
                                </ul></td>
                              </tr>
                              </form>
                                <?php endforeach; } ?>
                            </tbody>
                          </table>
                        </div>
                  </div>
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

    <script>
        $(function() {
            $(document).ready(function() {
                $('#example').DataTable();
             });
        });
    </script>

    <style>
        /* ---------------------------------------------------
    inventory table
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