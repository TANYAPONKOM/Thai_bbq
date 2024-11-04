<?php
    include 'navbar.php';
    include '../connect.php';
    $sql = "SELECT * FROM supplier";
    $result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Supplier Manegement</title>
</head>

<body>
  <div class="container " style="margin-top: 10px;margin-left: 255px;">
    <div class=" card" style="width: 1100px;">
      <div class="card-body">
        <div class="col">
          <h3 class="card-title">Supplier Management</h3>
          <div align="left" style="margin-bottom: 10px;">
            <button class="btn bg-success text-light" data-bs-toggle="modal" data-bs-target="#AddSupplier">
              <i class="bi bi-plus-square-fill"></i>&nbsp;&nbsp;Add</button>
          </div>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Supplier_ID</th>
              <th scope="col">Supplier_Name</th>
              <th scope="col">Supplier_Address</th>
              <th scope="col">Supplier_Tell</th>
              <th scope="col">Management</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
            <tr>
              <th scope="row"><?php echo $row['Sup_ID'] ?></th>
              <td><?php echo $row['Sup_name'] ?></td>
              <td><?php echo $row['Sup_address'] ?></td>
              <td><?php echo $row['Sup_tell'] ?></td>
              <td>
                <a class="btn" href="#" data-bs-toggle="modal" style="background-color: SkyBlue;"
                  data-bs-target="#EditSupplier-<?php echo $row['Sup_ID'] ?>">
                  <i class="bi bi-pencil-square" style="color: white;"></i>
                </a>
                <a class="btn btn-danger" href="Del_Supplier.php?Sup_ID=<?php echo $row['Sup_ID'] ?>"><i
                    class="bi bi-trash-fill"></i></a>
              </td>
            </tr>

            <?php } ?>
          </tbody>
        </table>
        <?php
                        $modal_sql = "SELECT * FROM supplier";
                        $modal_result = $con->query($modal_sql);
                        while ($row = mysqli_fetch_assoc($modal_result)) {
                    ?>

        <div class="modal fade" id="EditSupplier-<?php echo $row['Sup_ID'] ?>" tabindex="-1"
          aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header" style="background-color: SkyBlue;">
                <h5 class=" modal-title text-white" id="exampleModalLabel">แก้ไขข้อมูล ____</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="Edit_Supplier.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Supplier_ID</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id='Sup_id' name="Sup_id"
                        value="<?php echo $row['Sup_ID'] ?>" disabled>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Supplier_Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id='Sup_name' name="Sup_name"
                        value="<?php echo $row['Sup_name'] ?>">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Supplier_Address</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id='Sup_address' name="Sup_address"
                        value="<?php echo $row['Sup_address'] ?>">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Supplier_Tell</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id='Sup_tell' name="Sup_tell"
                        value="<?php echo $row['Sup_tell'] ?>">
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn bg-danger text-white" name="Editsubmit"
                  value="<?php echo $row['Sup_ID']?>">แก้ไขข้อมูล ___</button>
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
        <div class="modal fade" id="AddSupplier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header " style="background-color: SkyBlue;">
                <h5 class="modal-title text-white" id="exampleModalLabel">เพิ่มข้อมูล ____</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="Add_Supplier.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Supplier_ID</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id='Sup_id' name="Sup_id" value="">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Supplier_Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id='Sup_name' name="Sup_name" value="">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Supplier_Address</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id='Sup_address' name="Sup_address" value="">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Supplier_Tell</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id='Sup_tell' name="Sup_tell" value="">
                    </div>
                  </div>
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