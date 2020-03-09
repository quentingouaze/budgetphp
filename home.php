<?php
include 'header.php';
if (isset($_SESSION['user_id'])) {
    if (isset($_POST['addEntry'])) {
        addBudgetEntry($pdo);
    }
    ?>
    <form action="home.php" method="post">
        <label for="entryName">Name</label>
        <input type="text" id="entryName" name="entryName">
        <label for="entryValue">Value</label>
        <input type="number" id="entryValue" name="entryValue">
        <label for="entryType">Type</label>
        <input type="text" id="entryType" name="entryType">
        <label for="entryDetail">Detail</label>
        <textarea id="entryDetail" name="entryDetail"></textarea>
        <label for="entryCategory">Category</label>
        <select id="entryCategory" name="entryCategory">
            <?php
            $categories = getCategoriesList($pdo);
            foreach ($categories as $category) {
                echo '<option value="' . $category["idCategory"] . '">' . $category["categoryName"] . '</option>';
            }
            ?>
        </select>
        <input type="submit" name="addEntry" value="Add Entry">
    </form>
    <?php
    echo "Show User Budget: ";
    if (showUserBudget($pdo)) {

        echo "<div id='userBudget'></div>";
        ?>
        <table id="budgetcomplet">
        <thead>
        <tr>
            <td>
                Name
            </td>
            <td>
                Value
            </td>
            <td>
                Category
            </td>
            <td>
                Date
            </td>
        </tr>
        </thead>
        <tbody>
        <?php
        $tableaubudget = showUserBudget($pdo);
        foreach ($tableaubudget as $row) {
            var_dump($row);
            echo "<tr><td>" . $row['entryName'] . "</td><td>" . $row['entryValue'] . "</td><td>" . $row['entryCategory'] . "</td><td>" . date('d-m-Y', strtotime($row['date'])) . "</td>";
        }
        ?>

        </tbody>

        <?php
    } else {
        echo "List is empty";
    }
} else {
    echo "Non connecté, login ou register";
}
include_once 'footer.php';