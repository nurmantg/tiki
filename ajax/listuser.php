<?php 
require_once('../config.php');
$dep = $_POST['departemen'];
$name = $_POST['fullname'];

$query = $pdo->prepare("SELECT * FROM user WHERE nama_lengkap LIKE nurman% ");
$query->execute();
$hitung = $query->rowCount();
$result = $query->fetchAll();
foreach ($result as $hasil ) {
	?>
	
	<tr>
        <td>
            <?php echo $hasil['nama_lengkap']; ?>
        </td>
        <td class="td-departement" style="text-align: left"><span class="border-departement">
        	<a href="#"><?php echo $hasil['departemen']; ?></a></span>
        </td>
        <td class="td-option">
            <span>
                <button type="submit" class="btn btn-default ">Delete</button>
            </span>
        </td>
    </tr>

	<?php
}
 ?>