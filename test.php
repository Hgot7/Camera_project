<?php
require_once 'config.php';
require_once 'Building.php';

$database = new Database();
$db = $database->getConnection();
$building = new Building($db);

if ($_POST['addbuilding'] == 'POST') {
    $building_name = $_POST['building_name'];
    $building_fullname = $_POST['building_fullname'];

    if ($building->addBuilding($building_name, $building_fullname)) {
        echo '<div class="alert alert-success text-center" role="alert">Building added successfully</div>';
    } else {
        echo '<div class="alert alert-danger text-center" role="alert">Failed to add building</div>';
    }
}

$buildings = $building->getBuildings();
?>

<!-- HTML code here -->
<p style="align-content: center;margin: 0px 0px 0px 0px;">จัดการอาคาร</p>
<div class="form-floating" style="display:flex;flex-direction:row;margin-top:10px">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBuildingModal" style="margin-right: 1px !important;">
        เพิ่มอาคาร
    </button>

    <!-- Modal -->
    <div class="modal fade" id="addBuildingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addBuildingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title" id="addBuildingModalLabel">เพิ่มอาคาร</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="building" class="form-label" style="font-weight:normal;">ตั้งชื่ออาคาร</label>
                    <form action="./building/buildingmanage.php" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="ตัวย่ออาคาร เช่น EL" name="building_name" autocomplete="off" required="">
                            <span class="input-group-text">-</span>
                            <input type="text" class="form-control" placeholder="ชื่ออาคาร" name="building_fullname" autocomplete="off" required="">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="addbuilding" class="btn btn-primary" style="margin-right: 5px;">บันทึก</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table text-center align-middle table-hover mb-0" style="padding: 0px;">
        <thead class="table-thead">
            <tr>
                <th scope="col">ชื่ออาคาร</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($buildings as $building): ?>
            <tr class="table1-active">
                <td scope="row"><?php echo htmlspecialchars($building['building_fullname']); ?></td>
                <td>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editBuildingModal<?php echo $building['building_id']; ?>" style="margin-right: 1px !important;">
                        แก้ไข
                    </button>
                    <a class="btn btn-sm btn-danger" href="delete_building.php?id=<?php echo $building['building_id']; ?>">ลบ</a>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editBuildingModal<?php echo $building['building_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editBuildingModalLabel<?php echo $building['building_id']; ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p class="modal-title" id="editBuildingModalLabel<?php echo $building['building_id']; ?>">แก้ไขอาคาร</p>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label for="building" class="form-label" style="font-weight:normal;">แก้ไขชื่ออาคาร</label>
                            <form action="edit_building.php" method="post">
                                <input type="hidden" name="building_id" value="<?php echo $building['building_id']; ?>">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="ตัวย่ออาคาร เช่น EL" name="building_name" value="<?php echo htmlspecialchars($building['building_name']); ?>" autocomplete="off" required="">
                                    <span class="input-group-text">-</span>
                                    <input type="text" class="form-control" placeholder="ชื่ออาคาร" name="building_fullname" value="<?php echo htmlspecialchars($building['building_fullname']); ?>" autocomplete="off" required="">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" style="margin-right: 5px;">บันทึก</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>
