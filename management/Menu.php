<?php
    include 'navbar.php';
    include '../connect.php';
    $sql = "SELECT menu.Menu_ID,menu.Menu_Name,typemenu.TypeMenu_Name,menu.Menu_Unit,menu.Menu_Price,menu.Menu_Amount,supplier.Sup_Name as Supplier_Name FROM menu 
            JOIN typemenu ON menu.TypeMenu_ID = typemenu.TypeMenu_ID
            JOIN supplier ON menu.Sup_ID = supplier.Sup_ID ORDER BY menu.Menu_ID ASC";
    $result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu Manegement</title>
</head>

<body>
  <div class="container " style="margin-top: 10px;margin-left: 255px;">
    <div class=" card" style="width: 1100px;">
      <div class="card-body">
        <div class="col">
          <h3 class="card-title">Menu Management</h3>
          <div align="left" style="margin-bottom: 10px;">
            <button class="btn bg-success text-light" data-bs-toggle="modal" data-bs-target="#AddMenu">
              <i class="bi bi-plus-square-fill"></i>&nbsp;&nbsp;Add</button>
          </div>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Menu_ID</th>
              <th scope="col">Menu_Name</th>
              <th scope="col">TypeMenu_Name</th>
              <th scope="col">Menu_Unit</th>
              <th scope="col">Menu_Price</th>
              <th scope="col">Menu_Amount</th>
              <th scope="col">Supplier_Name</th>
              <th scope="col">Management</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
            <tr>
              <th scope="row"><?php echo $row['Menu_ID'] ?></th>
              <td><?php echo $row['Menu_Name'] ?></td>
              <td><?php echo $row['TypeMenu_Name'] ?></td>
              <td><?php echo $row['Menu_Unit'] ?></td>
              <td><?php echo $row['Menu_Price'] ?></td>
              <td><?php echo $row['Menu_Amount'] ?></td>
              <td><?php echo $row['Supplier_Name'] ?></td>
              <td>
                <a class="btn" href="#" data-bs-toggle="modal" style="background-color: SkyBlue;"
                  data-bs-target="#EditMenu-<?php echo $row['Menu_ID'] ?>">
                  <i class="bi bi-pencil-square" style="color: white;"></i>
                </a>
                <a class="btn btn-danger" href="Del_Menu.php?Menu_ID=<?php echo $row['Menu_ID'] ?>"><i
                    class="bi bi-trash-fill"></i></a>
              </td>
            </tr>

            <?php } ?>
          </tbody>
        </table>
        <?php
        $modal_sql = "SELECT * FROM menu";
        $modal_result = $con->query($modal_sql);
        while ($row = mysqli_fetch_assoc($modal_result)) {
            echo '<!-- Debug: Current Table Menu_ID: ' . $row['Menu_ID'] . ' -->'; 
        ?>
        <div class="modal fade" id="EditMenu-<?php echo $row['Menu_ID'] ?>" tabindex="-1"
          aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header" style="background-color: SkyBlue;">
                <h5 class="modal-title text-white" id="exampleModalLabel">แก้ไขข้อมูล เมนู</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="Edit_Menu.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Menu_ID</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Menu_ID" value="<?php echo $row['Menu_ID'] ?>"
                        disabled>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Menu_Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Menu_Name" value="<?php echo $row['Menu_Name'] ?>">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">TypeMenu_Name</label>
                    <div class="col-sm-9">
                      <select class="form-select" id="TypeMenu_Name" name="TypeMenu_Name">
                        <?php
                            $typemenu_sql = "SELECT * FROM typemenu";
                            $typemenu_result = $con->query($typemenu_sql);
                            while ($typemenu_row = mysqli_fetch_assoc($typemenu_result)) {
                              echo '<!-- Debug: Option TypeMenu_ID: ' . $typemenu_row['TypeMenu_ID'] . ' -->';
                              
                              $selected = ($row['TypeMenu_ID'] == $typemenu_row['TypeMenu_ID']) ? 'selected' : '';
                              echo '<option value="' . $typemenu_row['TypeMenu_ID'] . '" ' . $selected . '>' . $typemenu_row['TypeMenu_Name'] . '</option>';
                            }
                            ?>
                      </select>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Menu_Unit</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Menu_Unit" value="<?php echo $row['Menu_Unit'] ?>">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Menu_Price</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Menu_Price"
                        value="<?php echo $row['Menu_Price'] ?>">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Menu_Amount</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Menu_Amount"
                        value="<?php echo $row['Menu_Amount'] ?>">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Supplier_Name</label>
                    <div class="col-sm-9">
                      <select class="form-select" id="Supplier_Name" name="Supplier_Name">
                        <?php
                            $supplier_sql = "SELECT * FROM supplier";
                            $supplier_result = $con->query($supplier_sql);
                            while ($supplier_row = mysqli_fetch_assoc($supplier_result)) {
                              echo '<!-- Debug: Option Sup_ID: ' . $supplier_row['Sup_ID'] . ' -->';
                              
                              $selected = ($row['Sup_ID'] == $supplier_row['Sup_ID']) ? 'selected' : '';
                              echo '<option value="' . $supplier_row['Sup_ID'] . '" ' . $selected . '>' . $supplier_row['Sup_name'] . '</option>';
                            }
                            ?>
                      </select>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn bg-danger text-white" name="Editsubmit"
                      value="<?php echo $row['Menu_ID'] ?>">แก้ไขข้อมูล</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="AddMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header" style="background-color: SkyBlue;">
                <h5 class="modal-title text-white" id="exampleModalLabel">เพิ่ม เมนู</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="Add_Menu.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Menu_ID</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Menu_ID">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Menu_Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Menu_Name">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">TypeMenu_Name</label>
                    <div class="col-sm-9">
                      <select class="form-select" id="TypeMenu_Name" name="TypeMenu_Name">
                        <?php
                            $typemenu_sql = "SELECT * FROM typemenu";
                            $typemenu_result = $con->query($typemenu_sql);
                            while ($typemenu_row = mysqli_fetch_assoc($typemenu_result)) {
                              echo '<!-- Debug: Option TypeMenu_ID: ' . $typemenu_row['TypeMenu_ID'] . ' -->';
                              
                              $selected = ($row['TypeMenu_ID'] == $typemenu_row['TypeMenu_ID']) ? 'selected' : '';
                              echo '<option value="' . $typemenu_row['TypeMenu_ID'] . '" ' . $selected . '>' . $typemenu_row['TypeMenu_Name'] . '</option>';
                            }
                            ?>
                      </select>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Menu_Unit</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Menu_Unit" ">
                    </div>
                  </div>
                  <div class=" mb-3 row">
                      <label class="label col-sm-3 com-form-label">Menu_Price</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="Menu_Price" ">
                      </div>
                    </div>
                    <div class=" mb-3 row">
                        <label class="label col-sm-3 com-form-label">Menu_Amount</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="Menu_Amount" ">
                        </div>
                      </div>
                      <div class=" mb-3 row">
                          <label class="label col-sm-3 com-form-label">Supplier_Name</label>
                          <div class="col-sm-9">
                            <select class="form-select" id="Supplier_Name" name="Supplier_Name">
                              <?php
                            $supplier_sql = "SELECT * FROM supplier";
                            $supplier_result = $con->query($supplier_sql);
                            while ($supplier_row = mysqli_fetch_assoc($supplier_result)) {
                              echo '<!-- Debug: Option Sup_ID: ' . $supplier_row['Sup_ID'] . ' -->';
                              
                              $selected = ($row['Sup_ID'] == $supplier_row['Sup_ID']) ? 'selected' : '';
                              echo '<option value="' . $supplier_row['Sup_ID'] . '" ' . $selected . '>' . $supplier_row['Sup_name'] . '</option>';
                            }
                            ?>
                            </select>
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
        <?php
        }
        ?>

      </div>
    </div>
  </div>
</body>

</html>