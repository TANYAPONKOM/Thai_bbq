<?php
    include 'navbar.php';
    include '../connect.php';
    $sql = "SELECT * FROM orders 
            ORDER BY Order_Date,Order_ID ASC";
    $result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Manegement</title>
</head>

<body>
  <div class="container " style="margin-top: 10px;margin-left: 255px;">
    <div class=" card" style="width: 1100px;">
      <div class="card-body">
        <div class="col">
          <h3 class="card-title">Order Management</h3>
          <div align="left" style="margin-bottom: 10px;">
            <button class="btn bg-success text-light" data-bs-toggle="modal" data-bs-target="#AddOrder">
              <i class="bi bi-plus-square-fill"></i>&nbsp;&nbsp;Add</button>
          </div>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Order_ID</th>
              <th scope="col">Table_ID</th>
              <th scope="col">Total_Price</th>
              <th scope="col">Order_Date</th>
              <th scope="col">Management</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
            <tr>
              <th scope="row"><?php echo $row['Order_ID'] ?></th>
              <td><?php echo $row['Table_ID'] ?></td>
              <td><?php echo $row['Total_Price'] ?></td>
              <td><?php echo $row['Order_Date'] ?></td>
              <td>
                <a class="btn" href="#" data-bs-toggle="modal" style="background-color: SkyBlue;"
                  data-bs-target="#EditOrder-<?php echo $row['Order_ID'] ?>">
                  <i class="bi bi-pencil-square" style="color: white;"></i>
                </a>
                <a class="btn btn-danger" href="Del_Order.php?Order_ID=<?php echo $row['Order_ID'] ?>"><i
                    class="bi bi-trash-fill"></i></a>
              </td>
            </tr>

            <?php } ?>
          </tbody>
        </table>
        <?php
        $modal_sql = "SELECT * FROM orders ";
        $modal_result = $con->query($modal_sql);
        while ($row = mysqli_fetch_assoc($modal_result)) {
        echo '<!-- Debug: Current Table Order_ID: ' . $row['Order_ID'] . ' -->'; 
        ?>
        <div class="modal fade" id="EditOrder-<?php echo $row['Order_ID'] ?>" tabindex="-1"
          aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header" style="background-color: SkyBlue;">
                <h5 class="modal-title text-white" id="exampleModalLabel">แก้ไขข้อมูล ออเดอร์</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="Edit_Order.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Order_ID</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Order_ID" value="<?php echo $row['Order_ID'] ?>"
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
                    <label class="label col-sm-3 com-form-label">Total_Price</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Total_Price"
                        value="<?php echo $row['Total_Price'] ?>">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Order_Date</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Order_Date"
                        value="<?php echo $row['Order_Date'] ?>">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn bg-danger text-white" name="Editsubmit"
                      value="<?php echo $row['Order_ID'] ?>">แก้ไขข้อมูล</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="AddOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header" style="background-color: SkyBlue;">
                <h5 class="modal-title text-white" id="exampleModalLabel">เพิ่ม พนักงาน</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="Add_Order.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Order_ID</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="Order_ID" ">
                    </div>
                  </div>
                  <div class=" mb-3 row">
                      <label class="label col-sm-3 com-form-label">Table_ID</label>
                      <div class="col-sm-9">
                        <select class="form-select" id="Table_ID" name="Table_ID">
                          <?php
                            $typemenu_sql = "SELECT * FROM tables ORDER BY Table_ID ASC";
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
                    <div class=" mb-3 row">
                      <label class="label col-sm-3 com-form-label">Total_Price</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="Total_Price" value="0.00" disabled">
                      </div>
                    </div>
                    <div class=" mb-3 row">
                      <label class="label col-sm-3 com-form-label">Order_Date</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="Order_Date">
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