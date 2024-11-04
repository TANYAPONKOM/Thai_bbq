<?php
    include 'navbar.php';
    include '../connect.php';
    $sql = "SELECT buy.Buy_ID,buy.Buy_Date,buy.Buy_TotalPrice,employee.Emp_Name FROM buy 
            JOIN employee ON buy.Emp_ID = employee.Emp_ID
            ORDER BY buy.Buy_ID,buy.Buy_Date ASC";
    $result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buy Manegement</title>
</head>

<body>
  <div class="container " style="margin-top: 10px;margin-left: 255px;">
    <div class=" card" style="width: 1100px;">
      <div class="card-body">
        <div class="col">
          <h3 class="card-title">Buy Management</h3>
          <div align="left" style="margin-bottom: 10px;">
            <button class="btn bg-success text-light" data-bs-toggle="modal" data-bs-target="#AddBuy">
              <i class="bi bi-plus-square-fill"></i>&nbsp;&nbsp;Add</button>
          </div>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Buy_ID</th>
              <th scope="col">Buy_Date</th>
              <th scope="col">TotalPrice</th>
              <th scope="col">Emp_Name</th>
              <th scope="col">Management</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
            <tr>
              <th scope="row"><?php echo $row['Buy_ID'] ?></th>
              <td><?php echo $row['Buy_Date'] ?></td>
              <td><?php echo $row['Buy_TotalPrice'] ?></td>
              <td><?php echo $row['Emp_Name'] ?></td>
              <td>
                <a class="btn" href="#" data-bs-toggle="modal" style="background-color: SkyBlue;"
                  data-bs-target="#EditBuy-<?php echo $row['Buy_ID'] ?>">
                  <i class="bi bi-pencil-square" style="color: white;"></i>
                </a>
                <a class="btn btn-danger" href="Del_Buy.php?Buy_ID=<?php echo $row['Buy_ID'] ?>"><i
                    class="bi bi-trash-fill"></i></a>
              </td>
            </tr>

            <?php } ?>
          </tbody>
        </table>
        <?php
        $modal_sql = "SELECT * FROM buy ";
        $modal_result = $con->query($modal_sql);
        while ($row = mysqli_fetch_assoc($modal_result)) {
        echo '<!-- Debug: Current Table Buy_ID: ' . $row['Buy_ID'] . ' -->'; 
        ?>
        <div class="modal fade" id="EditBuy-<?php echo $row['Buy_ID'] ?>" tabindex="-1"
          aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header" style="background-color: SkyBlue;">
                <h5 class="modal-title text-white" id="exampleModalLabel">แก้ไขข้อมูล การซื้อ</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="Edit_Buy.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Buy_ID</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Buy_ID" value="<?php echo $row['Buy_ID'] ?>"
                        disabled>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Buy_Date</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Buy_Date" value="<?php echo $row['Buy_Date'] ?>">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Buy_TotalPrice</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Buy_TotalPrice"
                        value="<?php echo $row['Buy_TotalPrice'] ?>">
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
                      value="<?php echo $row['Buy_ID'] ?>">แก้ไขข้อมูล</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="AddBuy" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header" style="background-color: SkyBlue;">
                <h5 class="modal-title text-white" id="exampleModalLabel">เพิ่ม การซื้อ</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="Add_Buy.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Buy_ID</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Buy_ID">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Buy_Date</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Buy_Date">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Buy_TotalPrice</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Buy_TotalPrice">
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