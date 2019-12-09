<?php
    include 'inc/header.php';
    Permission::owner();
    include 'inc/sidebar.php';
    include 'inc/navbar.php';
?>

<?php
    if(!empty($_GET['del_varatia_id'])){
        $del_varatia_id = $_GET['del_varatia_id'];
        $query = "DELETE FROM `varatia` WHERE `id` = '$del_varatia_id'";

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
                        <h4 class="card-title">Varatia List</h4>
                        <p class="card-category" style="font-size:20px;font-weight:bold">(MID STAGE DATA)</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table">
                      <thead class=" text-primary">
                        <th>ID</th>
                        <th>Varatia ID</th>
                        <th>Varatia Name</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php
                            $query=" SELECT user.username, varatia.*
                            FROM `user`
                            INNER JOIN `varatia`
                            ON
                            user.id = varatia.varatia_id
                            ";
                            $result = $db->select($query);
                            if($result){
                                $i = 0;
                                while($user = $result->fetch_assoc()){
                                    $i++;
                                    //var_dump($user);
                        ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $user['varatia_id'];?></td>
                            <td><?php echo $user['username'];?></td>
                            <td><?php echo $fm->format_date($user['created_at']);?></td>
                            <td><?php echo $fm->format_date($user['updated_at']);?></td>
                            <td>
                                <a 
                                    href="?del_varatia_id=<?php echo $user['id'];?>" 
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