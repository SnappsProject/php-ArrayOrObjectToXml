<?php
function xml_encode($mixed, $domElement=null, $DOMDocument=null) 
{
    if (is_null($DOMDocument)) {
	$DOMDocument = new DOMDocument('1.0', 'UTF-8');
	$DOMDocument->formatOutput = true;
	$this->xml_encode($mixed, $DOMDocument, $DOMDocument);
	$this->setXmlHeader(); 
	echo $DOMDocument->saveXML();
    }
    else {
	if (is_array($mixed)) {
	    foreach ($mixed as $index => $mixedElement) {
		if (is_int($index)) {
		    if ($index === 0) {
			$node = $domElement;
		    }
		    else {
			$node = $DOMDocument->createElement($domElement->tagName);
			$domElement->parentNode->appendChild($node);
		    }
		}
		else {
		    $plural = $DOMDocument->createElement($index);
		    $domElement->appendChild($plural);
		    $node = $plural;
		}

		$this->xml_encode($mixedElement, $node, $DOMDocument);
	    }
	}
	else {
	    $domElement->appendChild($DOMDocument->createTextNode($mixed));
	}
    }
}
