-- Query 1
INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword, clientLevel, comment) Values
('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 1, 'I am the real Ironman');

-- Query 2
UPDATE clients SET clientLevel = 3 WHERE clientFirstname = 'Tony' AND clientLastname = 'Stark';

-- Query 3
UPDATE inventory
SET invDescription = REPLACE(invDescription, 'small interior', 'spacious interior')
WHERE invMake = 'GM' AND invModel = 'Hummer';

-- Query 4
SELECT invModel, classificationName
FROM carclassification
INNER JOIN inventory ON 
carclassification.classificationId = inventory.classificationId
WHERE carclassification.classificationName = 'SUV';

-- Query 5
DELETE FROM inventory WHERE invMake = 'Jeep' AND invModel = 'Wrangler';

-- Query 6
UPDATE inventory SET invImage=concat('/phpmotors', invImage), invThumbnail=concat('/phpmotors', invThumbnail);

