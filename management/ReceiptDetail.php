<?php
    include 'navbar.php';
    include '../connect.php';
    $sql = "SELECT receiptdetail.Receipt_ID,receiptdetail.Menu_ID,menu.Menu_Name,receiptdetail.ReceiptDetail_Amount FROM receiptdetail 
            JOIN menu ON receiptdetail.Menu_ID = menu.Menu_ID
            ORDER BY receiptdetail.Receipt_ID,receiptdetail.Menu_ID ASC";
    $result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ReceiptDetail Manegement</title>
</head>

<body>
  <div class="container " style="margin-top: 10px;margin-left: 255px;">
    <div class=" card" style="width: 1100px;">
      <div class="card-body">
        <div class="col">
          <h3 class="card-title">ReceiptDetail Management</h3>
          <div align="left" style="margin-bottom: 10px;">
            <button class="btn bg-success text-light" data-bs-toggle="modal" data-bs-target="#AddReceiptDetail">
              <i class="bi bi-plus-square-fill"></i>&nbsp;&nbsp;Add</button>
          </div>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Receipt_ID</th>
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
              <th scope="row"><?php echo $row['Receipt_ID'] ?></th>
              <td><?php echo $row['Menu_Name'] ?></td>
              <td><?php echo $row['ReceiptDetail_Amount'] ?></td>
              <td>
                <a class="btn" href="#" data-bs-toggle="modal" style="background-color: SkyBlue;"
                  data-bs-target="#EditReceiptDetail-<?php echo $row['Receipt_ID'] . '_' . $row['Menu_ID'] ?>"><i
                    class="bi bi-pencil-square" style="color: white;"></i></a>
                <a class="btn btn-danger"
                  href="Del_ReceiptDetail.php?Receipt_ID=<?php echo $row['Receipt_ID'] ?>&Menu_ID=<?php echo $row['Menu_ID'] ?>"><i
                    class="bi bi-trash-fill"></i></a>
              </td>
            </tr>

            <?php } ?>
          </tbody>
        </table>
        <?php
        $modal_sql = "SELECT * FROM receiptdetail ";
        $modal_result = $con->query($modal_sql);
        while ($row = mysqli_fetch_assoc($modal_result)) {
        echo '<!-- Debug: Current Table Receipt_ID: ' . $row['Receipt_ID'] . ' -->'; 
        ?>
        <div class="modal fade" id="EditReceiptDetail-<?php echo $row['Receipt_ID'] . '_' . $row['Menu_ID'] ?>"
          tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header" style="background-color: SkyBlue;">
                <h5 class="modal-title text-white" id="exampleModalLabel">แก้ไขข้อมูล รายละเอียดใบเสร็จ</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="Edit_ReceiptDetail.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Receipt_ID</label>
                    <div class="col-sm-9">
                      <select class="form-select" id="Receipt_ID" name="Receipt_ID" disabled>
                        <?php
                            $typemenu_sql = "SELECT Receipt_ID FROM receiptdetail GROUP BY Receipt_ID";
                            $typemenu_result = $con->query($typemenu_sql);
                            while ($typemenu_row = mysqli_fetch_assoc($typemenu_result)) {
                              echo '<!-- Debug: Option Receipt_ID: ' . $typemenu_row['Receipt_ID'] . ' -->';
                              
                              $selected = ($row['Receipt_ID'] == $typemenu_row['Receipt_ID']) ? 'selected' : '';
                              echo '<option value="' . $typemenu_row['Receipt_ID'] . '" ' . $selected . '>' . $typemenu_row['Receipt_ID'] . '</option>';
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
                      <input type="text" class="form-control" id="ReceiptDetail_Amount" name="ReceiptDetail_Amount"
                        value="<?php echo $row['ReceiptDetail_Amount'] ?>">
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
        <div class="modal fade" id="AddReceiptDetail" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header" style="background-color: SkyBlue;">
                <h5 class="modal-title text-white" id="exampleModalLabel">เพิ่ม รายละเอียดใบเสร็จ</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="Add_ReceiptDetail.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3 row">
                    <label class="label col-sm-3 com-form-label">Receipt_ID</label>
                    <div class="col-sm-9">
                      <select class="form-select" id="Receipt_ID" name="Receipt_ID">
                        <?php
                            $typemenu_sql = "SELECT Receipt_ID FROM receiptdetail GROUP BY Receipt_ID";
                            $typemenu_result = $con->query($typemenu_sql);
                            while ($typemenu_row = mysqli_fetch_assoc($typemenu_result)) {
                              echo '<!-- Debug: Option Receipt_ID: ' . $typemenu_row['Receipt_ID'] . ' -->';
                              
                              $selected = ($row['Receipt_ID'] == $typemenu_row['Receipt_ID']) ? 'selected' : '';
                              echo '<option value="' . $typemenu_row['Receipt_ID'] . '" ' . $selected . '>' . $typemenu_row['Receipt_ID'] . '</option>';
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
                      <input type="text" class="form-control" name="ReceiptDetail_Amount" ">
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