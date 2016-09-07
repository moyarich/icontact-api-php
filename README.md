	
Examples on how to call the  iContact PHP API class

```php
	// Grab all contacts
	$oiContact->getContacts();
	
	// Grab a contact
	$oiContact->getContact(42094396);
	
	// Create a contact
	$oiContact->addContact('joe@shmoe.com', null, null, 'Joe', 'Shmoe', null, '123 Somewhere Ln', 'Apt 12', 'Somewhere', 'NW', '12345', '123-456-7890', '123-456-7890', null);
	
	
	// Get messages
	$oiContact->getMessages();
	
	// Create a list
	$oiContact->addList('somelist', 1698, true, false, false, 'Just an example list', 'Some List');
	
	// Subscribe contact to list
	$oiContact->subscribeContactToList(42094396, 179962, 'normal');
	
	// Grab all campaigns
	$oiContact->getCampaigns();
	
	// Create message
	$oiContact->addMessage('An Example Message', 585, '<h1>An Example Message</h1>', 'An Example Message', 'ExampleMessage', 33765, 'normal');
	
	// Schedule send
	$oiContact->sendMessage(array(33765), 179962, null, null, null, mktime(12, 0, 0, 1, 1, 2012));
	
	// Upload data by sending a filename (execute a PUT based on file contents)
	$oiContact->uploadData('/path/to/file.csv', 179962);

	
	// Upload data by sending a string of file contents
	$sFileData = file_get_contents('/path/to/file.csv');  // Read the file
	$oiContact->uploadData($sFileData, 179962); // Send the data to the API

  ///////////////////////////////////////////////////////////////////
	$contactId         = 68597784;     // The Id for a contact
	$contactList_1     = 261038;       // The ID of a list
	$contactList_from  = 179962;       // The ID of a list to move the contact from
	$contactList_to    = 177763;       // The ID of a list to move the contact to
	$contactEmail      = 'joe@shmoe.com'; // the email address of the contact
	$contactLastName   = 'Shmoe';      // the last name of the contact
  ///////////////////////////////////////////////////////////////////


	//get all the contacts in a list
	$oiContact->getContactsFromList($contactList_1);  
	

	//search a single field in a contact's history
	$oiContact->getContactByFieldValue('email',$contactEmail); 
	

	//search multiple fields in a contact's history
	$oiContact->searchContactHistory(array('email' => $contactEmail, 'lastName' => $contactLastName)); 
	

	//move contact from one list to another
	$oiContact->moveSubscriptionToList($contactId, $contactList_from,$contactList_to);  
```
