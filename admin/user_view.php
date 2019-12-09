<?php
    include 'inc/header.php';
    Permission::owner();
    include 'inc/sidebar.php';
    include 'inc/navbar.php';
?>

<?php
    if(!empty($_GET['del_user_id'])){
        $del_user_id = $_GET['del_user_id'];
        $query = "DELETE FROM `user` WHERE `id` = '$del_user_id'";

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
                        <th>Username</th>
                        <th>Email</th>
                        <th>Privileges</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php
                            $query="SELECT * FROM `user`";
                            $result = $db->select($query);
                            if($result){
                                $i = 0;
                                while($user = $result->fetch_assoc()){
                                    $i++;
                        ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $user['username'];?></td>
                            <td><?php echo $user['email'];?></td>
                            <td><?php if($user['status']==0){echo 'OWNER';}else{echo 'VARATIA';}  ?></td>
                            <td><?php echo $fm->format_date($user['created_at']);?></td>
                            <td><?php echo $fm->format_date($user['updated_at']);?></td>
                            <td>
                                <a href="user_edit.php?user_id=<?php echo $user['id'];?>" class="btn btn-sm btn-info">Edit</a> ||
                                <a 
                                    href="?del_user_id=<?php echo $user['id'];?>" 
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