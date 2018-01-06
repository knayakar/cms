<?php include "includes/admin_header.php" ?>


<body>

    <div id="wrapper">

        <!-- Navigation -->
        
<?php include "includes/admin_navigation.php" ?>
        
        <div id="page-wrapper">

            <div class="container-fluid">
 
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome Admin
                            <small>Categories Section</small>
                        </h1>
                         
                         <div class="col-xs-6">
                             <form action="" method="post">
                                 <div class="form-group">
                                    <label for="cat-title">Add Category</label>
                                     <input type="text" class="form-control" name="cat_title">
                                 </div>
                                 <div class="form-group">
                                     <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
<?php   // Add new content to the table
    insertContent();
?>
                                 </div>           
                             </form>
                             
                             <form action="" method="post">
                                
<?php   // Load selected content into update field from table and update it in the database

    loadContent();
    
?>                               
                             </form>                            
                         </div>
                         
                         <div class="col-xs-6 ">
                             <table class="table table-bordered table-hover">
                                  <thead class="thead-dark">
                                    <tr>
                                      <th scope="col">Id</th>
                                      <th scope="col">Category Title</th>
                                    </tr>
                                  </thead>
                                  <tbody> 
<?php   //Load all contents from database into the table dynamically 
    
    loadTable();

                                      
    //  Delete the contents of the table
                                      
    deleteContent();
        
?>
                                  </tbody>
                                </table>
                         </div>
                         
                    </div>
                </div>
                <!-- /.row -->
 
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        

  
<?php include "includes/admin_footer.php"?>