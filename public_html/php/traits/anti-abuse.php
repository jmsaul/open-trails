<?php

require_once(dirname(__DIR__) . "/lib/date-utilities.php");

/**
 * Trait anti-abuse
 *
 * records the user's IP address, browser type, and a timestamp (used in user, comment, & trail classes)
 *
 * @author Louis Gill <lgill7@cnm.edu>
 **/

trait AntiAbuse {
	/**
	 * ipAddress
	 * @var string $ipAddress
	 **/
	private $ipAddress;

	/**
	 * browser
	 * @var string $browser
	 **/
	private $browser;

	/**
	 * createDate
	 * @var DateTime $createDate
	 **/
	private $createDate;

	/**
	 * accessor method for ipAddress
	 *
	 * @return string value of ipAddress
	 **/
	public function getIpAddress() {
		return(inet_ntop($this->ipAddress));
	}

	/**
	 * mutator method for ipAddress
	 *
	 * @param string $newIpAddress new value of ipAddress
	 * @throws UnexpectedValueException if $newIpAddress is not valid
	 **/
	public function setIpAddress($newIpAddress) {
		if (@inet_pton($newIpAddress) !== false) {
			$newIpAddress = inet_pton($newIpAddress);
		} else if(@inet_ntop($newIpAddress) === false) {
			 throw(new UnexpectedValueException("ipAddress is not valid"));
		}
		$this->ipAddress = $newIpAddress;
	}

	/**
	 * accessor method for browser
	 *
	 * @return string value of browser
	 **/
	public function getBrowser() {
		return($this->browser);
	}

	/**
	 * mutator method for browser
	 *
	 * @param string $newBrowser new value of browser
	 * @throws UnexpectedValueException if $newBrowser is not a string or is insecure
	 * @throws LengthException if $newBrowser is more than 128 characters long
	 **/
	public function setBrowser($newBrowser) {
		$newBrowser = trim($newBrowser);
		$newBrowser = filter_var($newBrowser, FILTER_SANITIZE_STRING);
		if(empty($newBrowser) === true) {
			throw(new UnexpectedValueException("browser field is empty"));
		} else if(strlen($newBrowser) > 128) {
			throw(new LengthException("browser string length is too long"));
		}
		$this->browser = $newBrowser;
	}

	/**
	 * accessor method for createDate
	 *
	 * @return DateTime value for $createDate
	 **/
	public function getCreateDate() {
		return($this->createDate);
	}

	/**
	 * mutator method for createDate
	 *
	 * @param DateTime $newCreateDate new value of createDate
	 * @throws InvalidArgumentException if $newCreateDate is not a valid object or string
	 * @throws RangeException if $newCreateDate is a date that does not exist
	 * @throws Exception if $newCreateDate is invalid
	 **/
	public function setCreateDate($newCreateDate) {
		if($newCreateDate === null) {
			$this->createDate = new DateTime();
		}

		try {
			$newCreateDate = validateDate($newCreateDate);
		} catch(InvalidArgumentException $invalidArgument) {
			throw(new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range) {
			throw(new RangeException($range->getMessage(), 0, $range));
		} catch(Exception $exception) {
			throw(new Exception($exception->getMessage(), 0, $exception));
		}
		$this->createDate = $newCreateDate;
	}

	public function formatJsonFields() {
		$fields = [];
		$fields["ipAddress"] = inet_ntop($this->ipAddress);
		$fields["createDate"] = dateTimeToNg($this->createDate);
		return($fields);
	}
}