<?php

error_reporting( E_ALL );
ini_set( "display_errors", 1 );
session_start();

// user login check
if (!isset($_SESSION['email'])) {
    header("Location: ../"); 
}

// logout
if(isset($_GET['logout'])){
    session_unset();
    header('Location: ../');
    exit();
}
// submit update user data
if(isset($_POST['action']) && $_POST['action'] == "Submit"){
    include("../assets/dbConnect.php");

    $fullname 		= $_POST['fullname'];
    $bus_name 		= $_POST['bus_name'];
    $email 			= $_POST['email'];
    $bus_type    	= $_POST['bus_type'];
    $bus_address 	= $_POST['bus_address'];
    $phone  		= $_POST['phone'];
    $postcode 		= $_POST['postcode'];
    $username 		= $_POST['username'];

    $sql = "UPDATE users SET fullname=?, username=?, email_address=?, business_name=?, 
    business_type=?, business_address=?, phone=?, postcode=? WHERE userid = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('ssssssssi', $fullname, $username, $email, $bus_name, $bus_type, $bus_address, $phone, $postcode, $_POST['userid'] );
    if ($stmt->execute()) {
        $_SESSION['message'] = "Profile updated successful";
        $back = '?profile';
        include 'message.html.php';
        exit;
    } else {
        $_SESSION['message'] = "Error: " .$db->error;
    }
}

// order product;
if(isset($_POST['create-order'])){
    $order_policy = $_POST['order-policy'];
    if ($order_policy == "nil") {
        unset($_SESSION['success']);
        $_SESSION['message'] = "Please choose a policy";
        include 'createorder.html.php';
    }else{
        unset($_SESSION['message']);
    try{
        include '../assets/dbConnect.php';
        $query = "SELECT productid, product_name, category, sku, supplier,
        cost_price, retail_price, quantity_sold, inventory_position, min_stock_qty,
        max_stock_qty, total_cost, total_retail, ordering_cost, (total_cost * category_value)/100 as keeping_cost, 
        lifespan, DATE_ADD(date(created_at), INTERVAL delivery_time DAY) as dev_date,
        date(created_at) as date FROM productsales WHERE userid='".$_SESSION['userid']."'";
        $result = $db->query($query);
        if($result){
            //$result = $stmt->get_result();
            $products = $result->fetch_all(MYSQLI_ASSOC);
            $orders = Array();
            if($order_policy == "minmax-method"){
                //check min-max condition and save the product in orders array.
                foreach ($products as $product){
                    $minstockqty        = $product['min_stock_qty'];
                    $maxstockqty        = $product['max_stock_qty'];
                    $inventoryposition  = $product['inventory_position'];
                    if($inventoryposition <= $minstockqty){
                        $orderqty = $maxstockqty - $inventoryposition;
                        $product['order_qty'] = $orderqty;
                        $product['estimated_profit'] = 
                        ($product['total_retail'] - ($product['total_cost'] + $product['keeping_cost'] + $product['ordering_cost']) );
                        array_push($product, $product['order_qty']);
                        array_push($product, $product['estimated_profit']);
                        array_push($orders, $product);
                    }
                }
                //summary of orders
                $retail_sum = 0;
                $cost_sum = 0;
                $keeping_sum = 0;
                $ordering_sum = 0;
                $profit_sum = 0;
                foreach($orders as $order){
                    $retail_sum += $order['total_retail'];
                    $cost_sum += $order['total_cost'];
                    $keeping_sum += $order['keeping_cost'];
                    $ordering_sum += $order['ordering_cost'];
                    $profit_sum += $order['estimated_profit'];
                    $date = date('Y-m-d');
                }
                $_SESSION['orders'] = $orders;
                $_SESSION['success'] = 'Order created, scroll down to view';
                $method = 'Minimum/Maximum Method';
                include 'createorder.html.php';
                exit;
            }elseif($order_policy == "replenish-method"){
                foreach ($products as $product){
                    $maxstockqty        = $product['max_stock_qty'];
                    $inventoryposition  = $product['inventory_position'];
                    $date               = strtotime($product['date']);
                    $currentdate        = strtotime(date('Y-m-d'));
                    $number_of_days = ($currentdate - $date)/60/60/24;
                    if($number_of_days <= 30){
                        $orderqty = $maxstockqty - $inventoryposition;
                        $product['order_qty'] = $orderqty;
                        $product['estimated_profit'] = 
                        ($product['total_retail'] - ($product['total_cost'] + $product['keeping_cost'] + $product['ordering_cost']) );
                        array_push($product, $product['order_qty']);
                        array_push($product, $product['estimated_profit']);
                        array_push($orders, $product);
                    }
                }
                //summary of orders
                $retail_sum = 0;
                $cost_sum = 0;
                $keeping_sum = 0;
                $ordering_sum = 0;
                $profit_sum = 0;
                foreach($orders as $order){
                    $retail_sum += $order['total_retail'];
                    $cost_sum += $order['total_cost'];
                    $keeping_sum += $order['keeping_cost'];
                    $ordering_sum += $order['ordering_cost'];
                    $profit_sum += $order['estimated_profit'];
                    $date = date('Y-m-d');
                }
                $_SESSION['orders'] = $orders;
                $_SESSION['success'] = 'Order created, scroll down to view';
                $method = 'Replenishment Cycle Method';
                include 'createorder.html.php';
                exit;
            }
        }else{
            $_SESSION['message'] = 'Error occured '. $db->error;
        }
    }catch(Exception $ex){
        $_SESSION['message'] = 'Error occured '. $ex;
    } 
    $back = "?create-order";
    include 'message.html.php'; 
    } 
}

//Save Order
if(isset($_POST['save-order'])){

    if(!isset($_SESSION['orders'])){
        header('Location: ?create-order');
    }
    include '../assets/dbConnect.php';
    $order_policy =  $_POST['order-policy'];
    $userid = $_SESSION['userid'];
    //save order
    $osql = "INSERT INTO stockproper.order (userid, order_policy) VALUES ('$userid', '$order_policy')";

    if (mysqli_query($db, $osql)) {
        $_SESSION['message'] = "order saved";  
    } else {
        $_SESSION['message'] = "Error: " . $osql . "<br>" . mysqli_error($db);
    }
    $orderid = $db->insert_id;
    try{   
        foreach ( $_SESSION['orders'] as $order){
            // save order_items
            $sql = "INSERT INTO order_items SET orderid=?, product_name=?, category=?,
            supplier=?, retail_price=?, cost_price=?, order_qty=?, total_retail=?, total_cost=?, keeping_cost=?, 
            ordering_cost=?, estimated_profit=?, lifespan=?, delivery_date=?";
            $stmt = $db->prepare($sql);
            if($stmt){
                $stmt->bind_param('isssiiiiiiiiis', $orderid, $order['product_name'], $order['category'], $order['supplier'], $order['retail_price'], $order['cost_price'], $order['order_qty'], $order['total_retail'], $order['total_cost'], $order['keeping_cost'], $order['ordering_cost'], $order['estimated_profit'], $order['lifespan'], $order['dev_date']);
                if ($stmt->execute()) {
                    $_SESSION['message'] = "Order successfully saved";
                    unset($_SESSION['orders']);
                } else {
                    $_SESSION['message'] = "Error: " .$db->error;
                }
            }
        }
    }catch (Exception $e){
        $_SESSION['message'] = $e;
    }finally {
        $db -> close();  
    }
    $back = "?create-order";
    include 'message.html.php';
    exit;
}

//load edit product form
if(isset($_POST['edit-product'])){
    include '../assets/dbConnect.php';
    $query = "SELECT productid, product_name, category, sku, supplier,
    cost_price, retail_price, quantity_sold, inventory_position, min_stock_qty,
    max_stock_qty, ordering_cost, delivery_time, lifespan, total_cost FROM productsales WHERE productid=?";
    $stmt = $db->prepare($query);
    if($stmt){
        $stmt->bind_param('i', $_POST['productid']);
        $stmt->execute();
        $stmt->bind_result($productid, $product, $category, $sku, $supplier, $actualprice, $retailprice, $qtysold, $inventoryposition, $minstockqty, $maxstockqty, $ordcost, $deltime, $lifespan, $totalcost );
        $stmt->fetch();
        $button = "Submit";
        $header = "Edit product sales information";
        $action = "edit product";
    }else{
        $_SESSION['message'] = "Something went wrong, try again";
    }
    include 'additem.html.php';
    exit;
}

//Delete Product
if(isset($_POST['delete-product'])){
    include '../assets/dbConnect.php';
    $sql = "DELETE FROM productsales WHERE productid=?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('i', $_POST['productid']);
    if($stmt->execute()){
        $_SESSION['message'] = "Product Succesfully Deleted";
        $back = "?allitems";
        include 'message.html.php';
        exit;
    }else{
        $_SESSION['message'] = "Error Occured ". $db->error;
    }
    $stmt->close();
}
//edit product
if (isset($_POST['action']) && $_POST['action'] == 'edit product'){
    include("../assets/dbConnect.php");

    $product	        = $_POST['product'];
    $category	        = $_POST['category'];
    $sku		        = $_POST['sku'];
    $supplier	        = $_POST['supplier'];
    $actualprice		= $_POST['actualprice'];
    $retailprice		= $_POST['retailprice'];
    $qtysold		    = $_POST['qtysold'];
    $inventoryposition	= $_POST['inventoryposition'];
    $minstockqty		= $_POST['minstockqty'];
    $maxstockqty		= $_POST['maxstockqty'];
    $ordcost            = $_POST['ordcost'];
    $deltime            = $_POST['deltime'];
    $lifespan           = $_POST['lifespan'];
    $userid             = $_SESSION['userid'];
    $totalcost          = $qtysold * $actualprice;
    $totalretail        = $qtysold * $retailprice;
    $userid             = $_SESSION['userid'];
    $cat_value          = 0;
    switch($category){
        case 'groceries': $cat_value = 30;
        break;
        case 'clothing': $cat_value = 25;
        break;
        default: $cat_value = 20;
    }
    
    $sql = "UPDATE productsales SET product_name=?, category=?, sku=?, supplier=?, cost_price=?, 
    retail_price=?, quantity_sold=?, inventory_position=?, min_stock_qty=?, max_stock_qty=?, 
    ordering_cost=?, delivery_time=?, lifespan=?, total_cost=?, total_retail=?, category_value=?, 
    WHERE productid=?";
    $stmt = $db->prepare($sql);
    if($stmt){
        $stmt->bind_param('ssssssssssiiiiiii', $product, $category, $sku, $supplier, $actualprice, $retailprice, $qtysold, $inventoryposition, $minstockqty, $maxstockqty, $ordcost, $deltime, $lifespan, $totalcost, $totalretail, $cat_value, $_POST['productid'] );
        // echo $totalcost;
        if ($stmt->execute()) {
            $_SESSION['message'] = "Product updated successful";
            $back = "?allitems";
            include 'message.html.php';
            exit;
        } else {
            $_SESSION['message'] = "Error: " .$db->error;
            
        }
    }else{
        $_SESSION['message'] = "Error: " .$db->error;
    }
    $db -> close();  
} 

//add product
if (isset($_POST['action']) && $_POST['action'] == 'add product'){
    include("../assets/dbConnect.php");

    $product	        = $_POST['product'];
    $category	        = $_POST['category'];
    $sku		        = $_POST['sku'];
    $supplier	        = $_POST['supplier'];
    $actualprice		= $_POST['actualprice'];
    $retailprice		= $_POST['retailprice'];
    $qtysold		    = $_POST['qtysold'];
    $inventoryposition	= $_POST['inventoryposition'];
    $minstockqty		= $_POST['minstockqty'];
    $maxstockqty		= $_POST['maxstockqty'];
    $ordcost            = $_POST['ordcost'];
    $deltime            = $_POST['deltime'];
    $lifespan           = $_POST['lifespan'];
    $userid             = $_SESSION['userid'];
    $totalcost          = $qtysold * $actualprice;
    $totalretail        = $qtysold * $retailprice;
    $cat_value          = 0;
    switch($category){
        case 'groceries': $cat_value = 30;
        break;
        case 'clothing': $cat_value = 25;
        break;
        default: $cat_value = 20;
    }

    $sql = "INSERT INTO productsales (userid, product_name, category, sku, supplier, cost_price, 
    retail_price, quantity_sold, inventory_position, min_stock_qty, max_stock_qty, ordering_cost,
    delivery_time, lifespan, total_cost, total_retail, category_value)
    VALUES ('$userid', '$product', '$category', '$sku', '$supplier', '$actualprice',
    '$retailprice', '$qtysold', '$inventoryposition', '$minstockqty', '$maxstockqty', 
    '$ordcost', '$deltime', '$lifespan', '$totalcost', '$totalretail', '$cat_value')";

    if (mysqli_query($db , $sql)) {
        $_SESSION['message'] = "Product successfully added";
        $back = "?additem";
        include 'message.html.php';
        exit;
    } else {
        $_SESSION['message'] = "Error: " . $sql . "<br>" . mysqli_error($db);
    }
    $db -> close();  
} 
//open edit user page
if(isset($_GET['edit-user'])){
    include "profile-update.html.php";
    exit;
}
//open product page
if(isset($_GET['additem'])){
    $product	        = '';
    $category	        = '';
    $sku		        = '';
    $supplier	        = '';
    $actualprice		= '';
    $retailprice		= '';
    $qtysold		    = '';
    $inventoryposition	= '';
    $minstockqty		= '';
    $maxstockqty		= '';
    $button             = "Save";
    $header             = "Add product sales information";
    $action             = "add product";
    $productid          = '';
    $ordcost            = '';
    $deltime            = '';
    $lifespan           = '';
    $userid             = '';
    $totalcost          = '';
    include "additem.html.php";
    exit;
}

//open create order page
if(isset($_GET['create-order'])){
    unset($_SESSION['message']);
    unset($_SESSION['success']);
    $method = "Minimum/Maximum Method";
    $orders = Array();
    include "createorder.html.php";
    exit;
}
// View Order Items
if(isset($_POST['view-order'])){
    //load orders
    try{
        include '../assets/dbConnect.php';
        $query = "SELECT orderid, order_policy, date(order.created_at) as date, fullname FROM stockproper.order 
        INNER JOIN users ON users.userid = order.userid WHERE order.userid='".$_SESSION['userid']."'";
        $result = $db->query($query);
        if($result){
            //$result = $stmt->get_result();
            $orders = $result->fetch_all(MYSQLI_ASSOC);
        }else{
            $_SESSION['message'] = 'Error occured '. $db->error;
        }
    }catch(Exception $ex){
        $_SESSION['message'] = 'Error occured '. $ex;
    }
    // load items  
    try{
        include '../assets/dbConnect.php';
        $query = "SELECT itemid, product_name, category, supplier, cost_price, order_qty, retail_price, 
        total_retail, total_cost, ordering_cost, estimated_profit, lifespan, keeping_cost,
        delivery_date FROM order_items WHERE orderid='".$_POST['orderid']."'";
        $result = $db->query($query);
        if($result){
            //$result = $stmt->get_result();
            $items = $result->fetch_all(MYSQLI_ASSOC);
            //  Get the sums
            $query_sum = "SELECT sum(total_retail), sum(total_cost), sum(keeping_cost), 
            sum(ordering_cost), sum(estimated_profit) FROM order_items WHERE orderid = ?";
            $stmt = $db->prepare($query_sum);
            
            if($stmt){
                $stmt->bind_param('i', $_POST['orderid']);
                $stmt->execute();
                $stmt->bind_result($retail_sum, $cost_sum, $keeping_sum, $ordering_sum, $profit_sum);
                $stmt->fetch();
                $_SESSION['success'] = 'Details found, scroll down to see';
                unset($_SESSION['message']);
            }else{
                echo $db->error;
            }
        }else{
            $_SESSION['message'] = 'Error occured '. $db->error;
        }
    }catch(Exception $ex){
        $_SESSION['message'] = 'Error occured '. $ex;
    }  
    include 'savedorders.html.php'; 
    exit; 
}

// Delete order
if(isset($_POST['delete-order'])){
    //load orders
    include '../assets/dbConnect.php';
    // delete order;
    $sql = "DELETE FROM stockproper.order WHERE orderid=?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('i', $_POST['orderid']);
    if($stmt->execute()){
        unset($_SESSION['success']);
        $_SESSION['message'] = "Order Succesfully Deleted";
    }else{
        $_SESSION['message'] = "Error Occured ". $db->error;
    }
    $stmt->close();
    try{
        $query = "SELECT orderid, order_policy, date(order.created_at) as date, fullname FROM stockproper.order 
        INNER JOIN users ON users.userid = order.userid WHERE order.userid='".$_SESSION['userid']."'";
        $result = $db->query($query);
        if($result){
            //$result = $stmt->get_result();
            $orders = $result->fetch_all(MYSQLI_ASSOC);
            $items = Array();
        }else{
            $_SESSION['message'] = 'Error occured '. $db->error;
        }
    }catch(Exception $ex){
        $_SESSION['message'] = 'Error occured '. $ex;
    }  
    include 'savedorders.html.php'; 
    exit;
}

// evalutae policy
if(isset($_POST['evaluate-policy'])){
    $evaluates = Array();
    foreach($_SESSION['products'] as $product){
        $productid = $product['productid'];
        $month1 = 'month1'.$product['productid'];
        $month2 = 'month2'.$product['productid'];
        $month3 = 'month3'.$product['productid'];
        $month4 = 'month4'.$product['productid'];
        $month5 = 'month5'.$product['productid'];
        $month6 = 'month6'.$product['productid'];
        $qty1 =  $_POST[$month1];
        $qty2 =  $_POST[$month2];
        $qty3 =  $_POST[$month3];
        $qty4 =  $_POST[$month4];
        $qty5 =  $_POST[$month5];
        $qty6 =  $_POST[$month6];
        if($qty1 == '' && $qty2 == '' && $qty3 == '' && $qty4 == '' && $qty5 == '' && $qty6 == ''){
            $_SESSION['message'] = 'Please fill in the quantities';
            header('Location: ?evaluate-policies');
        }
        $qty_sum = $qty1 + $qty2 + $qty3 + $qty4 + $qty5 + $qty6;
        $qty_mean = round(($qty_sum / 6), 2);
        $dev1 = ($qty1 - $qty_mean)**2;
        $dev2 = ($qty2 - $qty_mean)**2;
        $dev3 = ($qty3 - $qty_mean)**2;
        $dev4 = ($qty4 - $qty_mean)**2;
        $dev5 = ($qty5 - $qty_mean)**2;
        $dev6 = ($qty6 - $qty_mean)**2;
        $dev_sum = round(($dev1 + $dev2 + $dev3 + $dev4 + $dev5 + $dev6), 2);
        $std_dev = round(sqrt($dev_sum / (6-1)), 2);
        $percent_dev = round(($std_dev / $qty_mean) * 100, 2);
        $evaluate = array('productid' => $productid, 'qty_mean' => $qty_mean, 'std_dev' => $std_dev, 'percent_dev' => $percent_dev);
        array_push($evaluates, $evaluate);
    }
    // print_r($evaluates);
    try{
        include '../assets/dbConnect.php';
        $query = "SELECT productid, product_name, category, sku, supplier,
        cost_price, retail_price, quantity_sold, inventory_position, min_stock_qty,
        max_stock_qty, total_cost, total_retail, ordering_cost, (total_cost * category_value)/100 as keeping_cost, 
        date(created_at) as date FROM productsales WHERE userid='".$_SESSION['userid']."'";
        $result = $db->query($query);
        if($result){
            $products = $result->fetch_all(MYSQLI_ASSOC);
            $products_replenish = $products;
            $minmaxorders = Array();
            $replenishorders = Array();
            //check min-max condition and save the product in orders array.
            foreach ($products as $product){
                foreach($evaluates as $evaluate){
                    if($product['productid'] == $evaluate['productid']){
                        $minstockqty        = $product['min_stock_qty'];
                        $maxstockqty        = $product['max_stock_qty'];
                        $inventoryposition  = $product['inventory_position'];
                        if($inventoryposition <= $minstockqty){
                            $orderqty = $maxstockqty - $inventoryposition;
                            $product['order_qty'] = $orderqty;
                            $product['estimated_profit'] = 
                            ($product['total_retail'] - ($product['total_cost'] + $product['keeping_cost'] + $product['ordering_cost']) );
                            $product['qty_mean'] = $evaluate['qty_mean'];
                            $product['std_dev'] = $evaluate['std_dev'];
                            $product['percent_dev'] = $evaluate['percent_dev'];
                            $product['chance'] = round((($orderqty - $evaluate['qty_mean']) / $evaluate['qty_mean']) * 100, 2);
                            array_push($product, $product['order_qty'], $product['estimated_profit'], $product['qty_mean'], $product['std_dev'], $product['percent_dev'], $product['chance']);
                            array_push($minmaxorders, $product);
                        }
                    }
                }
                //summary of orders
                $retail_sum_minmax      = 0;
                $cost_sum_minmax        = 0;
                $keeping_sum_minmax     = 0;
                $ordering_sum_minmax    = 0;
                $profit_sum_minmax      = 0;
                $date_minmax            = date('Y-m-d');
                foreach($minmaxorders as $order){
                    $retail_sum_minmax     += $order['total_retail'];
                    $cost_sum_minmax       += $order['total_cost'];
                    $keeping_sum_minmax    += $order['keeping_cost'];
                    $ordering_sum_minmax   += $order['ordering_cost'];
                    $profit_sum_minmax     += $order['estimated_profit'];
                }
                $_SESSION['minmaxorders'] = $minmaxorders;
            }
            foreach ($products_replenish as $product){
                foreach($evaluates as $evaluate){
                    if($product['productid'] == $evaluate['productid']){
                        $maxstockqty        = $product['max_stock_qty'];
                        $inventoryposition  = $product['inventory_position'];
                        $date               = strtotime($product['date']);
                        $currentdate        = strtotime(date('Y-m-d'));
                        $number_of_days = ($currentdate - $date)/60/60/24;
                        if($number_of_days <= 30){
                            $orderqty = $maxstockqty - $inventoryposition;
                            $product['order_qty'] = $orderqty;
                            $product['estimated_profit'] = 
                            ($product['total_retail'] - ($product['total_cost'] + $product['keeping_cost'] + $product['ordering_cost']) );
                            $product['qty_mean'] = $evaluate['qty_mean'];
                            $product['std_dev'] = $evaluate['std_dev'];
                            $product['percent_dev'] = $evaluate['percent_dev'];
                            $product['chance'] = round((($orderqty - $evaluate['qty_mean']) / $evaluate['qty_mean']) * 100, 2);
                            array_push($product, $product['order_qty'], $product['estimated_profit'], $product['qty_mean'], $product['std_dev'], $product['percent_dev'], $product['chance']);
                            array_push($replenishorders, $product);
                        }
                    }
                }
            }    
            //summary of orders
            $retail_sum_replenish    = 0;
            $cost_sum_replenish      = 0;
            $keeping_sum_replenish   = 0;
            $ordering_sum_replenish  = 0;
            $profit_sum_replenish    = 0;
            $date_replenish          = date('Y-m-d');
            foreach($replenishorders as $order){
                $retail_sum_replenish   += $order['total_retail'];
                $cost_sum_replenish     += $order['total_cost'];
                $keeping_sum_replenish  += $order['keeping_cost'];
                $ordering_sum_replenish += $order['ordering_cost'];
                $profit_sum_replenish   += $order['estimated_profit'];
            }
            $_SESSION['replenishorders'] = $replenishorders;
            $_SESSION['success'] = 'Evaluation completed, scroll down to view';
            include 'evaluatepolicies.html.php';
            exit;
        }else{
            $_SESSION['message'] = 'Error occured '. $db->error;
        }
    }catch(Exception $ex){
        $_SESSION['message'] = 'Error occured '. $ex;
    } 
    $back = "?evaluate-policies";
    include 'message.html.php'; 
} 
// view evaluation report
if(isset($_POST['view-evaluation-report'])){

    $evaluationsid = $_POST['evaluationid'];
    //load orders
    try{
        include '../assets/dbConnect.php';
        $query = "SELECT evaluationsid, policy, date(evaluations.created_at) as date, fullname FROM evaluations 
        INNER JOIN users ON users.userid = evaluations.userid WHERE evaluations.userid='".$_SESSION['userid']."'";
        $result = $db->query($query);
        if($result){
            //$result = $stmt->get_result();
            $evaluations = $result->fetch_all(MYSQLI_ASSOC);
        }else{
            $_SESSION['message'] = 'Error occured '. $db->error;
        }
    }catch(Exception $ex){
        $_SESSION['message'] = 'Error occured '. $ex;
    }
    // load items  
    try{
        include '../assets/dbConnect.php';
        $method = 'minmax';
        $query = "SELECT productid, product_name, cost_price, order_qty, total_retail,
        total_cost, ordering_cost, keeping_cost, estimated_profit, average_sales, 
        std_dev_sales, percent_dev, chance FROM evaluation WHERE evaluationsid=".$evaluationsid." AND method='".$method."' ";
        $result = $db->query($query);
        if($result){
            //$result = $stmt->get_result();
            $minmaxreport = $result->fetch_all(MYSQLI_ASSOC);
            //  Get the sums
            $query_sum = "SELECT sum(total_retail), sum(total_cost), sum(keeping_cost), 
            sum(ordering_cost), sum(estimated_profit), date(created_at) as date FROM evaluation WHERE evaluationsid=? AND method=?";
            $stmt = $db->prepare($query_sum);
            
            if($stmt){
                $stmt->bind_param('is', $evaluationsid, $method);
                $stmt->execute();
                $stmt->bind_result($retail_sum_minmax, $cost_sum_minmax, $keeping_sum_minmax, $ordering_sum_minmax, $profit_sum_minmax, $date_minmax);
                $stmt->fetch();
                $_SESSION['success'] = 'Details found, scroll down to see';
                unset($_SESSION['message']);
            }else{
                echo $db->error;
            }
        }else{
            $_SESSION['message'] = 'Error occured: '. $db->error;
        }
    }catch(Exception $ex){
        $_SESSION['message'] = 'Error occured: '. $ex;
    }  
    try{
        include '../assets/dbConnect.php';
        $method = 'replenish';
        $query = "SELECT productid, product_name, cost_price, order_qty, total_retail,
        total_cost, ordering_cost, keeping_cost, estimated_profit, average_sales, 
        std_dev_sales, percent_dev, chance FROM evaluation WHERE evaluationsid=".$evaluationsid." AND method='".$method."' ";
        $result = $db->query($query);
        if($result){
            //$result = $stmt->get_result();
            $replenishreport = $result->fetch_all(MYSQLI_ASSOC);
            //  Get the sums
            $query_sum = "SELECT sum(total_retail), sum(total_cost), sum(keeping_cost), 
            sum(ordering_cost), sum(estimated_profit), date(created_at) as date FROM evaluation WHERE evaluationsid = ? AND method=?";
            $stmt = $db->prepare($query_sum);
            
            if($stmt){
                $stmt->bind_param('is', $evaluationsid, $method);
                $stmt->execute();
                $stmt->bind_result($retail_sum_replenish, $cost_sum_replenish, $keeping_sum_replenish, $ordering_sum_replenish, $profit_sum_replenish, $date_replenish);
                $stmt->fetch();
                $_SESSION['success'] = 'Details found, scroll down to see';
                unset($_SESSION['message']);
            }else{
                echo $db->error;
            }
        }else{
            $_SESSION['message'] = 'Error occured: '. $db->error;
        }
    }catch(Exception $ex){
        $_SESSION['message'] = 'Error occured: '. $ex;
    }  
    include "savedreports.html.php";
    exit;
}

//delete evaluation
if(isset($_POST['delete-evaluation'])){
//load orders
include '../assets/dbConnect.php';
// delete order;
$sql = "DELETE FROM evaluations WHERE evaluationsid=?";
$stmt = $db->prepare($sql);
$stmt->bind_param('i', $_POST['evaluationid']);
if($stmt->execute()){
    unset($_SESSION['success']);
    $_SESSION['message'] = "Evaluation Succesfully Deleted";
}else{
    $_SESSION['message'] = "Error Occured ". $db->error;
}
$stmt->close();
try{
    $query = "SELECT evaluationsid, policy, date(evaluations.created_at) as date, fullname FROM evaluations 
    INNER JOIN users ON users.userid = evaluations.userid WHERE evaluations.userid='".$_SESSION['userid']."'";
    $result = $db->query($query);
    if($result){
        //$result = $stmt->get_result();
        $evaluations = $result->fetch_all(MYSQLI_ASSOC);
        $minmaxreport = Array();
        $replenishreport = Array();
    }else{
        $_SESSION['message'] = 'Error occured '. $db->error;
    }
}catch(Exception $ex){
    $_SESSION['message'] = 'Error occured '. $ex;
}  
include 'savedreports.html.php'; 
exit;
}

// save evaluation report
if(isset($_POST['save-report']) && $_POST['action'] == "save report"){

    include '../assets/dbConnect.php'; 

    $policy =  "Minimum/Maximum and Replenish";
    $userid = $_SESSION['userid'];
     
    if(!isset($_SESSION['minmaxorders']) && !isset($_SESSION['replenishorders'])){
        header('Location: ?evaluate-policies');
    }  
    //save order
    $esql = "INSERT INTO evaluations (userid, policy) VALUES ('$userid', '$policy')";

    if (mysqli_query($db, $esql)) {
        $_SESSION['message'] = "evaluation saved";  
    } else {
        $_SESSION['message'] = "Error: " . $osql . "<br>" . mysqli_error($db);
    }
    $evaluationsid = $db->insert_id;
    try
    {    
        foreach ( $_SESSION['minmaxorders'] as $order){
            // save order_items
            $sql = "INSERT INTO evaluation SET userid=?, evaluationsid=?, productid=?, product_name=?,
            cost_price=?, order_qty=?, total_retail=?, total_cost=?, keeping_cost=?, ordering_cost=?, 
            estimated_profit=?, average_sales=?, std_dev_sales=?, percent_dev=?, chance=?, method=?";
            $stmt = $db->prepare($sql);
            if($stmt){
                $method = 'minmax';
                $stmt->bind_param('iiisiiiiiiidddds', $userid, $evaluationsid, $order['productid'], $order['product_name'], $order['cost_price'], $order['order_qty'], $order['total_retail'], $order['total_cost'], $order['keeping_cost'], $order['ordering_cost'], $order['estimated_profit'], $order['qty_mean'], $order['std_dev'], $order['percent_dev'], $order['chance'], $method);
                if ($stmt->execute()) {
                    $_SESSION['message'] = "Report successfully saved";
                    unset($_SESSION['minmaxorders']);
                } else {
                    $_SESSION['message'] = "Error: " .$db->error;
                }
            }
        }
        foreach ( $_SESSION['replenishorders'] as $order){
            // save order_items
            $sql = "INSERT INTO evaluation SET userid=?, evaluationsid=?, productid=?, product_name=?,
            cost_price=?, order_qty=?, total_retail=?, total_cost=?, keeping_cost=?, ordering_cost=?, 
            estimated_profit=?, average_sales=?, std_dev_sales=?, percent_dev=?, chance=?, method=?";
            $stmt = $db->prepare($sql);
            if($stmt){
                $method = 'replenish';
                $stmt->bind_param('iiisiiiiiiidddds', $userid, $evaluationsid, $order['productid'], $order['product_name'], $order['cost_price'], $order['order_qty'], $order['total_retail'], $order['total_cost'], $order['keeping_cost'], $order['ordering_cost'], $order['estimated_profit'], $order['qty_mean'], $order['std_dev'], $order['percent_dev'], $order['chance'], $method);
                if ($stmt->execute()) {
                    $_SESSION['message'] = "Report successfully saved";
                    unset($_SESSION['replenishorders']);
                } else {
                    $_SESSION['message'] = "Error: " .$db->error;
                }
            }
        }
    }catch (Exception $e){
        $_SESSION['message'] = $e;
    }finally {
        $db -> close();  
    }
    $back = "?evaluate-policies";
    include 'message.html.php';
    exit;
}

//open evalute-policies page
if(isset($_GET['evaluate-policies'])){
    //load products
    include '../assets/dbConnect.php';
    try{
        $query = "SELECT productid, product_name FROM productsales 
        WHERE userid='".$_SESSION['userid']."'";
        $result = $db->query($query);
        if($result){
            //$result = $stmt->get_result();
            $products = $result->fetch_all(MYSQLI_ASSOC);
            $_SESSION['products'] = $products;
            unset($_SESSION['message']);
            unset($_SESSION['success']);
            $replenishorders = '';
            $minmaxorders = '';
        }else{
            $_SESSION['message'] = 'Error occured '. $db->error;
        }
    }catch(Exception $ex){
        $_SESSION['message'] = 'Error occured '. $ex;
    }
    include "evaluatepolicies.html.php";
    exit;
}

//open saved evaluation report
if(isset($_GET['saved-reports'])){
    //load orders
    try{
        include '../assets/dbConnect.php';
        $query = "SELECT evaluationsid, policy, date(evaluations.created_at) as date, fullname FROM evaluations 
        INNER JOIN users ON users.userid = evaluations.userid WHERE evaluations.userid='".$_SESSION['userid']."'";
        $result = $db->query($query);
        if($result){
            //$result = $stmt->get_result();
            $evaluations = $result->fetch_all(MYSQLI_ASSOC);
            unset($_SESSION['message']);
            unset($_SESSION['success']);
            $minmaxreport = Array();
            $replenishreport = Array();
        }else{
            $_SESSION['message'] = 'Error occured: '. $db->error;
        }
    }catch(Exception $ex){
        $_SESSION['message'] = 'Error occured '. $ex;
    }  
    include 'savedreports.html.php'; 
    exit;
}

//open saved orders page
if(isset($_GET['saved-orders'])){
    //load orders
    try{
        include '../assets/dbConnect.php';
        $query = "SELECT orderid, order_policy, date(order.created_at) as date, fullname FROM stockproper.order 
        INNER JOIN users ON users.userid = order.userid WHERE order.userid='".$_SESSION['userid']."'";
        $result = $db->query($query);
        if($result){
            //$result = $stmt->get_result();
            $orders = $result->fetch_all(MYSQLI_ASSOC);
            unset($_SESSION['message']);
            unset($_SESSION['success']);
            $items = Array();
        }else{
            $_SESSION['message'] = 'Error occured '. $db->error;
        }
    }catch(Exception $ex){
        $_SESSION['message'] = 'Error occured '. $ex;
    }  
    include 'savedorders.html.php'; 
    exit;
}

//open all product page
if(isset($_GET['allitems'])){
    //load default
try{
    include '../assets/dbConnect.php';
    
    $query = "SELECT productid, product_name, category, sku, supplier,
    cost_price, retail_price, quantity_sold, inventory_position, min_stock_qty,
    max_stock_qty, total_cost, total_retail, (total_cost * category_value)/100 as keeping_cost, ordering_cost,
    lifespan, delivery_time FROM productsales WHERE userid='".$_SESSION['userid']."'";
    $result = $db->query($query);
    if($result){
      //$result = $stmt->get_result();
      $products = $result->fetch_all(MYSQLI_ASSOC);
      unset($_SESSION['message']);
    }else{
      $_SESSION['message'] = 'Error occured '. $db->error;
    }
    
  }catch(Exception $ex){
    $_SESSION['message'] = 'Error occured '. $ex;
  } 
  include 'allitems.html.php';
  exit;
}

include 'profile.html.php';
?>