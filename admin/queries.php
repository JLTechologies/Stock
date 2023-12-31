<?php
$sitename = "SELECT * FROM settings";
$userlist = "SELECT * FROM users INNER JOIN groups ON users.groupID = groups.groupID";
$grouplist = "SELECT * FROM groups";
$brandlist = "SELECT * FROM brands";
$brandcontactlist = "SELECT * FROM brandcontact";
$countries = "SELECT * FROM countries";
$locations = "SELECT * FROM locations INNER JOIN countries ON locations.countryId = countries.countryid";
$measurements = "SELECT * FROM measure";
$rootcategories = "SELECT * FROM rootcategories";
$childcategories = "SELECT * FROM childcategories INNER JOIN rootcategories ON childcategories.rootcategoryID = rootcategories.categoryid";
$sortbyroot = "SELECT * FROM rootcategories ORDER BY categoryid";
$sortbychild = "SELECT * FROM childcategories INNER JOIN rootcategories ON childcategories.rootcategoryID = rootcategories.categoryid ORDER BY childcategoryID";
$itemlist = "SELECT * FROM items INNER JOIN measure on items.measureID = measure.measureID INNER JOIN amount ON items.itemID = amount.itemID INNER JOIN locations on amount.locationID = locations.locationID INNER JOIN brands ON items.brandID = brands.brandID INNER JOIN childcategories ON childcategories.childcategoryID = items.childcategoryID INNER JOIN rootcategories ON childcategories.rootcategoryID = rootcategories.categoryid GROUP BY childcategories.rootcategoryID, items.childcategoryID;";
$itemlist1 = "SELECT * FROM items INNER JOIN brands on items.brandID = brands.brandID";
$settings = "SELECT * FROM settings";
$permissionslist = "SELECT * FROM permissionslist";
$sites = "SELECT * FROM sites INNER JOIN countries ON sites.countryID = countries.countryid";
$countcowcodes = "SELECT COUNT(cowcode) 'amountsites' FROM sites";
$countusers = "SELECT COUNT(name) 'amountusers' FROM users";
$countitems = "SELECT COUNT(name) 'amountitems' FROM items";
$countlocations = "SELECT COUNT(locationname) 'amountlocations' FROM locations";
$sortings = "SELECT * FROM sorting";
?>