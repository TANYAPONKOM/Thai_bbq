<?php
    include 'navbar.php';
    include '../connect.php';
    $sql = "SELECT employee.Emp_ID,employee.Emp_Name,employee.Username,employee.Password,position.Position_Name FROM employee 
            JOIN position ON employee.Position_ID = position.Position_ID ORDER BY employee.Emp_ID ASC";
    $result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Manegement</title>
</head>

<body>
  <div class="container " style="margin-top: 10px;margin-left: 255px;">
    <div class=" card" style="width: 1100px;">
      <div class="card-body">
        <div class="col">
          <h3 class="card-title">Employee Management</h3>
          <div align="left" style="margin-bottom: 10px;">
            <button class="btn bg-success text-light" data-bs-toggle="modal" data-bs-target="#AddEmployee">
              <i class="bi bi-plus-square-fill"></i>&nbsp;&nbsp;Add</button>
          </div>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Emp_ID</th>
              <th scope="col">Emp_Name</th>
              <th scope="col">Username</th>
              <th scope="col">Password</th>
              <th scope="col">Position_Name</th>
              <th scope="col">Management</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
            <tr>
              <th scope="row"><?php echo $row['Emp_ID'] ?></th>
              <td><?php echo $row['Emp_Name'] ?></td>
              <td><?php echo $row['Username'] ?></td>
              <td><?php echo $row['Password'] ?></td>
              <td><?php echo $row['Position_Name'] ?></td>
              <td>
                <a class="btn" href="#" data-bs-toggle="modal" style="background-color: SkyBlue;"
                  data-bs-target="#EditEmployee-<?php echo $row['Emp_ID'] ?>">
                  <i class="bi bi-pencil-square" style="color: white;"></i>
                </a>
                <a class="btn btn-danger" href="Del_Employee.php?Emp_ID=<?php echo $row['Emp_ID'] ?>"><i
                    class="bi bi-trash-fill"></i></a>
              </td>
            </tr>

            <?php } ?>
          </tbody>
        </table>
        <?php
        $modal_sql = "SELECT * FROM employee ";
        $modal_result = $con->query($modal_sql);
        while ($row = mysqli_fetch_assoc($modal_result)) {
        echo '<!-- Debug: Current Table Emp_ID: ' . $row['Emp_ID'] . ' -->'; 
        ?>
        <div class="modal fade" id="EditEmployee-<?php echo $row['Emp_ID'] ?>" tabindex="-1"
          aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header" style="background-color: SkyBlue;">
                <h5 class="modal-title text-white" id="exampleModalLabel">แก้ไขข้อมูล พนักงาน</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="Edit_Employee.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Emp_ID</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Emp_ID" value="<?php echo $row['Emp_ID'] ?>"
                        disabled>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Emp_Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Emp_Name" value="<?php echo $row['Emp_Name'] ?>">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Username</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Username" value="<?php echo $row['Username'] ?>">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Password</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Password" value="<?php echo $row['Password'] ?>">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Position_Name</label>
                    <div class="col-sm-9">
                      <select class="form-select" id="Position_Name" name="Position_Name">
                        <?php
                            $position_sql = "SELECT * FROM position";
                            $position_result = $con->query($position_sql);
                            while ($position_row = mysqli_fetch_assoc($position_result)) {
                              echo '<!-- Debug: Option Position_ID: ' . $position_row['Position_ID'] . ' -->';
                              
                              $selected = ($row['Position_ID'] == $position_row['Position_ID']) ? 'selected' : '';
                              echo '<option value="' . $position_row['Position_ID'] . '" ' . $selected . '>' . $position_row['Position_Name'] . '</option>';
                            }
                            ?>
                      </select>
                    </div>
                  </div>

                  <div class="modal-footer">
                    <button type="submit" class="btn bg-danger text-white" name="Editsubmit"
                      value="<?php echo $row['Emp_ID'] ?>">แก้ไขข้อมูล</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="AddEmployee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header" style="background-color: SkyBlue;">
                <h5 class="modal-title text-white" id="exampleModalLabel">เพิ่ม พนักงาน</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="Add_Employee.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Emp_ID</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Emp_ID" ">
                    </div>
                  </div>
                  <div class=" mb-3 row">
                      <label class="label col-sm-3 com-form-label">Emp_Name</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="Emp_Name" ">
                    </div>
                  </div>
                  <div class=" mb-3 row">
                        <label class="label col-sm-3 com-form-label">Username</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="Username" ">
                      </div>
                    </div>
                    <div class=" mb-3 row">
                          <label class="label col-sm-3 com-form-label">Password</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="Password">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label class="label col-sm-3 com-form-label">Position_Name</label>
                          <div class="col-sm-9">
                            <select class="form-select" id="Position_Name" name="Position_Name">
                              <?php
                            $position_sql = "SELECT * FROM position";
                            $position_result = $con->query($position_sql);
                            while ($position_row = mysqli_fetch_assoc($position_result)) {
                              echo '<!-- Debug: Option Position_ID: ' . $position_row['Position_ID'] . ' -->';
                              
                              $selected = ($row['Position_ID'] == $position_row['Position_ID']) ? 'selected' : '';
                              echo '<option value="' . $position_row['Position_ID'] . '" ' . $selected . '>' . $position_row['Position_Name'] . '</option>';
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