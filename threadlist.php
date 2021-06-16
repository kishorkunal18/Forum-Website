<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <style>
    #ques {
        min-height: 433px;
    }
    </style>

    <title>Welcome to iDiscuss-Coding Forum</title>
</head>

<body>
    <?php include 'partials/header.php';?>
    <?php include 'partials/dbconnect.php';?>
    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$id";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }
    ?>

    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        // iserting indb
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];
        $sql ="INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) 
        VALUES ( '$th_title', '$th_desc', '$id', '0', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        $showAlert = True;
        if($showAlert){
            echo'<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your thread has been added,Please wait someone to respond.
          </div>';
        }
    }

    ?>



    <!-- category container starts here -->

    <div class="container my-2">
        <div class="jumbotron bg-light">
            <h1 class="display-4">Welcome to <?php echo $catname;?> Forum</h1>
            <p class="lead"><?php echo $catdesc;?></p>
            <hr class="my-4">
            <p>It is peer to peer forum for sharing knowledge with each other.No Spam / Advertising / Self-promote in
                the forums is allowed.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Do not cross post questions.
                Do not PM users asking for help.
                Remain respectful of other members at all times.
            </p>
            <p class="lead">
                <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
        <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
        {
            echo '<div class="container">
            <h1 class="py-2">Start a Discussion!</h1>
            <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Problem Title</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="title"
                        placeholder="">
                    <small id="title" class="form-text text-muted">Keep your title short and crisp.</small>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Elaborate Your Problem</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-success my-3">Submit</button>
            </form>
            </div>';
        }
        else{
            echo '
            <div class="container">
            <h1 class="py-2">Start a Discussion!</h1>
                <p class = "lead" ><strong class=text-danger>You are not logged in.Please login to start a disscussion.</strong></p>
            </div>';
        } 

        ?>
        <div class="container" id="ques">
            <h1 class="py-2">Browse Questions</h1>
            <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while($row = mysqli_fetch_assoc($result)){
            $noResult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_time =$row['timestamp'];
            
            
        
            echo'<div class="media my-3">
                <img class="mr-3" src="img/user.jfif" width=40px alt="Generic placeholder image">
                <div class="media-body">
                <p class="font-weight-bold my-0"><b>User at</b>: '. $thread_time .';
                    <h5 class="mt-0"><a href ="thread.php?threadid='. $id .'">'. $title .'</a></h5>
                    '. $desc .'
                </div>
            </div>';

        }
        
       // echo var_dump ($noResult);
        if($noResult){
           echo' <div class="jumbotron jumbotron-fluid">
  <div class="container">
    <p class="display-4">No Thread Started</p>
    <p class="lead">Be first person to ask question.</p>
  </div>
</div>';
        }
?>




            <?php include 'partials/footer.php';?>

            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
                crossorigin="anonymous">
            </script>

            <!-- Option 2: Separate Popper and Bootstrap JS -->
            <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
</body>

</html>