<?php
require_once "conn.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_POST['title'] ?? '';

    $sql = "INSERT INTO post_title (title) VALUES('$title')";

    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);

        if ($last_id) {

            if (isset($_FILES['file']) && $_FILES['file']['name']) {
                foreach ($_FILES['file']['name'] as $key => $value) {

                    $file_name = $_FILES['file']['name'][$key];
                    $file_tmp = $_FILES['file']['tmp_name'][$key];

                    move_uploaded_file($file_tmp, 'upload/' . $file_name);
                    $image = $file_name ?? '';
                    $sql = "INSERT INTO post_img (users_id,image) VALUES('$last_id','$image')";

                    if (mysqli_query($conn, $sql)) {
                        header('location:index.php');
                    }
                }
            }
        }
    }
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

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header bg-warning">
                        <div class="card-title">
                            <div class="row">
                                <div class="col-md-6">Add_From</div>
                                <div class="col-md-6 text-right">
                                    <a href="index.php" class="btn btn-outline-success">Back To List</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" id="myfrom" method="post" enctype="multipart/form-data">

                            <div class="row img">
                               
                            </div>
                            <input type="file" name="file[]" id="file" multiple>

                            <div class="form-group mt-3">
                                <label for="">Title:</label>
                                <input type="text" class="form-control" name="title">
                            </div>

                    </div>
                    <div class="card-footer">
                        <button type="reset" class="btn btn-outline-warning">Reset</button>
                        <button type="submit" class="btn btn-outline-success">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {

        $("#file").change(function() {
            if (this.files && this.files[0]) {
                for (var i = 0; i < this.files.length; i++) {
                    var reader = new FileReader;
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[i]);
                }
            }
        });

        function imageIsLoaded(e) {
            $('.img').append('<div class="col-md-2 product-image"><img class="img-thumbnail mt-2 " width="150px" height="150px" src=' + e.target.result + '><button class="btn btn-outline-danger btn-sm mt-2 ml-3 mb-2 remove">Remove</button></div>')
        }

        $(document).on('click', 'remove', function(e) {
            $(this).parent('.product-image').remove();
        });
    });
</script>
