<?php

include 'header.php';

if (isset($_SESSION['user_id']) ) {
echo "Connecté, user id: " .$_SESSION['user_id'];

    if (isset($_POST['entryName'])){

    }
?>
        <form action="home.php" method="post">
            <label for="entryName">Name</label>
            <input type="text" id="entryName" name="entryName">
            <label for="entryType">Type</label>
            <input type="text" id="entryType" name="entryType">
            <label for="entryDetail">Detail</label>
            <input type="textarea" id="entryDetail" name="entryDetail">
            <label for="entryCategory"></label>
            <select id="entryCategory"></select>

    <?php
    $categories=getCategoriesList($pdo);
    foreach($categories as $category){
        var_dump($category);
        echo "<br>";
       // echo '<option value="'.$category['entry']
    }
    ?>
        </form>


<?php

var_dump(showUserBudget($pdo));
}
else{
    echo "Non connecté, login ou register";
}
