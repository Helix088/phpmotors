<?php
// Vehicles PHP Motors Model
getClassifications();

function regClassification($classificationName)
{
  $db = phpmotorsConnect();
  $sql = 'INSERT INTO carclassification (classificationName) VALUES (:classificationName)';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

function regVehicle($classificationId, $invId, $invYear, $invMake, $invModel, $invDescription, $invPrice, $invStock, $invMiles, $invColor)
{
  $db = phpmotorsConnect();
  $sql = 'INSERT INTO inventory (classificationId, invId, invYear, invMake, invModel, invDescription, invPrice, invStock, invMiles, invColor) VALUES (:classificationId, :invId, :invYear, :invMake, :invModel, :invDescription, :invPrice, :invStock, :invMiles, :invColor)';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
  $stmt->bindValue(':invId',$invId, PDO::PARAM_STR);
  $stmt->bindValue(':invYear', $invYear, PDO::PARAM_INT);
  $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
  $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
  $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
  $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_INT);
  $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
  $stmt->bindValue(':invMiles', $invMiles, PDO::PARAM_INT);
  $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

// Get vehicles by classificationId
function getInventoryByClassification($classificationId)
{
  $db = phpmotorsConnect();
  $sql = 'SELECT * FROM inventory WHERE classificationId = :classificationId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
  $stmt->execute();
  $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $inventory;
}

// Get vehicle information by invId
function getInvItemInfo($invId)
{
  $db = phpmotorsConnect();
  $sql = 'SELECT inventory.invId, invYear, invMake, invModel, invDescription, imgPath, invPrice, invStock, invMiles, invColor, classificationId FROM inventory JOIN images ON inventory.invId = images.invId WHERE inventory.invId = :invId AND imgPrimary = "1"';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
  $stmt->execute();
  $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $invInfo;
}

// Update Vehicles
function modifyVehicle($classificationId, $invYear, $invMake, $invModel, $invDescription, $invPrice, $invStock, $invMiles, $invColor, $invId)
{
  $db = phpmotorsConnect();
  $sql = 'UPDATE inventory SET classificationId = :classificationId, invYear = :invYear, invMake = :invMake, invModel = :invModel, invDescription = :invDescription, invPrice = :invPrice, invStock = :invStock, invMiles = :invMiles, invColor = :invColor WHERE invId = :invId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
  $stmt->bindValue(':invYear', $invYear, PDO::PARAM_INT);
  $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
  $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
  $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
  $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_INT);
  $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
  $stmt->bindValue(':invMiles', $invMiles, PDO::PARAM_INT);
  $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

// Delete Vehicles
function deleteVehicle($invId)
{
  $db = phpmotorsConnect();
  $sql = 'DELETE FROM inventory WHERE invId = :invId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

// Find Vehicles by classificationName
function getVehiclesByClassification($classificationName) {
  $db = phpmotorsConnect();
  $sql = 'SELECT inventory.invId, invYear, invMake, invModel, invDescription, imgPath, invPrice, invStock, invMiles, invColor, classificationId FROM inventory JOIN images ON inventory.invId = images.invId WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName) AND imgPath LIKE "%-tn%" AND imgPrimary = "1"';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
  $stmt->execute();
  $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $vehicles;
}

// Get information for all vehicles
function getVehicles() {
  $db = phpmotorsConnect();
  $sql = 'SELECT invId, invMake, invModel FROM inventory';
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $invInfo;
}