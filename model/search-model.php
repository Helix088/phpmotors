<?php

$output = '';
// Search through vehicles based on user input
function vehicleSearch($search) {
    $db = phpmotorsConnect();
    $sql = "SELECT inventory.invId, invYear, invMake, invModel, invDescription, invPrice, invMiles, invColor, classificationName, imgPath FROM inventory JOIN carclassification ON inventory.classificationId = carclassification.classificationId JOIN images ON images.invId = inventory.invId WHERE CONCAT(invYear,invMake,invModel,invDescription,invColor) LIKE CONCAT('%', :search, '%') AND imgPath LIKE '%-tn%' AND imgPrimary = 1 ORDER BY invModel ASC";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':search', $search, PDO::PARAM_STR);
    $stmt->execute();
    $searchInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $searchInfo;
}

?>