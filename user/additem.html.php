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

            <h4><?php echo $header ?></h4>
        
            <div class="line"></div>

            <div class="row py-5">
                <div class="col-lg-10 mx-auto">
                <?php if(isset($_SESSION['message'])) {  ?>
                        <div class="alert alert-warning">
                            <h5><?php echo $_SESSION['message'] ?></h5>
                        </div>
                    <?php } ?>
                    <form class="row g-3" method="post" >
                        <div class="col-md-4">
                            <label class="form-label">Product Name</label>
                            <input type="text" name="product" class="form-control" value="<?php echo $product ?>" placeholder="Product Name" id="inputEmail4" required />
                          </div>
                          
                          <div class="col-md-4">
                            <label class="form-label">Product Category</label>
                            <select class="form-select form-select-lg mb-3" name="category" aria-label=".form-select-lg example" style="height: 36px; width: 300px;" required>
                                <option ></option>
                                <option value="groceries" >Groceries</option>
                                <option value="clothing">Clothing</option>
                                <option value="electronics">Electronics</option>
                                <option value="furnitures">Furnitures</option>
                            </select>
                          </div>
                          <div class="col-md-4" >
                            <label class="form-label">SKU</label>
                            <input type="text" name="sku" class="form-control" value="<?php echo $sku ?>" placeholder="SKU" id="inputEmail4" required>
                          </div>
                          <div class="col-md-4" style="margin-top: 20px;">
                            <label class="form-label">Supplier</label>
                            <input type="text" name="supplier" class="form-control" value="<?php echo $supplier ?>" placeholder="Supplier" id="inputEmail4" required>
                          </div>
                          <div class="col-md-4" style="margin-top: 20px;">
                            <label class="form-label">Actual Price (£)</label>
                            <input type="text" name="actualprice" class="form-control" value="<?php echo $actualprice?>"placeholder="Actual Price" id="inputEmail4" required>
                        </div>
                        <div class="col-md-4" style="margin-top: 20px;">
                            <label class="form-label">Retail Price (£)</label>
                            <input type="text" name="retailprice" class="form-control" value="<?php echo $retailprice?>" placeholder="Retail Price" id="inputEmail4" required>
                        </div>
                        
                          <div class="col-md-4" style="margin-top: 25px;">
                            <label class="form-label">Quantity Sold</label>
                            <input type="text" name="qtysold" class="form-control" value="<?php echo $qtysold?>" placeholder="Quantity Sold" id="inputEmail4" required>
                          </div>
                            <div class="col-md-2" style="margin-top: 25px;">
                                <label class="form-label">Inventory Position</label>
                                <input type="text" name="inventoryposition" class="form-control" value="<?php echo $inventoryposition?>" placeholder="Stock on Hand" id="inputEmail4" required>
                              </div>
                              <div class="col-md-3" style="margin-top: 25px;">
                                <label class="form-label">Minimum Stock Quantity</label>
                                <input type="text" name="minstockqty" class="form-control" value="<?php echo $minstockqty?>" placeholder="Minimum Stock Quantity" id="inputEmail4" required>
                              </div>
                              <div class="col-md-3" style="margin-top: 25px;">
                                <label class="form-label">Maximum Stock Quantity</label>
                                <input type="text" name="maxstockqty" class="form-control" value="<?php echo $maxstockqty?>" placeholder="Maximum Stock Quantity" id="inputEmail4" required>
                            </div>
                            <div class="col-md-4" style="margin-top: 25px;">
                            <label class="form-label">Ordering Cost</label>
                            <input type="text" name="ordcost" class="form-control" value="<?php echo $ordcost?>"  placeholder="Ordering Cost" id="inputEmail4" required>
                            <small id="emailHelp" class="form-text text-muted">The cost of ordering this product which includes shipping.</small>
                          </div>
                          <div class="col-md-4" style="margin-top: 25px;">
                            <label class="form-label">Delivery Time</label>
                            <input type="text" name="deltime" class="form-control" value="<?php echo $deltime?>"  placeholder="Delivery Time" id="inputEmail4" required>
                            <small id="emailHelp" class="form-text text-muted">The number of days it will take from when the order is placed to when it is delivered.</small>
                        </div>
                        <div class="col-md-4" style="margin-top: 25px;">
                            <label class="form-label">Life Span (Use By)</label>
                            <input type="text" name="lifespan" class="form-control" value="<?php echo $lifespan?>"  placeholder="Life Span" id="inputEmail4" required>
                            <small id="emailHelp" class="form-text text-muted">The number of days the product will be useful. This can also be a season or a trend.</small>
                        </div>
                          
                            <div class="col-sm-12 col-xs-12" style="margin-top: 25px;">
                                <input type="hidden" name="productid" value="<?php echo $productid ?>" />
                                <input type="hidden" name="action" value="<?php echo $action ?>"/>
                                <button type="submit" class="btn btn-sm btn-dark pull-left" ><i class="fa fa-plus-circle"></i> <?php  echo $button ?></button>
                            </div>
                      </form>
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
</body>

</html>