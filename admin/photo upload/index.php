<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
</head>
<body>
      
      <form action="" method="post" enctype="multipart/form-data">
      <?php 
            if(isset($_POST['submit'])){
                $file = $_FILES['image'];
                $fileName = $_FILES['image']['name'];
                $fileTmpname = $_FILES['image']['tmp_name'];
                $fileSize = $_FILES['image']['size'];
                $fileType = $_FILES['image']['type'];
                $fileError = $_FILES['image']['error'];
                $fileExt = explode('.',$fileName);
                $fileActualExt = strtolower(end($fileExt));
                $allow = array('png','jpg','jpeg');
                if(in_array($fileActualExt,$allow)){
                    if($fileError===0){
                        if($fileSize<10000000){
                            $fileNameNew = uniqid('',true).'.'.$fileActualExt;
                            $fileDestination = 'upload/'.$fileNameNew;
                            move_uploaded_file($fileTmpname,$fileDestination);
                            header("loaction:index.php?uploaded");

                        }else{
                            echo "file is to big";
                        }

                    }else{
                        echo " files have error";
                    }

                }else{
                    echo "you can not upload this type file";
                }
            }
       ?>
       <label for="image">Image</label>
        <input type="file" name="image">
        <button type="submit" name="submit">Upload</button>
    </form>
</body>
</html>