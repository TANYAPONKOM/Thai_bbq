<?php
    include 'navbar.php';
    include '../connect.php';
    $sql = "SELECT receipt.Receipt_ID,receipt.Table_ID,receipt.Re_TotalPrice,receipt.Re_Receive,receipt.Re_Change,receipt.Receipt_Date,employee.Emp_Name FROM receipt 
            JOIN employee ON receipt.Emp_ID = employee.Emp_ID
            ORDER BY Receipt_Date,Receipt_ID ASC";
    $result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Receipt Manegement</title>
</head>

<body>
  <div class="container " style="margin-top: 10px;margin-left: 255px;">
    <div class=" card" style="width: 1100px;">
      <div class="card-body">
        <div class="col">
          <h3 class="card-title">Receipt Management</h3>
          <div align="left" style="margin-bottom: 10px;">
            <button class="btn bg-success text-light" data-bs-toggle="modal" data-bs-target="#AddReceipt">
              <i class="bi bi-plus-square-fill"></i>&nbsp;&nbsp;Add</button>
          </div>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Receipt_ID</th>
              <th scope="col">Table_ID</th>
              <th scope="col">TotalPrice</th>
              <th scope="col">Receive</th>
              <th scope="col">Change</th>
              <th scope="col">Receipt_Date</th>
              <th scope="col">Emp_Name</th>
              <th scope="col">Management</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
            <tr>
              <th scope="row"><?php echo $row['Receipt_ID'] ?></th>
              <td><?php echo $row['Table_ID'] ?></td>
              <td><?php echo $row['Re_TotalPrice'] ?></td>
              <td><?php echo $row['Re_Receive'] ?></td>
              <td><?php echo $row['Re_Change'] ?></td>
              <td><?php echo $row['Receipt_Date'] ?></td>
              <td><?php echo $row['Emp_Name'] ?></td>
              <td>
                <a class="btn" href="#" data-bs-toggle="modal" style="background-color: SkyBlue;"
                  data-bs-target="#EditReceipt-<?php echo $row['Receipt_ID'] ?>">
                  <i class="bi bi-pencil-square" style="color: white;"></i>
                </a>
                <a class="btn btn-danger" href="Del_Receipt.php?Receipt_ID=<?php echo $row['Receipt_ID'] ?>"><i
                    class="bi bi-trash-fill"></i></a>
              </td>
            </tr>

            <?php } ?>
          </tbody>
        </table>
        <?php
        $modal_sql = "SELECT * FROM receipt ";
        $modal_result = $con->query($modal_sql);
        while ($row = mysqli_fetch_assoc($modal_result)) {
        echo '<!-- Debug: Current Table Receipt_ID: ' . $row['Receipt_ID'] . ' -->'; 
        ?>
        <div class="modal fade" id="EditReceipt-<?php echo $row['Receipt_ID'] ?>" tabindex="-1"
          aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header" style="background-color: SkyBlue;">
                <h5 class="modal-title text-white" id="exampleModalLabel">แก้ไขข้อมูล ใบเสร็จ</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="Edit_Receipt.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Receipt_ID</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Receipt_ID" value="<?php echo $row['Receipt_ID'] ?>"
                        disabled>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Table_ID</label>
                    <div class="col-sm-9">
                      <select class="form-select" id="Table_ID" name="Table_ID">
                        <?php
                            $typemenu_sql = "SELECT * FROM tables  ORDER BY Table_ID ASC";
                            $typemenu_result = $con->query($typemenu_sql);
                            while ($typemenu_row = mysqli_fetch_assoc($typemenu_result)) {
                              echo '<!-- Debug: Option Table_ID: ' . $typemenu_row['Table_ID'] . ' -->';
                              
                              $selected = ($row['Table_ID'] == $typemenu_row['Table_ID']) ? 'selected' : '';
                              echo '<option value="' . $typemenu_row['Table_ID'] . '" ' . $selected . '>' . $typemenu_row['Table_ID'] . '</option>';
                            }
                            ?>
                      </select>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">TotalPrice</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Re_TotalPrice"
                        value="<?php echo $row['Re_TotalPrice'] ?>">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Re_Receive</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Re_Receive"
                        value="<?php echo $row['Re_Receive'] ?>">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Re_Change</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Re_Change" value="<?php echo $row['Re_Change'] ?>">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Receipt_Date</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Receipt_Date"
                        value="<?php echo $row['Receipt_Date'] ?>">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Emp_Name</label>
                    <div class="col-sm-9">
                      <select class="form-select" id="Emp_Name" name="Emp_Name">
                        <?php
                            $typemenu_sql = "SELECT * FROM  employee  ORDER BY Emp_ID ASC";
                            $typemenu_result = $con->query($typemenu_sql);
                            while ($typemenu_row = mysqli_fetch_assoc($typemenu_result)) {
                              echo '<!-- Debug: Option Emp_ID: ' . $typemenu_row['Emp_ID'] . ' -->';
                              
                              $selected = ($row['Emp_ID'] == $typemenu_row['Emp_ID']) ? 'selected' : '';
                              echo '<option value="' . $typemenu_row['Emp_ID'] . '" ' . $selected . '>' . $typemenu_row['Emp_Name'] . '</option>';
                            }
                            ?>
                      </select>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn bg-danger text-white" name="Editsubmit"
                      value="<?php echo $row['Receipt_ID'] ?>">แก้ไขข้อมูล</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="AddReceipt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header" style="background-color: SkyBlue;">
                <h5 class="modal-title text-white" id="exampleModalLabel">เพิ่ม ใบเสร็จ</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="Add_Receipt.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Receipt_ID</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Receipt_ID">
                    </div>
                  </div>
                  <div class=" mb-3 row">
                    <label class="label col-sm-3 com-form-label">Table_ID</label>
                    <div class="col-sm-9">
                      <select class="form-select" id="Table_ID" name="Table_ID">
                        <?php
                            $typemenu_sql = "SELECT * FROM tables  ORDER BY Table_ID ASC";
                            $typemenu_result = $con->query($typemenu_sql);
                            while ($typemenu_row = mysqli_fetch_assoc($typemenu_result)) {
                              echo '<!-- Debug: Option Table_ID: ' . $typemenu_row['Table_ID'] . ' -->';
                              
                              $selected = ($row['Table_ID'] == $typemenu_row['Table_ID']) ? 'selected' : '';
                              echo '<option value="' . $typemenu_row['Table_ID'] . '" ' . $selected . '>' . $typemenu_row['Table_ID'] . '</option>';
                            }
                            ?>
                      </select>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">TotalPrice</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Re_TotalPrice">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Re_Receive</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Re_Receive">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Re_Change</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Re_Change">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Receipt_Date</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Receipt_Date">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Emp_Name</label>
                    <div class="col-sm-9">
                      <select class="form-select" id="Emp_Name" name="Emp_Name">
                        <?php
                            $typemenu_sql = "SELECT * FROM  employee  ORDER BY Emp_ID ASC";
                            $typemenu_result = $con->query($typemenu_sql);
                            while ($typemenu_row = mysqli_fetch_assoc($typemenu_result)) {
                              echo '<!-- Debug: Option Emp_ID: ' . $typemenu_row['Emp_ID'] . ' -->';
                              
                              $selected = ($row['Emp_ID'] == $typemenu_row['Emp_ID']) ? 'selected' : '';
                              echo '<option value="' . $typemenu_row['Emp_ID'] . '" ' . $selected . '>' . $typemenu_row['Emp_Name'] . '</option>';
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