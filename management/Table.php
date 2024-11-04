<?php
    include 'navbar.php';
    include '../connect.php';
    $sql = "SELECT tables.Table_ID,status.Status_Name FROM tables JOIN status ON tables.Status_ID = status.Status_ID
            ORDER BY tables.Table_ID ASC;";
    $result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Table Manegement</title>
</head>

<body>
  <div class="container " style="margin-top: 10px;margin-left: 255px;">
    <div class=" card" style="width: 1100px;">
      <div class="card-body">
        <div class="col">
          <h3 class="card-title">Table Management</h3>
          <div align="left" style="margin-bottom: 10px;">
            <button class="btn bg-success text-light" data-bs-toggle="modal" data-bs-target="#AddTable">
              <i class="bi bi-plus-square-fill"></i>&nbsp;&nbsp;Add</button>
          </div>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Table_ID</th>
              <th scope="col">Status_Name</th>
              <th scope="col">Management</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
            <tr>
              <th scope="row"><?php echo $row['Table_ID'] ?></th>
              <td><?php echo $row['Status_Name'] ?></td>
              <td>
                <a class="btn" href="#" data-bs-toggle="modal" style="background-color: SkyBlue;"
                  data-bs-target="#EditTable-<?php echo $row['Table_ID'] ?>">
                  <i class="bi bi-pencil-square" style="color: white;"></i>
                </a>
                <a class="btn btn-danger" href="Del_Table.php?Table_ID=<?php echo $row['Table_ID'] ?>"><i
                    class="bi bi-trash-fill"></i></a>
              </td>
            </tr>

            <?php } ?>
          </tbody>
        </table>
        <?php
        $modal_sql = "SELECT tables.Table_ID, tables.Status_ID, status.Status_Name FROM tables JOIN status ON tables.Status_ID = status.Status_ID ORDER BY tables.Table_ID ASC;";
        $modal_result = $con->query($modal_sql);
        while ($row = mysqli_fetch_assoc($modal_result)) {
            echo '<!-- Debug: Current Table Status_ID: ' . $row['Status_ID'] . ' -->'; // แสดงค่า Status_ID ของโต๊ะปัจจุบัน
        ?>
        <div class="modal fade" id="EditTable-<?php echo $row['Table_ID'] ?>" tabindex="-1"
          aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header" style="background-color: SkyBlue;">
                <h5 class="modal-title text-white" id="exampleModalLabel">แก้ไขข้อมูล โต๊ะ</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="Edit_Table.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Table_ID</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Table_id" value="<?php echo $row['Table_ID'] ?>"
                        disabled>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-2 com-form-label">Status_Name</label>
                    <div class="col-sm-10">
                      <select class="form-select" id="Status_ID" name="Status_ID">
                        <?php
                            $status_sql = "SELECT * FROM status";
                            $status_result = $con->query($status_sql);
                            while ($status_row = mysqli_fetch_assoc($status_result)) {
                              echo '<!-- Debug: Option Status_ID: ' . $status_row['Status_ID'] . ' -->';
                              
                              $selected = ($row['Status_ID'] == $status_row['Status_ID']) ? 'selected' : '';
                              echo '<option value="' . $status_row['Status_ID'] . '" ' . $selected . '>' . $status_row['Status_Name'] . '</option>';
                            }
                            ?>
                      </select>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn bg-danger text-white" name="Editsubmit"
                      value="<?php echo $row['Table_ID'] ?>">แก้ไขข้อมูล</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="AddTable" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header" style="background-color: SkyBlue;">
                <h5 class="modal-title text-white" id="exampleModalLabel">เพิ่ม โต๊ะ</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="Add_Table.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Table_ID</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Table_id">
                    </div>
                  </div>
                  <div class=" mb-3 row">
                    <label class="label col-sm-3 com-form-label">Status_Name</label>
                    <div class="col-sm-9">
                      <select class="form-select" id="Status_ID" name="Status_ID">
                        <?php
                            $status_sql = "SELECT * FROM status";
                            $status_result = $con->query($status_sql);
                            while ($status_row = mysqli_fetch_assoc($status_result)) {
                              echo '<!-- Debug: Option Status_ID: ' . $status_row['Status_ID'] . ' -->';
                              
                              $selected = ($row['Status_ID'] == $status_row['Status_ID']) ? 'selected' : '';
                              echo '<option value="' . $status_row['Status_ID'] . '" ' . $selected . '>' . $status_row['Status_Name'] . '</option>';
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