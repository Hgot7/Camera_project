<?php
require_once '../class/room.php';
$room = new Room($conn);

if (isset($_POST['building_id'])) {
    $building_id = $_POST['building_id'];
    if ($building_id =='') {
        // Handle the case where $building_id is empty (null or "")
        $output = '<table class="table text-center align-middle table-hover mb-0" style="padding: 0px;">
          <thead class="table-thead">
            <tr>
              <th scope="col" class="text-center">Select a building first</th>
            </tr>
          </thead>
          <tbody>';
        echo $output;
    } else {
        $rooms = $room->getRoomsWithBuilding($building_id);
        if (!empty($rooms)) {
            $output = '<table class="table text-center align-middle table-hover mb-0" style="padding: 0px;">
                <thead class="table-thead">
                    <tr>
                    <th scope="col">ชื่อห้อง</th>
                        <th scope="col">เลขห้อง</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>';
            foreach ($rooms as $room) {
                $output .= '<tr class="table1-active">
                <td>' . htmlspecialchars($room['room_name']) . '</td>
                        <td scope="row">' . htmlspecialchars($room['room_number']) . '</td>
                        <td>
                            <a class="btn btn-sm btn-warning" href="../building/edit_room.php?id=' . $room['room_id'] . '">แก้ไข</a>
                            <a onclick="return confirm(\'Are you sure you want to delete?\');" class="btn btn-sm btn-danger" href="../building/delete_room.php?id=' . $room['room_id'] . '">ลบ</a>                        </td>
                    </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            $output = '<table class="table text-center align-middle table-hover mb-0" style="padding: 0px;">
            <thead class="table-thead">
            <tr>
            <th scope="col" class="text-center">No data room in this building</th>
        </tr>
            </thead>
            <tbody>';
            echo $output;
        }
    }
}
