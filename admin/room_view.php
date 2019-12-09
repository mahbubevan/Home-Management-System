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
                        <h4 class="card-title">User List</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table">
                      <thead class=" text-primary">
                        <th>ID</th>
                        <th>Owner Name</th>
                        <th>Varatia Name</th>
                        <th>NID</th>
                        <th>Total Person</th>
                        <th>Fair</th>
                        <th>Status</th>
                        <th>Due</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php
                            $query="SELECT room.*,owner.owner_name,varatia.varatia_name 
                                FROM (
                                    room INNER JOIN owner ON room.user_id = owner.user_id
                                    INNER JOIN varatia ON room.varatia_id = varatia.varatia_id
                                )
                            ";
                            $result = $db->select($query);
                            if($result){
                                $i = 0;
                                while($user = $result->fetch_assoc()){
                                    $i++;
                        ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $user['owner_name'];?></td>
                            <td><?php echo $user['varatia_name'];?></td>
                            <td><?php echo $user['nid']; ?></td>
                            <td><?php echo $user['total_person']; ?></td>
                            <td><?php echo $user['fair']; ?></td>
                            <td><?php if($user['status']==0){echo '<span class="text-success">Regular</span>';}else{echo "<span class='text-danger'>Irregular</span>";} ?></td>
                            <td><?php echo $user['due']; ?></td>
                            <td><?php echo $fm->format_date($user['created_at']);?></td>
                            <td><?php echo $fm->format_date($user['updated_at']);?></td>
                            <td>
                                <a href="room_edit.php?room_id=<?php echo $user['id'];?>" class="btn btn-sm btn-info">Edit</a> ||
                                <a 
                                    href="?del_room_id=<?php echo $user['id'];?>" 
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are You Sure ?')"
                                    >Delete</a>
                            </td>
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