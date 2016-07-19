<?php
//Check if search data was submitted
if ( isset( $_GET['s'] ) ) {
    // Include the search class
    require_once( dirname( __FILE__ ) . '/class-search.php' );

    // Instantiate a new instance of the search class
    $search = new search();

    // Store search term into a variable
    $search_term = htmlspecialchars($_GET['s'], ENT_QUOTES);

    // Send the search term to our search class and store the result
    /** @var array $search_results */
    $search_results = $search->search($search_term);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SD2799 Capstone</title>
    <link rel="stylesheet" href="main.css" media="all">
</head>
<body>
<header>
    Welcome to Child Daycare
</header>
<div class="search_container">
    <form name="search_box_form" action="" method="GET">
        <p>Search the database:</p>
        <input type="search" class="search_box" id="s" name="s" placeholder="Search..." value="<?php echo $search_term; ?>">
        <input class="search_button" type="submit" name="submit" value="Search">
    </form>
</div>

<div class="results_container">
    <?php if (is_array($search_results)) : ?>
    <?php foreach ( (array) $search_results['results'] as $search_result ) : ?>
    <div class="result">
        <span>&#xF011</span>
        <p>\2472</p>
        <!--<p><?php echo $search_result->title; ?></p>-->
        <!--<p><?php echo $search_result->title->fName; ?></p>-->
        <!--<p><?php echo $search_result->ch_fname; ?></p> -->
    </div>
    <?php endforeach; ?>
    <div class="search-raw">
        <!--<pre><?php print_r($search_results); ?></pre>-->
    </div>
    <?php endif; ?>

    <form name="update" action="update_child_info.php?update" method="post" >
        <div class="result_fields">
            <label for="ch_fname">First Name:</label>
            <input type="text" id="ch_fname" name="ch_fname" placeholder="First Name" value="<?php echo $search_result->ch_fname;?>" required>
            <label for="ch_mname">Middle Name:</label>
            <input type="text" id="ch_mname" name="ch_mname" placeholder="Middle Name" value="<?php echo $search_result->ch_mname;?>" required>
            <label for="ch_lname">Last Name:</label>
            <input type="text" id="ch_lname" name="ch_lname" placeholder="Last Name" value="<?php echo $search_result->ch_lname;?>" required>
            <label for="ch_age">Age:</label>
            <input type="number" id="ch_age" name="ch_age" placeholder="Age" value="<?php echo $search_result->age;?>" required>
            <label>Gender:</label>
            <?php if ( $search_result->ch_gender == "M" ) : ?>
                <input type="radio" name="gender" value="Male" title="Male" checked>Male
            <?php endif; ?>
            <?php if ( $search_result->ch_gender == "F" ) : ?>
                <input type="radio" name="gender" value="Female" title="Female" checked>Female
            <?php endif; ?>
            <?php if ( $search_result->ch_gender == "O" ) : ?>
                <input type="radio" name="gender" value="Other" title="Other" checked>Other
            <?php endif; ?>
            <label for="kalgy">Known Allergies:</label>
            <input type="text" id="kalgy" name="kalgy" placeholder="Known Allergies" value="<?php echo $search_result->kalagy;?>" required>
            <label for="visit_date">Visit Dates:</label>
            <input type="text" id="visit_date" value="<?php echo $search_result->visit_date;?>" required>
            <br><br>
            <input class="update_button" type="submit" name="submit" value="Update Info">
        </div>
    </form>
</div>
<footer>

</footer>
</body>
</html>