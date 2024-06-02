<?php include('../partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <?php if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <!-- Add Category Form Starts Here-->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td><label for="title">Title : </label></td>
                    <td><input type="text" id="title" name="title" placeholder="Enter Title" required></td>
                </tr>
                <tr>
                    <td><label for="image_name">Select Image : </label></td>
                    <td><input type="file" id="image_name" name="image_name" required></td>
                </tr>
                <tr>
                    <td><label for="featured">Featured : </label></td>
                    <td>
                        <select name="featured" id="featured">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td><label for="active">Active : </label></td>
                    <td>
                        <select name="active" id="active">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Add Admin" class="btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add Category Form Ends Here-->

    </div>

</div>
<?php include('../partials/footer.php') ?>

<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $featured = $_POST['featured'];
    $image_name = '';
    $active = $_POST['active'] == 'Yes' ? 1 : 0;

    if ($_FILES['image_name']['name']) {
        $image_name = $_FILES['image_name']['name'];

        $ext = end(explode(".", $image_name));
        $image_name = "Food_Category" . rand(000, 999) . '.' . $ext;
        $source_path = $_FILES['image_name']['tmp_name'];
        $destination_path = '../../images/category/' . $image_name;
        $upload = move_uploaded_file($source_path, $destination_path);

        if (!$upload) {
            $_SESSION['upload'] = "<div class='error'> Failed To Upload Image </div>";
            header('location:' . Category_URL . '/add_category.php');
            die();
        }
    }
    $sql = "INSERT INTO tbl_category set featured ='$featured', active = '$active', title = '$title', image_name = '$image_name'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $_SESSION['add'] = "<div class='success'> Category Added Successfully </div>";
        header('location:' . Category_URL . '/manage_category.php');
    } else {
        $_SESSION['add'] = "<div class='error'> Failed To add Category </div>";
        header('location:' . Category_URL . '/add_category.php');
    }
}
?>
