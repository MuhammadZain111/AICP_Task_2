<!-- -----------------------Here I have to Create Notes Application------------------------------ -->


<?php
// INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'insert books', 'go to buy the books', current_timestamp());
$insert=false;
$update=false;
$delete=false;

$servername="localhost";
$username="root";
$password="";
$database="pnotes";

$conn=mysqli_connect($servername, $username, $password, $database);
if (!$conn) 
{
die("Sorry We Failed to establish the Connnection" .mysqli_connect_error());
}
if (isset($_GET['delete']))
{
  $sno=$_GET['delete'];
  $delete=true;  
  $sql="DELETE  FROM  `notes` WHERE `sno`=$sno";
   $result=mysqli_query($conn,$sql);
}
if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    if (isset($_POST['snoEdit']))
    {
      $sno=$_POST["snoEdit"];
      $title=$_POST["titleEdit"];
      $description=$_POST["descriptionEdit"]; 
      $sql="UPDATE `notes` SET `title`='$title' , `description`='$description' WHERE `notes`.`sno`=$sno";
      $result = mysqli_query($conn, $sql);
      if ($result)
      {
        $update=true;
      }
      else
      {
        echo "We could not update the values";
      }

    }
    else{
    $title=$_POST["title"];
    $description=$_POST["description"];
    $sql="INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')";
    $result = mysqli_query($conn, $sql);
   if($result)
   {
    $insert=true;
   }
   else
   {
   echo "The record is not inserted Successlly".mysqli_error($conn);
   }
  }
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Notes App</title>
  
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css">
    
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- DataTables JavaScript -->
    <script src="//cdn.datatables.net/2.0.1/js/dataTables.min.js"></script>

    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19" rel="stylesheet">

  <link rel="stylesheet"
      href="styles.css"  >



  </head>
<body>



  <!------here the code for the main container ------>

<di class="fitstcontainer  bg-blue-200 w-full h-32    "></di>

<!-- Modal -->
 <div class="modal fade  bg-slate-200  " id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  
 <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit This Note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      
<!-- here  the form code starts -->

<div class="modal-body  bg-black">
      
      <form action="/Crud/index.php"  method="post">

        <input type="hidden" name="snoEdit" id="snoEdit"> 

<!--         
-- Here is the code  which will  appear  in the Popup  when we edit the Notes    ----->

        <div class="form-group  w-32 bg-redd   ">
          <label for="title">Note Title to add</label>
          <input type="text " class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp" placeholder="Enter title">                
        </div>
       
        <div class="form-group">
            <label for="desc">Notes Description</label>
            <textarea class="form-control" id="descriptionEdit" rows="3" name="descriptionEdit"></textarea>
          </div> 

        <button type="submit" class="btn btn-primary">Save Changes</button>
  
      </div>
    
    </div>

    </form> 


  </div>
</div>


  <!-- ----her the code for the Navbar starts -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark     ">
    
    <div class="heading">
      
      <div class="noteslogo"><img  src="notes.png" rel="noteslogo" ></div>
    
    <a class="navbar-brand" href="#">My Notes</a>
    
    </div>
<!-- 
  ----Here is the code for the toogle button-----   
     -->
  
    <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#"
              >Home<span class="sr-only">(current)</span></a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input
            class="form-control mr-sm-2"
            type="search"
            placeholder="Search"
            aria-label="Search"
          />
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
            Search
          </button>
        </form>
      </div>
    </nav>


<!-- ---Here the code for the php starts  -->


<?php

if($insert)
{
  echo  "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your note has been inserted successfully
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>×</span>
  </button>
</div>";

}
?>

<?php

if($update)
{
  echo  "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your note has been updated successfully
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>×</span>
  </button>
</div>";
}

?>

<?php


if($delete)
{
  echo  "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your note has been Deleted successfully
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>×</span>
  </button>
</div>";
}
?>



<div class="notescontainer">

    <div class="container first-container py-5 w-full  h-auto  bg-red-500  mt-4    ">

    <form action="/Crud/index.php"   method="post">

  
   <!-- here is the code for the title area--------->

        <div class="form-group   text-red     ">
          <label for="title" class="subheading"      >Note Title</label>
          <input type="text " class="form-control" id="title" name="title" aria-describedby="emailHelp" placeholder="Enter title"        required >                
        </div>

<!-- 
   Here  is the code for the description  section -->
        
        <div class="form-group    ">
            <label for="desc"  class="subheading" >Notes Description</label>
            <textarea class="form-control" id="description" rows="3" name="description"  placeholder="Enter the note Description" required ></textarea>
          </div> 

        

       <div class="submitbtn">      
       <div class="submitlogo m-2">
        <img  src="edit.png"  rel="stylesheet">
        </div>
        <button type="submit"   class="btn
        addbtn ">ADD NOTE
        </button>

      </div>       
      <div>
      </div> 
      </div>
      </form>
      
      
</div>

<!-- ---here is the code for the table--- -->

<div class="container mt-4 table_container  pt-4  ">

<table class="table" id=myTable>
  <thead>
    <tr>
      <th scope="col" class="tableheading"   >S.No</th>
      <th scope="col" class="tableheading" >Title</th>
      <th scope="col"  class="tableheading"> Description</th>
      <th scope="col"  class="tableheading" >Actions</th>
    </tr>
  </thead>

<tbody>

</div>




<?php

$sql="SELECT * FROM `notes`";

$result=mysqli_query($conn,$sql);
$sno=0;
while($row=mysqli_fetch_assoc($result))
 {
  $sno=$sno+1;
 echo "<tr>
   <th scope='row'>". $sno ."</th>
   <td>". $row['title'] . "</td>
   <td>". $row['description'] . "</td>
   <td><button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button></td>
 </tr>";
}
 
?>

</tbody>
</table>

</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- 
    <script
      src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"
    ></script> 

    <script src="//cdn.datatables.net/2.0.1/js/dataTables.min.js"></script> -->


    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19" rel="stylesheet">

<script>    
  $(document).ready(function()
   {
   $('#myTable').DataTable();
   });
  
  </script>   

<script>
  edits=document.getElementsByClassName('edit');
  Array.from(edits).forEach((element)=>{
  element.addEventListener("click",(e)=>{
   console.log("edit",);
  tr=e.target.parentNode.parentNode;
  title=tr.getElementsByTagName("td")[0].innerText;
  description=tr.getElementsByTagName("td")[1].innerText;
  console.log(title,description);
  titleEdit.value=title;
  descriptionEdit.value=description;
  snoEdit.value=e.target.id;
  console.log(e.target.id);
  $('#editModal').modal('toggle');

  })
  })

  deletes=document.getElementsByClassName('delete');
  Array.from(deletes).forEach((element)=>{
  element.addEventListener("click",(e)=>{
   console.log("edit",);
  sno=e.target.id.substr(1,);
  if(confirm("Are you sure you want to delete it? "))
  {
    console.log("yes");
    window.location=`/Crud/index.php?delete=${sno}`;

  }
 else
 {
  console.log("no");
 }

})
})



</script>


  </body>
</html>
