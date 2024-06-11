<?php
require_once "header.php";
if (isset($_POST['add-post'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $category = $conn->real_escape_string($_POST['category']);
    $details = $conn->real_escape_string($_POST['details']);
    $image = $_FILES['img'];
    $imageName = $image['name'];
    $imageTmp = $image['tmp_name'];
    $imageSize = $image['size'];
    $imageError = $image['error'];
    $imageType = $image['type'];
    $imageExt = explode('.', $imageName);
    $imageActualExt = strtolower(end($imageExt));
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    if (in_array($imageActualExt, $allowed)) {
        if ($imageError === 0) {
            if ($imageSize < 1000000) {
                $newImageName = uniqid('', true) . '.' . $imageActualExt;
                $imageDestination = './images/blog/' . $newImageName;
                $move = move_uploaded_file($imageTmp, $imageDestination);
                if ($move) {
                    $conn->query("INSERT INTO `post` (`title`,`category_id`,`details`,`img`) VALUES ('$title','$category','$details','$newImageName')");
                    echo "<script>toastr.success('Post Added')</script>";
                }
            } else {
                echo "<script>toastr.error('Image Size is too large')</script>";
            }
        } else {
            echo "<script>toastr.error('Error Uploading Image')</script>";
        }
    } else {
        echo "<script>toastr.error('Invalid Image Format')</script>";
    }
}
$posts = $conn->query("SELECT * FROM post");
$allPosts = $posts->fetch_all(MYSQLI_ASSOC);

?>

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>

<div class="container-fluid">
    <div class="row d-flex position-fixed w-100">
        <div style="width: 200px;" class="min-vh-100 bg-dark col-1">
            <?php include_once('./components/adminSidebar.php') ?>
        </div>

        <div class="col flex-grow-1">
            <div class="row">
                <div class="col-md-6">
                    <h2>All Posts</h2>
                    <table class="" id="myTable">
                        <thead>
                            <tr >
                                <th class="py-3">S.N</th>
                                <th class="py-3 ">Post Title</th>
                                <th class="py-3">Image</th>
                                <th class="py-3">Category</th>
                                <th class="py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($allPosts as $post) {
                            ?>
                                <tr>
                                    <td class="py-3 me-2"><?= $i++ ?></td>
                                    <td class="py-3 me-2"><?= $post['title'] ?></td>
                                    <td class="py-3 me-2"><img src="./images/blog/<?= $post['img'] ?>" alt="" style="width: 100px;"></td>
                                    <td class="py-3 me-2">
                                        <?php
                                        $catId = $post['category_id'];
                                        $cat = $conn->query("SELECT * FROM categories WHERE id='$catId'");
                                        $category = $cat->fetch_object();
                                        echo $category->name;
                                        ?>
                                    </td>
                                    <td class="d-flex">
                                        <a href="edit-post.php?pid=<?= $post['id'] ?>" class="btn btn-primary btn-sm me-2">Edit</a>
                                        <a href="delete-post.php?pid=<?= $post['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let table = $('#myTable').DataTable({
        pageLength: 5,
        lengthMenu: [
            [5, 10, 20, -1],
            [5, 10, 20, 'Todos']
        ]
    });
</script>

<?php
require_once "footer.php";
?>