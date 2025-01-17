<h4>WIthdrawal Requests</h4>
<table id="datatablesSimple" class="small">
    <thead>
        <tr>
            <th>#</th>
            <th>Amount</th>
            <th>ID</th>
            <th>Reference</th>
            <th>Wallet</th>
            <th>Coin</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        <?php if ($fetched_withdraw = true) {
            $sn = 1;
            while ($row = mysqli_fetch_assoc($withdrawals)) {
                $userid = $row['userid'];
        ?>
                <tr>
                    <td><?= $sn++ ?></td>
                    <td>
                        <div contenteditable="true"><?= $row['amount'] ?></div>
                    </td>
                    <td><?= $row['userid'] ?></td>
                    <td><?= $row['reference'] ?></td>
                    <td><?= $row['wallet'] ?></td>
                    <td><?= $row['crypto'] ?></td>
                    <td><?= $row['date'] ?></td>
                    <td><?= $row['status'] ?></td>
                    <td>
                        <button class="processButton btn btn-sm btn-danger" data-id="<?= $userid ?>">Approve</button>
                    </td>
                    <td>
                        <button class="declineWithdrawal btn btn-sm btn-warning w-100" data-id="<?= $userid ?>">Decilne</button>
                    </td>
                </tr>
        <?php }
        }
        ?>
    </tbody>
</table>
<div id="cover-spin"></div>


<?php
function use_email($id)
{
    global $conn;
    $sql = mysqli_query($conn, "select * from users where userid='$id' limit 1");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $email = $row['email'];
        return $email;
    }
}
?>