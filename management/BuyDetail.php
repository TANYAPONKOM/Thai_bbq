<?php
    include 'navbar.php';
    include '../connect.php';
    $sql = "SELECT buydetail.Buy_ID,buydetail.Menu_ID,menu.Menu_Name,buydetail.BuyDetail_Amount FROM buydetail 
            JOIN menu ON buydetail.Menu_ID = menu.Menu_ID
            ORDER BY buydetail.Buy_ID,buydetail.Menu_ID ASC";
    $result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BuyDetail Manegement</title>
</head>

<body>
  <div class="container " style="margin-top: 10px;margin-left: 255px;">
    <div class=" card" style="width: 1100px;">
      <div class="card-body">
        <div class="col">
          <h3 class="card-title">BuyDetail Management</h3>
          <div align="left" style="margin-bottom: 10px;">
            <button class="btn bg-success text-light" data-bs-toggle="modal" data-bs-target="#AddBuyDetail">
              <i class="bi bi-plus-square-fill"></i>&nbsp;&nbsp;Add</button>
          </div>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Buy_ID</th>
              <th scope="col">Menu_Name</th>
              <th scope="col">Amount</th>
              <th scope="col">Management</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
            <tr>
              <th scope="row"><?php echo $row['Buy_ID'] ?></th>
              <td><?php echo $row['Menu_Name'] ?></td>
              <td><?php echo $row['BuyDetail_Amount'] ?></td>
              <td>
                <a class="btn" href="#" data-bs-toggle="modal" style="background-color: SkyBlue;"
                  data-bs-target="#EditBuyDetail-<?php echo $row['Buy_ID'] . '_' . $row['Menu_ID'] ?>"><i
                    class="bi bi-pencil-square" style="color: white;"></i></a>
                <a class="btn btn-danger"
                  href="Del_BuyDetail.php?Buy_ID=<?php echo $row['Buy_ID'] ?>&Menu_ID=<?php echo $row['Menu_ID'] ?>"><i
                    class="bi bi-trash-fill"></i></a>
              </td>
            </tr>

            <?php } ?>
          </tbody>
        </table>
        <?php
        $modal_sql = "SELECT * FROM buydetail ";
        $modal_result = $con->query($modal_sql);
        while ($row = mysqli_fetch_assoc($modal_result)) {
        echo '<!-- Debug: Current Table Buy_ID: ' . $row['Buy_ID'] . ' -->'; 
        ?>
        <div class="modal fade" id="EditBuyDetail-<?php echo $row['Buy_ID'] . '_' . $row['Menu_ID'] ?>" tabindex="-1"
          aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header" style="background-color: SkyBlue;">
                <h5 class="modal-title text-white" id="exampleModalLabel">แก้ไขข้อมูล รายละเอียดการซื้อ</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="Edit_BuyDetail.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Buy_ID</label>
                    <div class="col-sm-9">
                      <select class="form-select" id="Buy_ID" name="Buy_ID" disabled>
                        <?php
                            $typemenu_sql = "SELECT Buy_ID FROM buy GROUP BY Buy_ID";
                            $typemenu_result = $con->query($typemenu_sql);
                            while ($typemenu_row = mysqli_fetch_assoc($typemenu_result)) {
                              echo '<!-- Debug: Option Buy_ID: ' . $typemenu_row['Buy_ID'] . ' -->';
                              
                              $selected = ($row['Buy_ID'] == $typemenu_row['Buy_ID']) ? 'selected' : '';
                              echo '<option value="' . $typemenu_row['Buy_ID'] . '" ' . $selected . '>' . $typemenu_row['Buy_ID'] . '</option>';
                            }
                            ?>
                      </select>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Menu_ID</label>
                    <div class="col-sm-9">
                      <select class="form-select" id="Menu_ID" name="Menu_ID" disabled>
                        <?php
                            $typemenu_sql = "SELECT * FROM menu GROUP BY Menu_ID";
                            $typemenu_result = $con->query($typemenu_sql);
                            while ($typemenu_row = mysqli_fetch_assoc($typemenu_result)) {
                                $selected = ($row['Menu_ID'] == $typemenu_row['Menu_ID']) ? 'selected' : '';
                                echo '<option value="' . $typemenu_row['Menu_ID'] . '" ' . $selected . '>' . $typemenu_row['Menu_Name'] . '</option>';
                            }
                        ?>
                      </select>
                      <input type="hidden" name="Menu_ID" value="<?php echo $row['Menu_ID']; ?>">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Amount</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="BuyDetail_Amount" name="BuyDetail_Amount"
                        value="<?php echo $row['BuyDetail_Amount'] ?>">
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
        <div class="modal fade" id="AddBuyDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header" style="background-color: SkyBlue;">
                <h5 class="modal-title text-white" id="exampleModalLabel">เพิ่ม รายละเอียดการซื้อ</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="Add_BuyDetail.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Buy_ID</label>
                    <div class="col-sm-9">
                      <select class="form-select" id="Buy_ID" name="Buy_ID">
                        <?php
                            $typemenu_sql = "SELECT Buy_ID FROM buy GROUP BY Buy_ID";
                            $typemenu_result = $con->query($typemenu_sql);
                            while ($typemenu_row = mysqli_fetch_assoc($typemenu_result)) {
                              echo '<!-- Debug: Option Buy_ID: ' . $typemenu_row['Buy_ID'] . ' -->';
                              
                              $selected = ($row['Buy_ID'] == $typemenu_row['Buy_ID']) ? 'selected' : '';
                              echo '<option value="' . $typemenu_row['Buy_ID'] . '" ' . $selected . '>' . $typemenu_row['Buy_ID'] . '</option>';
                            }
                            ?>
                      </select>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Menu_ID</label>
                    <div class="col-sm-9">
                      <select class="form-select" id="Menu_ID" name="Menu_ID">
                        <?php
                            $typemenu_sql = "SELECT * FROM menu";
                            $typemenu_result = $con->query($typemenu_sql);
                            while ($typemenu_row = mysqli_fetch_assoc($typemenu_result)) {
                                // Set the selected attribute based on the current row's Menu_ID
                                $selected = ($row['Menu_ID'] == $typemenu_row['Menu_ID']) ? 'selected' : '';
                                echo '<option value="' . $typemenu_row['Menu_ID'] . '" ' . $selected . '>' . $typemenu_row['Menu_Name'] . '</option>';
                            }
                        ?>
                      </select>
                    </div>
                  </div>


                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Amount</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="BuyDetail_Amount" ">
                      </div>
                    </div>
                    <div class=" modal-footer">
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