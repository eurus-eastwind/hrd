<?php

include("authentication.php");

if(isset($_POST['post_delete']))
{
    $post_id = $_POST['post_delete'];
    $query ="UPDATE post SET house_status='2' WHERE post_id='$post_id' LIMIT 1 ";
    $query_run = mysqli_query($con, $query);

    #Unlink image query
    $check_img_query = "SELECT * FROM post WHERE post_id='post_id' LIMIT 1";
    $img_run = mysqli_query($con, $check_img_query);
    $res_data = mysqli_fetch_array($con, $img_run );
    $image = $res_data['image'];

    if($query_run)
    {
        #unlink image
        if(file_exists('../uploads/posts/'.$image))
        {
            unlink("../uploads/posts/".$image);

        }
        $_SESSION['message'] = "House Information Has Been Deleted Successfully";
        #To go back ro the same form with the same id
        header("Location: post_view.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Something Went Wrong!";
        #To go back to the same form with the same id
        header("Location: post_view.php");
        exit(0);
    }


}


if(isset($_POST['update_post']))
{
    $post_id = $_POST['post_id'];
    $house_id = $_POST['house_id'];
    $post_name = $_POST['post_name'];
    $house_price = (is_numeric($_POST['house_price']) ? (int)$_POST['house_price'] : 0);
    $house_desc = $_POST['house_desc'];
    $house_status = $_POST['house_status'] == true ? '1':'0';

    $old_filename = $_POST['old_image'];
    $image = $_FILES['image']['name'];

    $update_filename = ""; 
    if($image != NULL)
    {
        #Renaming image
        $image_extension = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time().'.'.$image_extension;
        $update_filename = $filename;
    }
    else
    {
        $update_filename = $old_filename;
    }



    $query = "UPDATE post SET house_id='$house_id', post_name=' $post_name', 
                    house_price='$house_price', house_desc='$house_desc', house_status='$house_status',
                    image='$update_filename' WHERE post_id ='$post_id' ";             
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        if($image != NULL)
        {
            if(file_exists('../uploads/posts/'.$old_filename))
            {
                unlink("../uploads/posts/".$old_filename);

            }
            move_uploaded_file($_FILES['image']['tmp_name'],'../uploads/posts/'.$update_filename);
        }
        $_SESSION['message'] = "Post Updated Successfully";
        header("Location: post_edit.php?id=".$post_id);
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Something Went Wrong!";
        header("Location: post_edit.php?id=".$post_id);
        exit(0);
    }


}
if(isset($_POST['add_post']))
{
    $post_name = $_POST['post_name'];
    $house_id = $_POST['house_id'];
    $house_price = (is_numeric($_POST['house_price']) ? (int)$_POST['house_price'] : 0);
	$house_desc = $_POST['house_desc'];
    $image = $_FILES['image']['name'];
    $house_status = $_POST['house_status'] == true ? '1':'0';
    #Renaming image
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_extension;

	
	$query = "INSERT INTO post (house_id, post_name, house_price, house_desc, house_status, image) 
				VALUES ('$house_id','$post_name', '$house_price', '$house_desc', '$house_status','$filename')";

				
	$query_run = mysqli_query($con,$query);

   if($query_run)
    {
        move_uploaded_file($_FILES['image']['tmp_name'],'../uploads/posts/'. $filename);
        $_SESSION['message'] = "Post Created Successfully";
        header("Location: post_add.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Something Went Wrong!";
        header("Location: post_add.php");
        exit(0);
    }

}
if(isset($_POST['house_delete']))
{
    $house_id = $_POST['house_delete'];
    $query ="UPDATE house SET house_status='2' WHERE house_id='$house_id' LIMIT 1 ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "House Information Has Been Deleted Successfully";
        #To go back ro the same form with the same id
        header("Location: house_view.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Something Went Wrong!";
        #To go back ro the same form with the same id
        header('Location: house_view.php');
        exit(0);
    }


}
if(isset($_POST['update_house']))
{
    
    $house_id = $_POST['house_id'];
    $house_add = $_POST['house_address'];
    $house_price = (is_numeric($_POST['house_price']) ? (int)$_POST['house_price'] : 0);
    $house_desc = $_POST['house_desc'];
	$house_status = $_POST['house_status'] == true ? '1':'0';
	$house_avail = $_POST['house_avail'] == true ? '1':'0';
	
	$query = "UPDATE house SET house_address='$house_add', house_price='$house_price', house_desc='$house_desc', house_status='$house_status', 
                house_avail='$house_avail' WHERE house_id='$house_id' ";
    $query_run = mysqli_query($con, $query);

    
   if($query_run)
   {
       $_SESSION['message'] = "House Information Has Been Updated Successfully";
       #To go back ro the same form with the same id
       header("Location: house_edit.php?id=".$house_id);
       exit(0);
   }
   else
   {
       $_SESSION['message'] = "Something Went Wrong!";
       #To go back ro the same form with the same id
       header('Location: house_edit.php?id='.$house_id);
       exit(0);
   }
}


if(isset($_POST['add_house']))
{
	$house_add = $_POST['house_address'];
    $house_price = (is_numeric($_POST['house_price']) ? (int)$_POST['house_price'] : 0);
	$house_desc = $_POST['house_desc'];
	$house_status = $_POST['house_status'] == true ? '1':'0';
	$house_avail = $_POST['house_avail'] == true ? '1':'0';
	
	$query = "INSERT INTO house (house_address, house_price, house_desc,house_status,house_avail) 
				VALUES ('$house_add ', '$house_price', '$house_desc', '$house_status', '$house_avail')";
				
	$query_run = mysqli_query($con,$query);

   if($query_run)
    {
        $_SESSION['message'] = "House added Successfully";
        header("Location: house_add.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Something Went Wrong!";
        header("Location: house_add.php");
        exit(0);
    }
}

# To delete user
if(isset($_POST['delete_user']))
{
    $user_id = $_POST['delete_user'];

    $query = "DELETE FROM users WHERE id='$user_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "User Deleted Successfully!";
        header("Location: view-register.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Something Went Wrong!";
        header("Location: view-register.php");
        exit(0);
    }
}

if(isset($_POST['add_user']))
{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $role_as = $_POST['role_as'];
    $status = $_POST['status'] == true ? '1':'0';

    $query = "INSERT INTO users (fname,lname,email,phone,password,role_as,status) 
        VALUES('$fname', '$lname', '$email', '$phone', '$password','$role_as','$status' )";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "User Added Successfully";
        header("Location: view-register.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Something Went Wrong!";
        header("Location: view-register.php");
        exit(0);
    }


}

if(isset($_POST['update_user']))
{
    $user_id = $_POST['user_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $role_as = $_POST['role_as'];
    $status = $_POST['status'] == true ? '1':'0';

    $query = "UPDATE users SET fname='$fname', lname='$lname', email='$email', phone='$phone', password='$password', role_as='$role_as', status='$status'
                WHERE id='$user_id' ";
 
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Updated Successfully";
        header("Location: view-register.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Something Went Wrong!";
        header("Location: view-register.php");
        exit(0);
    }
}

?>