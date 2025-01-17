<p class="alert alert-info text-center p-2">You will not be able to activate an account with no chosen plan.</p>
<table id="datatablesSimple">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Country</th>
            <th>State</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Plan</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php if ($fetch = true) {
            $sn = 1;
            while ($row = mysqli_fetch_assoc($fetchUsers)) {
        ?>
                <tr>
                    <td><?= $sn ?></td>
                    <td><?= $row['firstname'] . ' ' . $row['firstname'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['country'] ?></td>
                    <td><?= $row['state'] ?></td>
                    <td><?= $row['gender'] ?></td>
                    <td><?= $row['phone'] ?></td>
                    <td><?php
                        if ($row['plan'] === '') {
                            echo "<span class='btn btn-sm btn-dark w-100 d-block'>No Plan</span>";
                        } ?>

                    </td>
                    <td><?= $row['date'] ?></td>
                    <td><?php
                        echo processStatus($row['status'])
                        ?>
                    </td>
                    <td>
                        <form method="post">

                            <input type="hidden" name="userid" value="<?= htmlspecialchars($row['userid']) ?>">
                            <?php if (getStatus($row['userid']) === 'activated') { ?>
                                <button name="block-account" class="btn btn-sm btn-danger">Block</button>
                            <?php } else { ?>
                                <button name="unblock-account" class="btn btn-sm btn-warning">Unblock</button>
                            <?php } ?>

                        </form>
                    </td>
                </tr>
        <?php }
        }

        ?>
    </tbody>
</table>