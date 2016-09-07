<?php
ini_set('display_errors', true);
ini_set('error_reporting', E_ALL);

// Load the iContact library
require_once('lib/iContactApi.php');



$appId = 'LCk8jDBpnwUWEDZvMc5B2IZX4Nk67EjGl';
$apiPassword = 'dAQQ#M$%sdf';
$apiUsername = 'lised@anon.com';




// Give the API your information
iContactApi::getInstance()
	->useSandbox(true)   // true use Icontact Sandbox ; false use official icontact 
	->setConfig(array(
	'appId'       => $appId, 
	'apiPassword' => $apiPassword, 
	'apiUsername' => $apiUsername
));

// Store the singleton
$oiContact = iContactApi::getInstance();



$iWelcomeMessageId = 1698;         // The email welcome message ID
$iMessageId        = 1695; 
$iCampaignId       = 585;          // The Id of a campaign
$sIncludeListIds   = array(33765); // An array of lists id that the messages should be sent to
$contactFile       = 'file.csv';  // path to csv file

$contactId         = 68597784;     // The Id for a contact
$contactList_1     = 261038;       // The ID of a list
$contactList_from  = 179962;       // The ID of a list to move the contact from
$contactList_to    = 177763;       // The ID of a list to move the contact to
$contactEmail      = 'joe@shmoe.com'; // the email address of the contact
$contactLastName   = 'Shmoe';      // the last name of the contact


// Catch any exceptions
function handleIcontactException(Exception $oException, $oiContact) { 
	// Dump errors
	echo '<br />Icontact Error Occured: ';
	var_dump($oiContact->getErrors());
	// Grab the last raw request data
	var_dump($oiContact->getLastRequest());
	// Grab the last raw response data
	var_dump($oiContact->getLastResponse());
	echo '<br />';
}


?>


<!DOCTYPE html>
<html>
	<head>
		<title>Icontact Example</title>
		<style>
			pre {
				overflow: auto;
				font-family: monospace,monospace;
				font-size: 1em;
				border: 1px solid #999;
				page-break-inside: avoid;
				background-color: #f5f5f5;
				border: 1px solid #ccc;
				border-radius: 4px;
				color: #333;
				display: block;
				font-size: 13px;
				line-height: 1.42857;
				margin: 0 0 15px;
				padding: 9.5px;
				word-break: break-all;
				word-wrap: break-word;
			}
		</style>
	</head>
	<body>
		<?php 

		//  are examples on how to call the  iContact PHP API class
		// Grab all contacts
		echo '<br />Grab all contacts: <pre>';

		try {
			var_dump($oiContact->getContacts());
		} catch (Exception $oException) {
			handleIcontactException($oException, $oiContact);
		}
		echo '<br /></pre><br /><br />';


		// Grab a contact
		echo '<br />Grab a contact: <pre>'; 
		try {
			var_dump($oiContact->getContact($contactId));
		} catch (Exception $oException) {
			handleIcontactException($oException, $oiContact);
		}
		echo '<br /></pre><br /><br />';



		// Create a contact
		echo '<br />Create a contact: <pre>';  
		try {
			var_dump($oiContact->addContact('joe@shmoe.com', null, null, 'Joe', 'Shmoe', null, '123 Somewhere Ln', 'Apt 12', 'Somewhere', 'NW', '12345', '123-456-7890', '123-456-7890', null));
		} catch (Exception $oException) {
			handleIcontactException($oException, $oiContact);
		}
		echo '<br /></pre><br /><br />';


		// Create message
		echo '<br />Create message: <pre>';
		try {
			var_dump($oiContact->addMessage('An Example Message', $iCampaignId, '<h1>An Example Message</h1>', 'An Example Message', 'ExampleMessage', $contactList_1, 'normal'));
		} catch (Exception $oException) {
			handleIcontactException($oException, $oiContact);
		}
		echo '<br /></pre><br /><br />';


		// Get messages
		echo '<br />Get messages: <pre>';
		try {
		var_dump($oiContact->getMessages());
		} catch (Exception $oException) {
			handleIcontactException($oException, $oiContact);
		}
		echo '<br /></pre><br /><br />';



		// Create a list
		echo '<br />Create a list: <pre>';
		try {
			var_dump($oiContact->addList('somelist', $iWelcomeMessageId, true, false, false, 'Just an example list', 'Some List'));
		} catch (Exception $oException) {
			handleIcontactException($oException, $oiContact);
		}
		echo '<br /></pre><br /><br />';


		// Subscribe contact to list
		echo '<br />Subscribe contact to list: <pre>';
		try {
			var_dump($oiContact->subscribeContactToList($contactId, $contactList_1, 'normal'));
		} catch (Exception $oException) {
			handleIcontactException($oException, $oiContact);
		}
		echo '<br /></pre><br /><br />';

		// Grab all campaigns
		echo '<br />Grab all campaigns: <pre>';
		try {
			var_dump($oiContact->getCampaigns());
		} catch (Exception $oException) {
			handleIcontactException($oException, $oiContact);
		}
		echo '<br /></pre><br /><br />';




		// Schedule send
		echo '<br />Schedule send: <pre>';
		try {
			var_dump($oiContact->sendMessage($sIncludeListIds, $iMessageId, null, null, null, mktime(12, 0, 0, 1, 1, 2012)));
		} catch (Exception $oException) {
			handleIcontactException($oException, $oiContact);
		}
		echo '<br /></pre><br /><br />';


		// Upload data by sending a filename (execute a PUT based on file contents)
		echo '<br />Upload data by sending a filename (execute a PUT based on file contents):<br /> https://app.icontact.com/icp/core/help/docs/view/en-us/icontact/import-export-lists/create-a-comma-separated-value-csv-file <br /><pre>';
		try {
			var_dump($oiContact->uploadData($contactFile, $contactList_1));
		} catch (Exception $oException) {
			handleIcontactException($oException, $oiContact);
		}
		echo '<br /></pre><br /><br />';

		// Upload data by sending a string of file contents
		$sFileData = file_get_contents($contactFile);  // Read the file
		echo '<br />Upload data by sending a string of file contents: <pre>';
		try {
			var_dump($oiContact->uploadData($sFileData, $contactList_1)); // Send the data to the API
		} catch (Exception $oException) {
			handleIcontactException($oException, $oiContact);
		}
		echo '<br /></pre><br /><br />';




		//get all the contacts in a list
		echo '<br />get all the contacts in a list: <pre>';
		try {
			var_dump($oiContact->getContactsFromList($contactList_1));  
		} catch (Exception $oException) {
			handleIcontactException($oException, $oiContact);
		}
		echo '<br /></pre><br /><br />';


		//search a single field in a contact's history
		echo '<br />search a single field in a contact\'s history: <pre>';
		try {
			var_dump($oiContact->getContactByFieldValue('email',$contactEmail)); 
		} catch (Exception $oException) {
			handleIcontactException($oException, $oiContact);
		}
		echo '<br /></pre><br /><br />';

		//search multiple fields in a contact's history
		echo '<br />search multiple fields in a contact\'s history: <pre>';
		try {
		var_dump($oiContact->searchContactHistory(array('email' => $contactEmail, 'lastName' => $contactLastName))); 
		} catch (Exception $oException) {
			handleIcontactException($oException, $oiContact);
		}
		echo '<br /></pre><br /><br />';

		//move contact from one list to another
		echo '<br />move contact from one list to another: <pre>';
		try {
			var_dump($oiContact->moveSubscriptionToList($contactId, $contactList_from,$contactList_to));  
		} catch (Exception $oException) {
			handleIcontactException($oException, $oiContact);
		}
		echo '<br /></pre><br /><br />';

		
		?>


	</body>
</html>
