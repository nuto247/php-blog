<?php

include 'checkAuthenticated.php';
include 'dbcon.php';
include 'function.php';


$query = "SELECT * FROM users";

if ($results = mysqli_query($con, $query)) {

    if (mysqli_num_rows($results) > 0) {
    }
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($con);
}

include 'header.php';
?>


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Users-list</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="col-md-10">

                <div class="card card-primary">


                    <form action="" method="post">
                        <div class="row">
                            <div class="col-12">

                                <div class="card-header">
                                    <h3 class="card-title">Users table</h3>
                                </div>

                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">

                                        <tr>
                                            <th>First name</th>
                                            <th>Last name</th>
                                            <th>Email</th>
                                            <th>Phone-number</th>
                                            <th>Adress</th>
                                            <th>Action</th>
                                        </tr>


                                        <?php while ($user = mysqli_fetch_assoc($results)) { ?>
                                            <tr>
                                                <td><?php echo $user['firstname'] ?></td>
                                                <td><?php echo $user['lastname'] ?></td>
                                                <td><?php echo $user['email'] ?></td>
                                                <td><?php echo $user['phone'] ?></td>
                                                <td><?php echo $user['address'] ?></td>
                                                <td>

                                                    <a class="btn btn-primary btn-sm" href="user-edit.php?id=<?php echo $user['id'] ?>">Add details</a>

                                                    <a class="btn btn-danger btn-sm" href="user-delete.php?id=<?php echo $user['id'] ?>">Delete</a>

                                                </td>
                                            </tr>

                                        <?php } ?>
                                        <tr class="add">
                                            <td><button class="btn btn-primary">
                                                <a href="user-add.php" style="color: white;">Add user</a></button></td>
                                        </tr>

                                    </table>
                                </div>


                            </div>
                        </div>
                    </form>
                </div>

            </div>



        </div>


    </div>

</section>


<?php include 'footer.php' ?>