<?php
include_once "src/Client.php";
include_once "src/GetResponseAPI3.class.php";

try {
    $amo = new \AmoCRM\Client('smm0987', 'e.koval@ufox.by', '0a368ed4dbcd030c9251390e8971ee5f');
    $contact = $amo->contact;
    $account = $amo->account;
    $contact['name'] = $_POST['name'];
    $contact['tags'] = ['Lavina'];
    $contact->addCustomField(1045242, [
        [$_POST['phone'], "MOB"]
    ]);
    $contact->addCustomField(1045244, [
        [$_POST['email'], "OTHER"]
    ]);
    $contact->apiAdd();

    $getresponse = new GetResponseAPI3('2cfa0ea7b69f0f50c0b31b706e2430de');
    $getresponse->addContact(array(
    'name'              => $_POST['name'],
    'email'             => $_POST['email'],
    'dayOfCycle'        => 0,
    'campaign'          => array('campaignId' => 'nJNiz'),
    ));

	header('Location: https://bezkassira.by/3-h_dnevnyi_intensiv_lavina-1908/');
} catch (\AmoCRM\Exception $e) {
    printf('Error (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
}
