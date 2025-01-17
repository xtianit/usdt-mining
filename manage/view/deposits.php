<table id="datatablesSimple">
    <thead>
        <tr>
            <th>#</th>
            <th>Email</th>
            <th>Investment Plan</th>
            <th>Reference</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php if ($deposit_fetched = true) {
            $sn = 1;
            while ($row = mysqli_fetch_assoc($fetchDepsit)) {
        ?>
                <tr>
                    <td><?= $sn++ ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['package'] ?></td>
                    <td><?= $row['reference'] ?></td>
                    <td><?= $row['date'] ?></td>
                    <td><?php if ($row['status'] === 'pending') {
                            echo "<label class='btn btn-warning btn-sm'>Pending</label>";
                        } else {
                            echo "<label class='btn bg-dark btn-sm text-light'>Declined</label>";
                        }

                        ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="userid" value="<?= htmlspecialchars($row['userid']) ?>">
                            <input type="hidden" name="amount" value="<?= htmlspecialchars($row['package']) ?>">
                            <input type="hidden" name="reference" value="<?= htmlspecialchars($row['reference']) ?>">
                            <button name="approve" class="btn btn-sm btn-danger">Aprove</button>
                            <button name="decline" class="btn btn-sm btn-warning">Decline</button>
                        </form>
                    </td>
                </tr>
        <?php }
        }

        ?>
    </tbody>
</table>