<?php 
// Search Controller

// Create or access a Session
session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/vehicles-model.php';
// Get the functions library
require_once '../library/functions.php';
// Get the uploads model
require_once '../model/uploads-model.php';
// Get the search model
require_once '../model/search-model.php';
/* * *****************************************
* Get vehicle information
******************************************** */

// Get the array of classifications
$classifications = getClassifications();
// Build a navigation bar using the $classifications array
$navList = buildNavigation($classifications);

$action = filter_input(INPUT_GET, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'search':
        $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $search_results = vehicleSearch($search);
        if (empty($search)) {
            $e_message = '<span class="message">You must provide a search string.</span>';
            $_SESSION['e_message'] = $e_message;
        } else if (count($search_results) <= 0) {
            $searchInfo = buildSearchDisplay($search, $search_results);
            $n_message = "<p class='result-message'>Sorry, no results were found to match $search.</p>";
        } else {
            $searchInfo = buildSearchDisplay($search, $search_results);
        }
        include '../view/search.php';
        break;
    default:
        include '../view/search.php';
        break;
}

?>