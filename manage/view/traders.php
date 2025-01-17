<table id="datatablesSimple">
    <thead>
        <tr>
            <th>#</th>
            <th>Email</th>
            <th>Amount</th>
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
                    <td><?= $sn ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['amount'] ?></td>
                    <td><?= $row['reference'] ?></td>
                    <td><?= $row['date'] ?></td>
                    <td><?= $row['status'] ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="userid" value="<?= htmlspecialchars($row['userid']) ?>">
                            <input type="hidden" name="amount" value="<?= htmlspecialchars($row['amount']) ?>">
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