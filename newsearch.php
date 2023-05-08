<?php
require "connect.php";

$error_message = '';

if (isset($_GET['searchtitle'])) {
    $searchtitle = $_GET['searchtitle'];
    if ((empty($searchtitle)) || ($searchtitle == ' ')) {
        $error_message = 'Please enter a search term.';
    } else {
        try {
            $query = "SELECT * FROM games WHERE title LIKE :searchtitle";
            $stmt = $yhteys->prepare($query);
            $stmt->bindValue(':searchtitle', '%'.$searchtitle.'%', PDO::PARAM_STR);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_OBJ);

            if (count($rows) > 0) {
                ?>
                <div class="row hide">
                    <div class="col-12 text-end">
                    <button type="button" class="btn-close" aria-label="Close"></button>
                </div>
 
                <table class="table table-striped">
                    <h4>Search results:</h4>
                    <tr>
                        <th class="col-4">Title</th>
                        <th class="col-2">Release date</th>
                        <th class="col-3">Developer</th>
                        <th class="col-3">Platform</th>
                    </tr>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td class=""><?php echo $row->title; ?></td>
                            <td class=""><?php echo $row->releasedate; ?></td>
                            <td class=""><?php echo $row->developer; ?></td>
                            <td class=""><?php echo $row->platform; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                </div>
                <?php
            } else {
                $error_message = 'No games found.';
            }
        } catch (PDOException $e) {
            $error_message = 'Error: ' . $e->getMessage();
        }
    }
}

if ($error_message) {
    ?>
    <div class="row hide">
        <div class="col-12 text-end">
            <button type="button" class="btn-close" aria-label="Close"></button>
        </div>
        <h4>Search results:</h4>
            <p style="color:red"><?php echo $error_message; ?></p>
    </div>
    <?php
}
?>

<script>
  $(document).ready(function() {
    // Activate the Bootstrap button
    $('.btn-close').on('click', function() {
        $(this).closest('.hide').hide();
    });
  });
</script>