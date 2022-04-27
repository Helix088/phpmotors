<?php
// Vehicles Controller

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

// Get the array of classifications
$classifications = getClassifications();
// Build a navigation bar using the $classifications array
$navList = buildNavigation($classifications);

$action = filter_input(INPUT_GET, 'action');
if ($action == NULL) {
  $action = filter_input(INPUT_POST, 'action');
}

switch ($action) {
  case 'add_classification':
    $classificationName = trim(htmlspecialchars(filter_input(INPUT_POST, 'classificationName')));

    // Check for missin data
    if (empty($classificationName)) {
      $message = '<span class="empty">Please provide information for all empty form fields.</span>';
      include '../view/add_classification.php';
      exit;
    }

    // Send the data to the model if no errors exist
    $regOutcome = regClassification($classificationName);

    // Check and report the result
    if ($regOutcome === 1) {
      echo ("<meta http-equiv='refresh' content='1'>");
      include '../view/vehicle-man.php';
      exit;
    } else {
      $message = "<span class='message'>Sorry $classificationName, was not added. Please try again.</span>";
      include '../view/add_classification.php';
      exit;
    }
    break;
  case 'add_vehicle':
    $classificationId = trim(htmlspecialchars(filter_input(INPUT_POST, 'classificationId')));
    $invId = trim(htmlspecialchars(filter_input(INPUT_POST, 'invId')));
    $invYear = trim(filter_input(INPUT_POST, 'invYear', FILTER_SANITIZE_NUMBER_INT));
    $invMake = trim(htmlspecialchars(filter_input(INPUT_POST, 'invMake')));
    $invModel = trim(htmlspecialchars(filter_input(INPUT_POST, 'invModel')));
    $invDescription = trim(htmlspecialchars(filter_input(INPUT_POST, 'invDescription')));
    $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
    $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
    $invMiles = trim(filter_input(INPUT_POST, 'invMiles', FILTER_SANITIZE_NUMBER_INT));
    $invColor = trim(htmlspecialchars(filter_input(INPUT_POST, 'invColor')));

    // Check for missin data
    if (empty($classificationId) || empty($invId) || empty($invYear) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invPrice) || empty($invStock) || empty($invMiles) || empty($invColor)) {
      $message = '<span class="empty">Please provide information for all empty form fields.</span>';
      include '../view/add_vehicle.php';
      exit;
    }

    // Send the data to the model if no errors exist
    $regOutcome = regVehicle($classificationId, $invId, $invYear, $invMake, $invModel, $invDescription, $invPrice, $invStock, $invMiles, $invColor);

    // Check and report the result
    if ($regOutcome === 1) {
      $message = "<span class='message'>The $invMake $invModel was added successfully!</span>";
      include '../view/add_vehicle.php';
      exit;
    } else {
      $message = "<span class='message'>Sorry the $invMake $invModel was not added. Please try again.</span>";
      include '../view/add_vehicle.php';
      exit;
    }
    break;
  
  /* * *****************************************
  * Get vehicles by classificationId
  * Used for starting Update and Delete process
  * ***************************************** */
  case 'getInventoryItems':
    // Get the classificationId
    $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
    // Fetch the vehicles by classificationId from the DB
    $inventoryArray = getInventoryByClassification($classificationId);
    // Convert the array to a JSON object and send it back
    echo json_encode($inventoryArray);
    break;
    // Updating Vehicle
  case 'modifyVehicle':
    $classificationId = trim(htmlspecialchars(filter_input(INPUT_POST, 'classificationId')));
    $invYear = trim(filter_input(INPUT_POST, 'invYear', FILTER_SANITIZE_NUMBER_INT));
    $invMake = trim(htmlspecialchars(filter_input(INPUT_POST, 'invMake')));
    $invModel = trim(htmlspecialchars(filter_input(INPUT_POST, 'invModel')));
    $invDescription = trim(htmlspecialchars(filter_input(INPUT_POST, 'invDescription')));
    $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
    $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
    $invMiles = trim(filter_input(INPUT_POST, 'invMiles', FILTER_SANITIZE_NUMBER_INT));
    $invColor = trim(htmlspecialchars(filter_input(INPUT_POST, 'invColor')));
    $invId = trim(htmlspecialchars(filter_input(INPUT_POST, 'invId')));

    // Check for missin data
    if (empty($classificationId) || empty($invYear) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invPrice) || empty($invStock) || empty($invMiles) || empty($invColor)) {
      $message = '<span class="empty">Please provide information for all empty form fields.</span>';
      include '../view/vehicle-update.php';
      exit;
    }
    $updateResult = modifyVehicle($classificationId, $invYear, $invMake, $invModel, $invDescription, $invPrice, $invStock, $invMiles, $invColor, $invId);
    if ($updateResult) {
      $message = "<span class='message'>Congratulations, the $invYear $invMake $invModel was successfully updated.</span>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors/vehicles/');
      exit;
    } else {
      $message = "<span class='message'>Error. The vehicle was not updated.</span>";
      include '../view/vehicle-update.php';
      exit;
    }
    break;
  case 'deleteVehicle':
    $invYear = trim(filter_input(INPUT_POST, 'invYear', FILTER_SANITIZE_NUMBER_INT));
    $invMake = trim(htmlspecialchars(filter_input(INPUT_POST, 'invMake')));
    $invModel = trim(htmlspecialchars(filter_input(INPUT_POST, 'invModel')));
    $invId = trim(htmlspecialchars(filter_input(INPUT_POST, 'invId')));

    $deleteResult = deleteVehicle($invId);
    if ($deleteResult) {
      $message = "<span class='message'>Congratulations, the $invYear $invMake $invModel was successfully deleted.</span>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors/vehicles/');
      exit;
    } else {
      $message = "<span class='message'>Error. The vehicle was not deleted.</span>";
      include '../view/vehicle-update.php';
      exit;
    }
    break;
  
  /* * *****************************************
  * Modifying/Updating cars in the inventory
  * ***************************************** */
  case 'mod':
    $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invInfo = getInvItemInfo($invId);
    if (count($invInfo) <= 0) {
      $message = 'Sorry, no vehicle information could be found.';
    }
    include '../view/vehicle-update.php';
    exit;
    break;
  
  /* * *****************************************
  * Deleting cars in the inventory
  * ***************************************** */
  case 'del':
    $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invInfo = getInvItemInfo($invId);
    if (count($invInfo) <= 0) {
      $message = 'Sorry, no vehicle information could be found.';
    }
    include '../view/vehicle-delete.php';
    exit;
    break;
  
  /* * *****************************************
  * Classification of vehicles
  ******************************************** */
  case 'classification':
    $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $vehicles = getVehiclesByClassification($classificationName);
    if(!count($vehicles)) {
      $message = "<p class='notice>Sorry, no $classificationName vehicles could be found.</p>";
    } else {
      $vehicleDisplay = buildVehiclesDisplay($vehicles);
    }
    include '../view/classification.php';
    break;
  /* * *****************************************
  * Get vehicle information
  ******************************************** */
  case 'vehicle-info':
    $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $vehicle = getInvItemInfo($invId);
    $imageArray = getImagePath($invId);
    if (!count($vehicle)) {
      $message = "<p class='notice>Sorry, $invMake $invModel could not be found.</p>";
    } else {
      $vehicleInfo = buildVehicleInfo($vehicle);
      $thumbDisplay = buildThumbnails($imageArray);
    }
    include '../view/vehicle-info.php';
    break;
  case 'Add_Classification':
    include '../view/add_classification.php';
    break;
  case 'Add_Vehicle':
    include '../view/add_vehicle.php';
    break;
  default:
    $classificationList = buildClassificationList($classifications);
    include '../view/vehicle-man.php';
}
?>