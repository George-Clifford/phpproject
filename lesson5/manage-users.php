<style>
    .users button {
        margin-top: 1%;
    }

    table {
        width: 100%;
    }

    tr,
    th,
    td {
        border: 1px solid black;
    }
</style>
<div class="users">
    <button>Add User</button>
    <?php
    include 'database-connect.php';

    $sql = "SELECT * FROM users";
    $result = $db_connect->query($sql);
    ?>
    <table>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
        ?>

            <tr>
                <td><?php echo $row['username'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><a href="">Edit</a></td>
                <td><a href="">Delete</a></td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>