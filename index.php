<?php
require_once "conn.php";
$sql = "SELECT * FROM post_title";
$result = mysqli_query($conn, $sql);
$data = [];
if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container-fulid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-warning">
                        <div class="card-title">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3><i>Users</i></h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="add.php" class="btn btn-outline-success">Add Record</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $key => $value) {
                                ?>
                                    <tr>
                                        <td><?php echo $value['id'] ?? '' ?></td>
                                        <td><?php echo $value['title'] ?? '' ?></td>
                                        <td><a href="edit.php?id=<?php echo $value['id'] ?? '' ?>" class="btn btn-outline-info">Edit</a>
                                     <a href="delete.php?id=<?php echo $value['id'] ?? '' ?>" class="btn btn-outline-danger">Delete</a></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>