<?php
    include 'inc/header.php';
    Permission::owner();
    include 'inc/sidebar.php';
    include 'inc/navbar.php';
?>


<?php
    if(!empty($_GET['del_room_id'])){
        $del_room_id = $_GET['del_room_id'];
        $query = "DELETE FROM `room` WHERE `id` = '$del_room_id'";

        $delete_row = $db->delete($query);
        if($delete_row){
            $success_msg = "<span class='text-success'>Deleted Successfully</span>";
        }else{
            $error_msg = "<span class='text-danger'>Couldn't Deleted</span>";
        }
    }
?>

<div class="content">
    <div class="container-fluid">
        <?php
            if(!empty($success_msg)){
                echo $success_msg;
            }

            if(!empty($error_msg)){
                echo $error_msg;
            }
        ?>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h2 class="card-title">Transaction List</h2>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table">
                      <thead class=" text-primary">
                        <th>ID</th>
                        <th>Owner Name</th>
                        <th>Varatia Name</th>
                        <th>Monthly Fare</th>
                        <th>Payment</th>
                        <th>Due</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Status</th>
                        <th>TraxID</th>
                        <th>Payment Type</th>
                        <th>Created At</th>
                      </thead>
                      <tbody>
                        <?php
                            $query="SELECT transaction.*,owner.owner_name,varatia.varatia_name,room.fair
                                FROM (
                                    transaction INNER JOIN owner ON transaction.owner_id = owner.user_id
                                    INNER JOIN varatia ON transaction.room_id = varatia.varatia_id
                                    INNER JOIN room ON transaction.room_id = room.varatia_id
                                )
                            ";
                            $result = $db->select($query);
                            if($result){
                                $i = 0;
                                while($transaction = $result->fetch_assoc()){
                                    $i++;
                        ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $transaction['owner_name'];?></td>
                            <td><?php echo $transaction['varatia_name'];?></td>
                            <td><?php echo $transaction['fair'];?></td>
                            <td><?php echo $transaction['payment']; ?></td>
                            <td><?php echo $transaction['due']; ?></td>
                            <td><?php echo $transaction['month']; ?></td>
                            <td><?php echo $transaction['year']; ?></td>
                            <td>
                                <?php if($transaction['status']==0){
                                    echo '<span style="font-size:20px;font-weight:bold" class="text-success">Fully Paid</span>';
                                }elseif($transaction['status']==1){
                                    echo '<span style="font-size:20px;font-weight:bold" class="text-warning">Half-Paid</span>';
                                }
                                else{
                                    echo '<span style="font-size:20px;font-weight:bold" class="text-danger">Non-Paid</span>';
                                } ?>
                            </td>
                            <td><?php echo $transaction['random_transaction_id']; ?></td>
                            <td>
                                <?php if($transaction['payment_type']==0){
                                    echo '<span style="font-size:20px;font-weight:bold" class="text-info">CASH</span>';
                                    }elseif($transaction['payment_type']==1){
                                        echo '<span style="font-size:20px;font-weight:bold" class="text-info">BKASH</span>';
                                    }elseif($transaction['payment_type']==2){
                                        echo '<span style="font-size:20px;font-weight:bold" class="text-info">CHECK</span>';
                                    }else{
                                        echo '<span style="font-size:20px;font-weight:bold" class="text-danger">NOT PAID</span>';
                                    }
                                ?>
                            </td>
                            <td><?php echo $fm->format_date($transaction['created_at']);?></td>
                        </tr>
                        <?php     }
                            } ?>
                      </tbody>
                    </table>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include 'inc/footer.php';
?>