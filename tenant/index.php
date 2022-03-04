<?php
include("authentication.php");
include("includes/header.php");
?>

<div class="container-fluid px-4"> 
    <h1 class="mt-4"></h1>
    <div class="row">
        <!--COUNTER FOR UNPAID BILLS -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body shadow-sm d-flex justify-content-around align-items-center">
                    <div>
                        <h3 class="fs-5">Unpaid Bills</h3>
                    </div>
                    <i class="fas fa-exclamation-triangle" style="font-size:40px;color:white"></i>
                </div>
                <?php
                if(isset($_SESSION['auth_user']))
                {
                    # To fetch data from table bill
                    $user_id = $_SESSION['auth_user']['user_id'];
                        $dash_query = "SELECT *, users.id
                                        FROM bills
                                        INNER JOIN tenant
                                        INNER JOIN users
                                        ON bills.tenant_id = tenant.tenant_id AND tenant.users_id = users.id
                                        WHERE bill_status = 0 AND users.id={$user_id}";
                        $dash_query_run = mysqli_query($con, $dash_query);

                        if($total = mysqli_num_rows($dash_query_run))
                        {
                            echo '<h3 class="mb-0 text-center">'.$total.'</h3>';
                        }
                        else
                        {
                            echo '<h3 class="mb-0 text-center ">No data</h3>';
                        }
                }
                ?>

                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="bill.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!--COUNTER FOR PAID BILLS -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body shadow-sm d-flex justify-content-around align-items-center">
                    <div>
                        <h3 class="fs-5">Paid Bills</h3>
                    </div>
                    <i class="fas fa-bell" style="font-size:40px;color:white"></i>
                </div>
                <?php
                if(isset($_SESSION['auth_user']))
                {
                    # To fetch data from table bill tenant view
                    $user_id = $_SESSION['auth_user']['user_id'];
                        $dash_query = "SELECT *, users.id
                                        FROM bills
                                        INNER JOIN tenant
                                        INNER JOIN users
                                        ON bills.tenant_id = tenant.tenant_id AND tenant.users_id = users.id
                                        WHERE bill_status = 1 AND users.id={$user_id}";
                        $dash_query_run = mysqli_query($con, $dash_query);

                        if($total = mysqli_num_rows($dash_query_run))
                        {
                            echo '<h3 class="mb-0 text-center">'.$total.'</h3>';
                        }
                        else
                        {
                            echo '<h3 class="mb-0 text-center ">No data</h3>';
                        }
                }
                ?>

                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="bill.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!--COUNTER FOR NUMBER OF PAYMENTS -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body shadow-sm d-flex justify-content-around align-items-center">
                    <div>
                        <h3 class="fs-5">Payments</h3>
                    </div>
                    <i class="far fa-credit-card" style="font-size:40px;color:white"></i>
                </div>
                <?php
                if(isset($_SESSION['auth_user']))
                {
                    # To fetch data from table bill
                    $user_id = $_SESSION['auth_user']['user_id'];
                        $dash_query = "SELECT *, users.id
                                        FROM payments
                                        INNER join bills
                                        INNER JOIN tenant
                                        INNER JOIN users
                                        ON bills.bill_id = payments.bill_id AND bills.tenant_id = tenant.tenant_id AND tenant.users_id = users.id
                                        WHERE payment_status != 2 AND users.id={$user_id}";
                        $dash_query_run = mysqli_query($con, $dash_query);

                        if($total = mysqli_num_rows($dash_query_run))
                        {
                            echo '<h3 class="mb-0 text-center">'.$total.'</h3>';
                        }
                        else
                        {
                            echo '<h3 class="mb-0 text-center ">No data</h3>';
                        }
                }
                ?>

                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="payment.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

       
</div>


<?php
include("includes/footer.php");
include("includes/scripts.php");
?>