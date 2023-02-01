<?php
if (isset($_POST['submit'])) {  //isset check if submit button set with value or not

    $title = $_POST['title'];
    $details = $_POST['details'];
    $date = $_POST['date'];

    include('connect.php');
    $result = "insert into users(title,details,date) values('$title','$details','$date')";
    $res = mysqli_query($conn, $result);
    if ($res) {
        /*echo "<div class='alert alert-success' role='alert'>
            Data added successfully!!
          </div>";*/
        header('location:index.php');
    } else {
        echo "<div class='alert alert-danger' role='alert'>
            Data not sent
          </div>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- ajax cdn  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <script>
        function todoVal() {
            if (document.getElementById('title').value == "") {
                document.getElementById('title').style.border = "1px solid red";
                document.getElementById('title_error').style.color = "#f00";
                document.getElementById('title').focus();
                document.getElementById('title_error').innerHTML = "Title is required";
                return false;
            }
            if (document.getElementById('details').value == "") {
                document.getElementById('details').style.border = "1px solid red";
                document.getElementById('details_error').style.color = "#f00";
                document.getElementById('details').focus();
                document.getElementById('details_error').innerHTML = "Details is required";
                return false;
            }
            if (document.getElementById('date').value == "") {
                document.getElementById('date').style.border = "1px solid red";
                document.getElementById('date_error').style.color = "#f00";
                document.getElementById('date').focus();
                document.getElementById('date_error').innerHTML = "Date is required";
                return false;
            }

        }

        function checkValue(ele) {
            if (ele.value != "") {
                ele.style.border = "1px solid #999";
                document.getElementById(ele.id + "_error").innerHTML = "";
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">

                <form action="" method="POST" onsubmit="return todoVal()">
                    <h1 class="text-muted text-center m-4">TO DO APP</h1>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" class="form-control" id="title" name="title" onblur="checkValue(this)" placeholder="Input your title">
                        <span id="title_error" style="color:red;"></span>
                    </div>
                    <div class="mb-3">
                        <label for="details" class="form-label">Details:</label>
                        <textarea class="form-control" id="details" name="details" rows="3" onblur="checkValue(this)" placeholder="Input your detais here..."></textarea>
                        <span id="details_error" style="color:red;"></span>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date:</label>
                        <input type="date" class="form-control" id="date" name="date" onblur="checkValue(this)" placeholder="Input your date here">
                        <span id="date_error" style="color:red;"></span>
                    </div>
                    <button type="submit" id="submit" class="btn btn-primary" name="submit" onsubmit="todoVal();">Submit</button>
                </form>
            </div>
            <div class="col-md-6">
                <h1 class="text-muted text-center m-4">_TO_DO_LIST_</h1>
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col">Sl/No.</th>
                            <th scope="col">Title</th>
                            <th scope="col">Details</th>
                            <th scope="col">Date</th>
                            <th scope="col">Operation</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        include('connect.php');
                        $q = "SELECT * FROM users";
                        $query = mysqli_query($conn, $q);

                        while ($res = mysqli_fetch_array($query)) {
                        ?>

                            <tr class="text-center">
                                <td><?php echo $res['id']; ?></td>
                                <td><?php echo $res['title']; ?></td>
                                <td><?php echo $res['details']; ?></td>
                                <td><?php echo $res['date']; ?></td>
                                <td>
                                    <button class="btn btn-primary">
                                        <a href="edit.php?id=<?php echo $res['id']; ?>" class="text-white">Edit</a>
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-danger">
                                        <a href="delete.php?id=<?php echo $res['id']; ?>" class="text-white">Delete</a>
                                    </button>
                                </td>

                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

</body>

</html>