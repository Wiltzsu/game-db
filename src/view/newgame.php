<?php

require "connect.php";

if(isset($_POST['add'])) {
    $title=$_POST['title'];
    $releasedate=$_POST['releasedate'];
    $developer=$_POST['developer'];
    $platform=$_POST['platform'];

    $query="INSERT INTO usergames(title, releasedate, developer, platform)
            VALUES(:title, :releasedate, :developer, :platform)";

        $add = $yhteys->prepare($query);
        $add->bindValue(':title', $title, PDO::PARAM_STR);
        $add->bindValue(':releasedate', $releasedate, PDO::PARAM_STR);
        $add->bindValue(':developer', $developer, PDO::PARAM_STR);
        $add->bindValue(':platform', $platform, PDO::PARAM_STR);
        $add->execute();
        echo "<script>window.location.replace('admin.php?success=true');</script>";
        exit();
}

require_once "header.php";
?>



<div class="container">
    <div class="row">
        <div class="col-sm-12 bg-white">
            <table class="table" style="color:black">
                <form action="index.php" method="POST" id="myForm">
                    <tr>
                        <td>Title</td>
                        <td><input type="text" class="form-control" name="title" required placeholder="e.g. Far Cry 4"></td>
                    </tr>
                    <tr>
                        <td>Release date</td>
                        <td><input type="date" class="form-control" name="releasedate" required></td>
                    </tr>
                    <tr>
                        <td>Developer</td>
                        <td><input type="text" class="form-control" name="developer" required placeholder="e.g. Ubisoft Montreal, Red Storm, Ubisoft Toronto, Ubisoft Kyiv, Ubisoft Shanghai"></td>
                    </tr>
                    <tr>
                        <td>Platform</td>
                        <td><input type="text" class="form-control" name="platform" required placeholder="e.g. PC, PS5, PS4, XSX, XBO, Switch"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button class="g-recaptcha btn btn-primary" 
                            name="add"
                            type="submit"
                            data-sitekey="6LczX54lAAAAAFbt65LDoTrH7ZBHqmJS60Z1mn9W" 
                            data-callback='onSubmit' 
                            data-action='submit'>Submit</button>
                        </td>
                    </tr>
                </form>
            </table>            
        </div>
    </div>
</div>


