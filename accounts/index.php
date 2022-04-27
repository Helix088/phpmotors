<?php
// Accounts Controller

// Create or access a Session
session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
//Get the functions library
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();
// Build a navigation bar using the $classifications array
$navList = buildNavigation($classifications);

$action = filter_input(INPUT_GET, 'action');
if ($action == NULL) {
  $action = filter_input(INPUT_POST, 'action');
}

switch ($action) {
  case 'register':
    $clientFirstname = trim(htmlspecialchars(filter_input(INPUT_POST, 'clientFirstname')));
    $clientLastname = trim(htmlspecialchars(filter_input(INPUT_POST, 'clientLastname')));
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientPassword = trim(htmlspecialchars(filter_input(INPUT_POST, 'clientPassword')));

    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);

    // Check for existing email
    $existingEmail = checkExistingEmail($clientEmail);

    // Check for existing email address in the table
    if ($existingEmail) {
      $_SESSION['message'] = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
      include '../view/signin.php';
      exit;
    }

    // Check for missin data
    if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
      $_SESSION['message'] = '<span class="empty">Please provide information for all empty form fields.</span>';
      include '../view/registration.php';
      exit;
    }

    // Hash the checked password
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

    // Send the data to the model if no errors exist
    $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

    // Check and report the result
    if ($regOutcome === 1) {
      $_SESSION['message'] = "<p class='thanks'>Thanks for registerting $clientFirstname. Please use your email and password to login.</p>";
      header('Location: /phpmotors/accounts/?action=Login');
      exit;
    } else {
      $_SESSION['message'] = "<span class='message'>Sorry $clientFirstname, but the registration failed. Please try again.</span>";
      include '../view/registration.php';
      exit;
    }
    break;
  case 'login':
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientPassword = trim(htmlspecialchars(filter_input(INPUT_POST, 'clientPassword')));

    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);

    // Check for missing data
    if (empty($clientEmail) || empty($checkPassword)) {
      $_SESSION['message'] = '<span class="empty">Please provide information for all empty form fields.</span>';
      include '../view/signin.php';
      exit;
    }

    // A valid password exists, proceed with the login process
    // Query the client data based on the email address
    $clientData = getClient($clientEmail);

    // Compare the password just submitted against the hashed password for the matching client
    $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);

    // If the hashes don't match create an error and return to the login view
    if (!$hashCheck) {
      $_SESSION['message'] = '<span class="notice">Please check your password and try again.</span>';
      include '../view/signin.php';
      exit;
    }

    // A valid user exists, log them in
    $_SESSION['loggedin'] = TRUE;

    // Remove the password from the array the array_pop function removes the last element from the array
    array_pop($clientData);

    // Store the array into the session
    $_SESSION['clientData'] = $clientData;

    // Send them to the admin view
    include '../view/admin.php';
    exit;
    break;
  case 'logout':
    unset($_SESSION['loggedin']);
    session_destroy();
    include '../index.php';
    exit;
    break;
  case 'updateInfo':
    $clientFirstname = trim(htmlspecialchars(filter_input(INPUT_POST, 'clientFirstname')));
    $clientLastname = trim(htmlspecialchars(filter_input(INPUT_POST, 'clientLastname')));
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

    $clientEmail = checkEmail($clientEmail);

    // Check for existing email
    $existingEmail = checkExistingEmail($clientEmail);

    // Check for missin data
    if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
      $message = '<span class="empty">Please provide information for all empty form fields.</span>';
      $_SESSION['message'] = $message;
      include '../view/client-update.php';
      exit;
    }

    // Send the data to the model if no errors exist
    $updateClient = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);
    if ($updateClient) {
      $cmessage = "<span class='message'>$clientFirstname, your information has been updated.</span>";
      $_SESSION['message'] = $cmessage;

      // Query the database based on the client id
      $clientData = getClientInfo($clientId);

      // Store the array into the session
      $_SESSION['clientData'] = $clientData;

      header('Location: /phpmotors/accounts/');
      exit;
    } else {
      $smessage = "<span class='message'>Sorry $clientFirstname, but we could not update your account information. Please try again.</span>";
      $_SESSION['smessage'] = $smessage;

      include '../view/client-update.php';
      exit;
    }
    break;
  case 'updatePass':
    $clientPassword = trim(htmlspecialchars(filter_input(INPUT_POST, 'clientPassword')));
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

    $checkPassword = checkPassword($clientPassword);

    // Check for missin data
    if (empty($checkPassword)) {
      $pmessage = '<span class="message">Please make sure your password matches the desired pattern.</span>';
      $_SESSION['pmessage'] = $pmessage;
      include '../view/client-update.php';
      exit;
    }

    // Hash the checked password
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);


    // Check and report the result
    $updatePassword = updatePassword($hashedPassword, $clientId);
    if ($updatePassword) {
      $_SESSION['message'] = "<p class='message'>" . $_SESSION['clientData']['clientFirstname'] . ", your password has been updated.</p>";

      // Query the database based on the client id
      $clientData = getClientInfo($clientId);

      // Store the array into the session
      $_SESSION['clientData'] = $clientData;

      header('Location: /phpmotors/accounts/');
      exit;
    } else {
      $message = "<span class='message'>Sorry " . $_SESSION['clientData']['clientFirstname'] . ", but we could not update your account information. Please try again.</span>";
      $_SESSION['message'] = $message;
      include '../view/client-update.php';
      exit;
    }
    break;
  case 'Register':
    include '../view/registration.php';
    break;
  case 'Login':
    include '../view/signin.php';
    break;
  case 'Logout':
    include '/phpmotors/index.php';
    break;
  case 'Update_Info':
    include '../view/client-update.php';
    break;
  default:
    include '../view/admin.php';
}
