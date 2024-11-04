<?php
    include 'navbar.php';
    include '../connect.php';
    $sql = "SELECT * FROM typemenu";
    $result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TypeMenu Manegement</title>
</head>

<body>
  <div class="container " style="margin-top: 10px;margin-left: 255px;">
    <div class=" card" style="width: 1100px;">
      <div class="card-body">
        <div class="col">
          <h3 class="card-title">TypeMenu Management</h3>
          <div align="left" style="margin-bottom: 10px;">
            <button class="btn bg-success text-light" data-bs-toggle="modal" data-bs-target="#AddTypeMenu">
              <i class="bi bi-plus-square-fill"></i>&nbsp;&nbsp;Add</button>
          </div>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">TypeMenu_ID</th>
              <th scope="col">TypeMenu_Name</th>
              <th scope="col">Management</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
            <tr>
              <th scope="row"><?php echo $row['TypeMenu_ID'] ?></th>
              <td><?php echo $row['TypeMenu_Name'] ?></td>
              <td>
                <a class="btn" href="#" data-bs-toggle="modal" style="background-color: SkyBlue;"
                  data-bs-target="#EditTypemenu-<?php echo $row['TypeMenu_ID'] ?>">
                  <i class="bi bi-pencil-square" style="color: white;"></i>
                </a>
                <a class="btn btn-danger" href="Del_TypeMenu.php?TypeMenu_ID=<?php echo $row['TypeMenu_ID'] ?>"><i
                    class="bi bi-trash-fill"></i></a>
              </td>
            </tr>

            <?php } ?>
          </tbody>
        </table>
        <?php
                        $modal_sql = "SELECT * FROM typemenu";
                        $modal_result = $con->query($modal_sql);
                        while ($row = mysqli_fetch_assoc($modal_result)) {
                    ?>

        <div class="modal fade" id="EditTypemenu-<?php echo $row['TypeMenu_ID'] ?>" tabindex="-1"
          aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header" style="background-color: SkyBlue;">
                <h5 class=" modal-title text-white" id="exampleModalLabel">แก้ไขข้อมูล ประเภทเมนู</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="Edit_TypeMenu.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">TypeMenu_ID</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id='Type_id' name="Type_id"
                        value="<?php echo $row['TypeMenu_ID'] ?>" disabled>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">TypeMenu_Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id='Type_name' name="Type_name"
                        value="<?php echo $row['TypeMenu_Name'] ?>">
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn bg-danger text-white" name="Editsubmit"
                  value="<?php echo $row['TypeMenu_ID']?>">แก้ไขข้อมูล</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

              </div>
              </form>
            </div>
          </div>
        </div>
        <!--- Edit modal ----->

        <?php 
                        } 
                        ?>
        <div class="modal fade" id="AddTypeMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header " style="background-color: SkyBlue;">
                <h5 class="modal-title text-white" id="exampleModalLabel">เพิ่มข้อมูล ประเภทเมนู</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="Add_TypeMenu.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">TypeMenu_ID</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id='Type_id' name="Type_id" value="">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">TypeMenu_Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id='Type_name' name="Type_name" value="">
                    </div>
                  </div>
                  <!--- End dropdownlist ----->
                  <div class="modal-footer">
                    <button type="submit" class="btn bg-danger text-white" name="Addsubmit"
                      value="">เพิ่มข้อมูล</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>

</html>