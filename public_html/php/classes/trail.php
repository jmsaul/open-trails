<?php
require_once(dirname(dirname(dirname(__DIR__))) . "/vendor/autoload.php");
require_once("autoload.php");

/**
 * Class trail for the website TrailQuail.com
 * This class can be used for any trail mapping application
 * The Trail class contains the following attributes :
 *
 * - trailId, the primary key
 * - submitTrailId
 * - userId, foreign key
 * - trailAccessibility
 * - trailAmenities
 * - trailCondition
 * - trailDescription
 * - trailDifficulty
 * - trailDistance
 * - trailSubmissionType
 * - trailTerrain
 * - trailName
 * - trailTraffic
 * - trailUse
 * - trailUuid
 *
 * @author Matt Harris <mattharr505@gmail.com> and Trail Quail<trailquailabq@gmail.com>
 **/
class Trail implements JsonSerializable {
		use AntiAbuse;
		/**
		 * id for the trail; as stated above, this is the primary key
		 * @var int trailId
		 **/
		private $trailId;

		/**
		 * id for the content of the submission of the trail object
		 * @var int submitTrailID
		 **/
		private $submitTrailId;

		/**
		 * id of user that submits to the trail
		 * @var int userId
		 **/
		private $userId;

		/**
		 * accessibility info for trail
		 * @var string trailAccessibility
		 **/
		private $trailAccessibility;

		/**
		 *information on amenities on trail
		 * @var string trailAmenities
		 */
		private $trailAmenities;

		/**
		 * information on the trail condition
		 * @var string trailConditions
		 **/
		private $trailCondition;

		/**
		 * information describing the trail
		 * @var string trailDescription
		 **/
		private $trailDescription;

		/**
		 * difficulty rating of trail
		 * @var int trailDifficulty
		 **/
		private $trailDifficulty;

		/**
		 * length of the trail
		 * @var float trailDistance
		 **/
		private $trailDistance;

		/**
		 * content of submission made to trail
		 * @var int trailSubmissionType
		 **/
		private $trailSubmissionType;

		/**
		 * type of terrain on the trail
		 * @var string trailTerrain
		 **/
		private $trailTerrain;

		/**
	 	* name of trail
	 	* @var string trailName
	 	**/
		private $trailName;

		/**
		 *amount of traffic on trail
		 *@var string trailTraffic
		 **/
		private $trailTraffic;

		/**
		 * main use of the trail (hiking, cycling, skiing)
		 * @var string trailUse
		 **/
		private $trailUse;

		/**
		 * id for the submission on the trail object. Exists so the primary key does not have to get updated.
		 * @var string trailUuId
	 	**/
		private $trailUuId;

		/**
		 *constructor for trail object.
		 *
		 *
		 * @param $newTrailId
		 * @param $newSubmitTrailId
		 * @param $newUserId
		 * @param $newBrowser
		 * @param $newIpAddress
		 * @param $newCreateDate
		 * @param $newTrailAccessibility
		 * @param $newTrailAmenities
		 * @param $newTrailCondition
		 * @param $newTrailDescription
		 * @param $newTrailDifficulty
		 * @param $newTrailDistance
		 * @param $newTrailSubmissionType
		 * @param $newTrailTerrain
		 * @param $newTrailName
		 * @param $newTrailTraffic
		 * @param $newTrailUse
		 * @param $newTrailUuId
		 * @throws InvalidArgumentException if data types are not valid
		 * @throws RangeException if values are out of bounds
		 * @throws Exception if some other exception is thrown
		 **/
		public function __construct($newTrailId, $newSubmitTrailId, $newUserId,$newBrowser, $newCreateDate,
		$newIpAddress, $newTrailAccessibility,$newTrailAmenities, $newTrailCondition, $newTrailDescription, $newTrailDifficulty,
		$newTrailDistance, $newTrailSubmissionType, $newTrailTerrain, $newTrailName, $newTrailTraffic, $newTrailUse, $newTrailUuId) {
			try{
				$this->setTrailId($newTrailId);
				$this->setSubmitTrailId($newSubmitTrailId);
				$this->setUserId($newUserId);
				$this->setBrowser($newBrowser);
				$this->setCreateDate($newCreateDate);
				$this->setIpAddress($newIpAddress);
				$this->setTrailAccessibility($newTrailAccessibility);
				$this->setTrailAmenities($newTrailAmenities);
				$this->setTrailCondition($newTrailCondition);
				$this->setTrailDescription($newTrailDescription);
				$this->setTrailDifficulty($newTrailDifficulty);
				$this->setTrailDistance($newTrailDistance);
				$this->setTrailSubmissionType($newTrailSubmissionType);
				$this->setTrailTerrain($newTrailTerrain);
				$this->setTrailName($newTrailName);
				$this->setTrailTraffic($newTrailTraffic);
				$this->setTrailUse($newTrailUse);
				$this->setTrailUuId($newTrailUuId);
			}catch(InvalidArgumentException $invalidArgument){
					//rethrow the exception to the caller
					throw(new InvalidArgumentException($invalidArgument->getMessage(),0, $invalidArgument));
			}catch(RangeException $range){
					//rethrow the exception to the caller
					throw(new RangeException($range->getMessage(),0,$range));
			}catch(Exception $exception){
					//rethrow the exception to the caller
					throw(new exception($exception->getMessage(),0, $exception));
			}
	}

		/**
		 * accessor method for trailId
		 *
		 * @return mixed value of trailId
		**/
			public function getTrailId() {
				return ($this->trailId);
			}

		/**
		 * mutator method for trailId
		 *
		 * @param mixed $newTrailId
		 **/
			public function setTrailId($newTrailId){
				$this->trailId = Filter::filterInt($newTrailId,"Trail Id", true);
			}


		/**
		 * accessor method for submitTrailId
		 *
		 * @return int value of submitTrailId
		**/
			public function getSubmitTrailId() {
				return ($this->submitTrailId);
			}

		/**
		 * mutator method for submitTrailId
		 *
		 * @param int $newSubmitTrailId
		 **/
			public function setSubmitTrailId($newSubmitTrailId) {
				$this->submitTrailId = Filter::filterInt($newSubmitTrailId, "Submit Trail Id", true);
			}

		/**
		 * accessor method for userId
		 *
		 * @return int value of userId
		 **/
			public function getUserId() {
				return $this->userId;
			}

		/**
		 * mutator method for userId
		 *
		 * @param int $newUserId
		 **/
			public function setUserId($newUserId){
				$this->userId = Filter::filterInt($newUserId,"User Id", false);
			}

		/**
		 * accessor method for trailAccessibility
		 *
		 * @return string value of trailAccessibility
		 **/
			public function getTrailAccessibility() {
				return ($this->trailAccessibility);
			}

		/**
		 *mutator method for trailAccessibility
		 *
		 *@param string $newTrailAccessibility new value of trailAccessibility
		 **/
			public function setTrailAccessibility($newTrailAccessibility) {
				$this->trailAccessibility = Filter::filterString($newTrailAccessibility,"Trail Accessibility", 32);
			}

		/**
		 * accessor method for trailAmenities
		 *
		 * @return string value of trailAmenities
		 **/
			public function getTrailAmenities() {
				return ($this->trailAmenities);
			}

		/**
		 *mutator method for trailAmenities
		 *
		 *@param string $newTrailAmenities information on trail amenities
		 **/
			public function setTrailAmenities($newTrailAmenities) {
			$this->trailAmenities = Filter::filterString($newTrailAmenities,"Trail Amenities", 256);
			}

		/**
		 * accessor method for trailCondition
		 *
		 * @return string value of trailCondition
		 **/
			public function getTrailCondition() {
				return ($this->trailCondition);
			}

		/**
		 * mutator method for trailCondition
		 *
		 * @param string $newTrailCondition information on trail condition
		 **/
			public function setTrailCondition($newTrailCondition) {
				$this->trailCondition = Filter::filterString($newTrailCondition,"Trail Condition", 256);
			}

		/**
		 * accessor method for trailDescription
		 *
		 * @return string value of trailDescription
		 **/
			public function getTrailDescription() {
				return ($this->trailDescription);
			}

		/**
		 * mutator method for trailDescription
		 *
		 *@param string $newTrailDescription information describing the trail
		 **/
			public function setTrailDescription($newTrailDescription) {
				$this->trailDescription = Filter::filterString($newTrailDescription, "Trail Description", 512);
			}

		/**
		 * accessor method for trailDifficulty
		 *
		 * @return int value of trailDifficulty
		 **/
			public function getTrailDifficulty() {
				return ($this->trailDifficulty);
			}

		/**
		 * mutator method for trailDifficulty
		 *
		 * @param int $newTrailDifficulty
		 **/
			public function setTrailDifficulty($newTrailDifficulty) {
				$this->trailDifficulty = Filter::filterInt ($newTrailDifficulty,"Trail Difficulty", true);
			}

		/**
		 * accessor method for trailDistance
		 *
		 * @return float value of trailDistance
		 **/
			public function getTrailDistance() {
				return ($this->trailDistance);
			}

		/**
		 *mutator method for trailDistance
		 *
		 * @param float $newTrailDistance
		 **/
		public function setTrailDistance($newTrailDistance) {
			$this->trailDistance = Filter::filterDouble($newTrailDistance, "Trail Distance");
		}

		/**
		 * accessor method for trailName
		 *
		 * @return string value of trailName
		 **/
		public function getTrailName() {
			return($this->trailName);
		}

		/**
		 * mutator method for trailName
		 *
		 * @param $newTrailName
		 * @return string
		 **/
		public function setTrailName($newTrailName) {
			$this->$newTrailName = Filter::filterString($newTrailName, "Trail Name", 64);
		}

		/**
		 * accessor method for trailSubmissionType
		 *
		 * @return int value of trailSubmissionType
		 */
			public function getTrailSubmissionType() {
				return ($this->trailSubmissionType);
			}

		/**
		 * mutator method for trailSubmissionType
		 *
		 * @param int $newTrailSubmissionType
		 * @return int value of trailSubmissionType
		**/
			public function setTrailSubmissionType($newTrailSubmissionType){
				$newTrailSubmissionType = filter_var($newTrailSubmissionType, FILTER_VALIDATE_INT);
				if($newTrailSubmissionType === false) {
					throw(new InvalidArgumentException("Trail Submission Type is not a valid integer"));
				}

				// Verify the new int is positive
				if($newTrailSubmissionType < 0) {
					throw(new RangeException("Trail Submission Type not positive"));
				}

				// Make sure the int is not greater than 2
				if($newTrailSubmissionType > 2) {
					throw(new InvalidArgumentException("Trail Submission Type cannot be greater than 2"));
				}

				//convert and store the trail submission type
				$this->trailSubmissionType=intval($newTrailSubmissionType);
			}

		/**
		 * accessor method for trailTerrain
		 *
		 * @return string value of trailTerrain
		 */
			public function getTrailTerrain() {
				return ($this->trailTerrain);
			}

		/** mutator method for trailTerrain
		 *
		 * @param string
		**/
			public function setTrailTerrain($newTrailTerrain) {
			$this->$newTrailTerrain = Filter::filterString($newTrailTerrain,"Trail Terrain", 128);
			}

		/**
		 * accessor method for trailTraffic
		 *
		 * @return string value of trailTraffic
		**/
			public function getTrailTraffic() {
				return($this->trailTraffic);
			}

	  	/**
		 * mutator method for trailTraffic
		 *
		 * @param string
		**/
			public function setTrailTraffic($newTrailTraffic) {
				$this->$newTrailTraffic = Filter::filterString($newTrailTraffic,"Trail Traffic", 16);
			}

		/**
		 * accessor method for trailUse
		 *
		 * @return string value of trailUse
		**/
			public function getTrailUse(){
				return($this->trailUse);
			}

		/**
		 * mutator method for trailUse
		 *
		 * @param string $newTrailUse
		**/
			public function setTrailUse($newTrailUse) {
				$this->$newTrailUse = Filter::filterString($newTrailUse,"Trail Use", 64);
		}

		/**
		 * accessor method for trailUuId
		 *
		 * @return int value of trailUuId
		**/
		public function getTrailUuId(){
			return ($this->trailUuId);
		}

		/**
		 * mutator method for trailUuId
		 *
	 	 * @param string $newTrailUuId
	 	**/
	public function setTrailUuId($newTrailUuId){
		$this->trailUuId = Filter::filterString($newTrailUuId, "Trail UuId", 36);
	}

		/**
		 * inserts this trail into mySQL
		 *
		 * @param PDO $pdo pointer to PDO connection, by reference
		 * @throws PDOException when mySQL related errors occur
		**/
		public function insert(PDO &$pdo) {
			if($this->trailId !== null) {
				throw (new PDOException("not a new trail"));
			}

			//create query template
			$query = "INSERT INTO trail(userId, submitTrailId, browser, createDate, ipAddress,
trailAccessibility, trailAmenities, trailCondition,trailDescription, trailDifficulty, trailDistance, trailSubmissionType,
trailTerrain, trailName, trailTraffic, trailUse, trailUuid) VALUES (:userId, :submitTrailId, :browser, :createDate,
:ipAddress, :trailAccessibility, :trailAmenities, :trailCondition, :trailDescription, :trailDifficulty, :trailDistance,
:trailSubmissionType, :trailTerrain, :trailName, :trailTraffic, :trailUse, :trailUuid)";
				$statement = $pdo->prepare($query);

				//bind the member variables to the placeholders in the template
				$parameters = array("userId" => $this->getUserId(), "submitTrailId" => $this->getTrailId(), "browser" => $this->getBrowser(),
"createDate" => $this->getCreateDate(), "ipAddress" => $this->getIpAddress(), "trailAccessibility" => $this->getTrailAccessibility(), "trailAmenities" => $this->getTrailAmenities(),
"trailCondition" => $this->getTrailCondition(), "trailDescription" =>$this->getTrailDescription(), "trailDifficulty" =>$this->getTrailDifficulty(), "trailDistance" =>$this->getTrailDistance(),
"trailSubmissionType" =>$this->getTrailSubmissionType(), "trailTerrain" =>$this->getTrailTerrain(), "trailName" =>$this->getTrailName(), "trailTraffic" =>$this->getTrailTraffic(),
"trailUse" =>$this->getTrailUse(), "trailUuid" =>$this->getTrailUuId());
				$statement->execute($parameters);

				//update the null trailId with what mySQL has generated
				$this->setTrailId(intval($pdo->lastInsertId()));
			}

		/**
		 * Deletes this trail from mySQL
		 *
		 * @param PDO $pdo pointer to PDO connection, by reference
		 * @throws PDOException when mySQL related errors occur
		**/
		public function delete(PDO &$pdo) {
			//make sure this trail already exists
			if($this->getTrailId() === null) {
				throw(new PDOException("Unable to delete a restaurant that does not exist"));
			}

			//create query template
			$query = "DELETE FROM trail WHERE trailId = :trailId";
			$statement = $pdo->prepare($query);

			//bind the member variables to the placeholders in the templates
			$parameters = array("trailId" => $this->getTrailId());
			$statement->execute($parameters);
			}

			/**
			 * updates this trail in mySQL
			 *
			 * @param PDO $pdo pointer to PDO connection, by reference
			 * @throws PDOException when mySQL related errors occur
			**/
			public function update(PDO &$pdo) {
				//make sure this trail exists
				if($this->getTrailId() === null) {
					throw(new PDOException ("unable to update a trail that does not exist"));
				}

				//create a query template
				$query ="UPDATE trail SET userId =:userId, submitTrailId =:submitTrailId, browser =:browser, createDate =:createDate, ipAddress =:ipAddress,
trailAccessibility =:trailAccessibility, trailAmenities =:trailAmenities, trailCondition =:trailCondition, trailDescription =:trailDescription, trailDifficulty =:trailDifficulty,
trailDistance =:trailDistance, trailSubmissionType =:trailSubmissionType,trailTerrain =:trailTerrain, trailName =:trailName, trailTraffic =:trailTraffic, trailUse =:trailUse, trailUuid =:trailUuid";
				$statement =$pdo->prepare($query);

				//bind the member variables to the placeholders in the templates
				$parameters = array("userId" => $this->getUserId(), "submitTrailId" => $this->getTrailId(), "browser" => $this->getBrowser(),
				"createDate" => $this->getCreateDate(), "ipAddress" => $this->getIpAddress(), "trailAccessibility" => $this->getTrailAccessibility(), "trailAmenities" => $this->getTrailAmenities(),
				"trailCondition" => $this->getTrailCondition(), "trailDescription" =>$this->getTrailDescription(), "trailDifficulty" =>$this->getTrailDifficulty(), "trailDistance" =>$this->getTrailDistance(),
				"trailSubmissionType" =>$this->getTrailSubmissionType(), "trailTerrain" =>$this->getTrailTerrain(), "trailName" =>$this->getTrailName(), "trailTraffic" =>$this->getTrailTraffic(),
				"trailUse" =>$this->getTrailUse(), "trailUuid" =>$this->getTrailUuId());
				$statement->execute($parameters);
			}

		/**
		 * gets the trail by trailId
		 *
		 * @param PDO $pdo pointer to PDO connection, by reference
		 * @param int $trailId trailID to search for
		 * @return mixed trail found or null if not found
		 * @throws PDOException when mySQL related errors occur
		 *
		**/
	public static function getTrailById (PDO &$pdo, $trailId) {
		//sanitize the trailId before searching
		try {
			$trailId = Filter::filterInt($trailId, "trailId");
		} catch (InvalidArgumentException $invalidArgument ) {
			throw (new PDOException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range){
			throw(new PDOException($range->getMessage(), 0, $range));
		} catch (Exception $exception){
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}

		//create query template
		$query = "SELECT userId, submitTrailId, browser, createDate, ipAddress,trailAccessibility, trailAmenities, trailCondition,trailDescription, trailDifficulty, trailDistance, trailSubmissionType,
trailTerrain, trailName, trailTraffic, trailUse, trailUuid FROM trail WHERE trailId = :trailId";
		$statement = $pdo->prepare($query);

		//bind trailId to placeholder
		$parameters = array("trailId" => $trailId);
		$statement->execute($parameters);

		//grab the trail from mySQL
		try {
			$trail = null;
			$statement->setFetchMode(PDO::FETCH_ASSOC);
			$row = $statement->fetch();

			if($row !== false) {
				//new trail ($trailId, $userId, $submitTrailId, $browser, $createDate, $ipAddress, $trailAccessibility, $trailAmenities, $trailCondition,$trailDescription, $trailDifficulty, $trailDistance, $trailSubmissionType,$trailTerrain, $trailName, $trailTraffic, $trailUse, $trailUuid)
				$trail = new Trail ($row["trailId"], $row["userId"], $row["submitTrailId"], $row["browser"], $row["createDate"], $row["ipAddress"], $row["trailAccessibility"], $row["trailAmenities"],
			$row["trailCondition"], $row["trailDescription"], $row["trailDifficulty"], $row["trailDistance"], $row ["trailSubmission"], $row["trailTerrain"], $row["trailName"], $row["trailTraffic"],
			$row["trailUse"], $row["trailUuid"]);
			}
			}catch (Exception $e) {
			//if the row could not be converted, rethrow it
			throw (new PDOException($e->getMessage(), 0, $e));
		}

		return($trail);
	}

	/**
	 * gets the trail by userId
	 *
	 * @param PDO $pdo pointer to PDO connection, by reference
	 * @param int $userId userId to search for
	 * @return mixed trail found or null if not found
	 * @throws PDOException when mySQL related errors occur
	 *
	 **/
	public static function getTrailByUserId (PDO &$pdo, $userId) {
		//sanitize the userId before searching
		try {
			$userId = Filter::filterInt($userId, "userId");
		} catch (InvalidArgumentException $invalidArgument ) {
			throw (new PDOException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range){
			throw(new PDOException($range->getMessage(), 0, $range));
		} catch (Exception $exception){
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}

		//create query template
		$query = "SELECT userId, submitTrailId, browser, createDate, ipAddress,trailAccessibility, trailAmenities, trailCondition,trailDescription, trailDifficulty, trailDistance, trailSubmissionType,
trailTerrain, trailName, trailTraffic, trailUse, trailUuid FROM trail WHERE userId = :userId";
		$statement = $pdo->prepare($query);

		//bind userId to placeholder
		$parameters = array("userId" => $userId);
		$statement->execute($parameters);

		//build an array of trails
		$trails = new SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		while (($row = $statement->fetch()) !== false) {
			try {
				//new trail ($trailId, $userId, $submitTrailId, $browser, $createDate, $ipAddress, $trailAccessibility, $trailAmenities, $trailCondition,$trailDescription, $trailDifficulty, $trailDistance, $trailSubmissionType,$trailTerrain, $trailName, $trailTraffic, $trailUse, $trailUuid)
				$trail = new Trail($row["trailId"], $row["userId"], $row["submitTrailId"], $row["browser"], $row["createDate"], $row["ipAddress"], $row["trailAccessibility"], $row["trailAmenities"],
						$row["trailCondition"], $row["trailDescription"], $row["trailDifficulty"], $row["trailDistance"], $row ["trailSubmission"], $row["trailTerrain"], $row["trailName"], $row["trailTraffic"],
						$row["trailUse"], $row["trailUuid"]);
				$trails[$trails->key()] = $trail;
				$trails->next();
			} catch (Exception $e) {
				//if the row couldn't be converted, rethrow it
				throw(new PDOException($e->getMessage(),0 , $e));
			}
		}
		return($trails);
	}

	/**
	 * gets the trail by submitTrailId
	 *
	 * @param PDO $pdo pointer to PDO connection, by reference
	 * @param int $submitTrailId submitTrailId to search for
	 * @return mixed trail found or null if not found
	 * @throws PDOException when mySQL related errors occur
	 *
	 **/
	public static function getTrailBySubmitTrailId (PDO &$pdo, $submitTrailId) {
		//sanitize the trailSubmitId before searching
		try {
			$submitTrailId = Filter::filterInt($submitTrailId, "submitTrailId");
		} catch (InvalidArgumentException $invalidArgument ) {
			throw (new PDOException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range){
			throw(new PDOException($range->getMessage(), 0, $range));
		} catch (Exception $exception){
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}

		//create query template
		$query = "SELECT userId, submitTrailId, browser, createDate, ipAddress,trailAccessibility, trailAmenities, trailCondition,trailDescription, trailDifficulty, trailDistance, trailSubmissionType,
			trailTerrain, trailName, trailTraffic, trailUse, trailUuId FROM trail WHERE submitTrailId = :submitTrailId";
		$statement = $pdo->prepare($query);

		//bind submitTrailId to placeholder
		$parameters = array("submitTrailId" => $submitTrailId);
		$statement->execute($parameters);

		//build an array of trails
		$trails = new SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		while (($row = $statement->fetch()) !== false) {
			try {
				//new trail ($trailId, $userId, $submitTrailId, $browser, $createDate, $ipAddress, $trailAccessibility, $trailAmenities, $trailCondition,$trailDescription, $trailDifficulty, $trailDistance, $trailSubmissionType,$trailTerrain, $trailName, $trailTraffic, $trailUse, $trailUuId)
				$trail = new Trail($row["trailId"], $row["userId"], $row["submitTrailId"], $row["browser"], $row["createDate"], $row["ipAddress"], $row["trailAccessibility"], $row["trailAmenities"],
						$row["trailCondition"], $row["trailDescription"], $row["trailDifficulty"], $row["trailDistance"], $row ["trailSubmission"], $row["trailTerrain"], $row["trailName"], $row["trailTraffic"],
						$row["trailUse"], $row["trailUuId"]);
				$trails[$trails->key()] = $trail;
				$trails->next();
			} catch (Exception $e) {
				//if the row couldn't be converted, rethrow it
				throw(new PDOException($e->getMessage(),0 , $e));
			}
		}
		return($trails);
	}


	/**
	 * gets the trail by browser
	 *
	 * @param PDO $pdo pointer to PDO connection, by reference
	 * @param string $browser browser to search for
	 * @return mixed trail found or null if not found
	 * @throws PDOException when mySQL related errors occur
	 *

	public static function getTrailByBrowser (PDO &$pdo, $browser) {
		//sanitize the browser before searching
		try {
			$browser = Filter::filterString($browser, "browser", 128);
		} catch (InvalidArgumentException $invalidArgument ) {
			throw (new PDOException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range){
			throw(new PDOException($range->getMessage(), 0, $range));
		} catch (Exception $exception){
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}

		//create query template
		$query = "SELECT browser, submitTrailId, browser, createDate, ipAddress,trailAccessibility, trailAmenities, trailCondition,trailDescription, trailDifficulty, trailDistance, trailSubmissionType,
trailTerrain, trailName, trailTraffic, trailUse, trailUuId FROM trail WHERE browser = :browser";
		$statement = $pdo->prepare($query);

		//bind browser to placeholder
		$parameters = array("browser" => $browser);
		$statement->execute($parameters);

		//build an array of trails
		$trails = new SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		while (($row = $statement->fetch()) !== false) {
			try {
				//new trail ($trailId, $userId, $submitTrailId, $browser, $createDate, $ipAddress, $trailAccessibility, $trailAmenities, $trailCondition,$trailDescription, $trailDifficulty, $trailDistance, $trailSubmissionType,$trailTerrain, $trailName, $trailTraffic, $trailUse, $trailUuId)
				$trail = new Trail($row["trailId"], $row["createDate"], $row["submitTrailId"], $row["browser"], $row["createDate"], $row["ipAddress"], $row["trailAccessibility"], $row["trailAmenities"],
						$row["trailCondition"], $row["trailDescription"], $row["trailDifficulty"], $row["trailDistance"], $row ["trailSubmission"], $row["trailTerrain"], $row["trailName"], $row["trailTraffic"],
						$row["trailUse"], $row["trailUuId"]);
				$trails[$trails->key()] = $trail;
				$trails->next();
			} catch (Exception $e) {
				//if the row couldn't be converted, rethrow it
				throw(new PDOException($e->getMessage(),0 , $e));
			}
		}
		return($trails);
	}
	**/
	/**
	 * gets the trail by createDate
	 *
	 * @param PDO $pdo pointer to PDO connection, by reference
	 * @param int $createDate createDate to search for
	 * @return mixed trail found or null if not found
	 * @throws PDOException when mySQL related errors occur
	 *
	 **/
	public static function getTrailByCreateDate (PDO &$pdo, $createDate) {
		//sanitize the createDate before searching
		try {
			$createDate = Filter::filterDate($createDate, "createDate");
		} catch (InvalidArgumentException $invalidArgument ) {
			throw (new PDOException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range){
			throw(new PDOException($range->getMessage(), 0, $range));
		} catch (Exception $exception){
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}

		//create query template
		$query = "SELECT userId, submitTrailId, browser, createDate, ipAddress,trailAccessibility, trailAmenities, trailCondition,trailDescription, trailDifficulty, trailDistance, trailSubmissionType,
trailTerrain, trailName, trailTraffic, trailUse, trailUuId FROM trail WHERE createDate = :createDate";
		$statement = $pdo->prepare($query);

		//bind createDate to placeholder
		$parameters = array("createDate" => $createDate);
		$statement->execute($parameters);

		//build an array of trails
		$trails = new SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		while (($row = $statement->fetch()) !== false) {
			try {
				//new trail ($trailId, $userId, $submitTrailId, $browser, $createDate, $ipAddress, $trailAccessibility, $trailAmenities, $trailCondition,$trailDescription, $trailDifficulty, $trailDistance, $trailSubmissionType,$trailTerrain, $trailName, $trailTraffic, $trailUse, $trailUuId)
				$trail = new Trail($row["trailId"], $row["ipAddress"], $row["submitTrailId"], $row["browser"], $row["createDate"], $row["ipAddress"], $row["trailAccessibility"], $row["trailAmenities"],
						$row["trailCondition"], $row["trailDescription"], $row["trailDifficulty"], $row["trailDistance"], $row ["trailSubmission"], $row["trailTerrain"], $row["trailName"], $row["trailTraffic"],
						$row["trailUse"], $row["trailUuId"]);
				$trails[$trails->key()] = $trail;
				$trails->next();
			} catch (Exception $e) {
				//if the row couldn't be converted, rethrow it
				throw(new PDOException($e->getMessage(),0 , $e));
			}
		}
		return($trails);
	}

	/**
	 * gets the trail by ipAddress
	 *
	 * @param PDO $pdo pointer to PDO connection, by reference
	 * @param int $ipAddress ipAddress to search for
	 * @return mixed trail found or null if not found
	 * @throws PDOException when mySQL related errors occur
	 *
	 **/
	public static function getTrailByIpAddress (PDO &$pdo, $ipAddress) {
		//sanitize the ipAddress before searching
		try {
			$IpAddress = Filter::filterInt($ipAddress, "ipAddress");
		} catch (InvalidArgumentException $invalidArgument ) {
			throw (new PDOException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range){
			throw(new PDOException($range->getMessage(), 0, $range));
		} catch (Exception $exception){
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}

		//create query template
		$query = "SELECT userId, submitTrailId, browser, createDate, ipAddress, trailAccessibility, trailAmenities, trailCondition,trailDescription, trailDifficulty, trailDistance, trailSubmissionType,
trailTerrain, trailName, trailTraffic, trailUse, trailUuId FROM trail WHERE IpAddress = :IpAddress";
		$statement = $pdo->prepare($query);

		//bind IpAddress to placeholder
		$parameters = array("IpAddress" => $IpAddress);
		$statement->execute($parameters);

		//build an array of trails
		$trails = new SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		while (($row = $statement->fetch()) !== false) {
			try {
				//new trail ($trailId, $userId, $submitTrailId, $browser, $createDate, $ipAddress, $trailAccessibility, $trailAmenities, $trailCondition,$trailDescription, $trailDifficulty, $trailDistance, $trailSubmissionType,$trailTerrain, $trailName, $trailTraffic, $trailUse, $trailUuId)
				$trail = new Trail($row["trailId"], $row["trailAccessibility"], $row["submitTrailId"], $row["browser"], $row["createDate"], $row["ipAddress"], $row["trailAccessibility"], $row["trailAmenities"],
						$row["trailCondition"], $row["trailDescription"], $row["trailDifficulty"], $row["trailDistance"], $row ["trailSubmission"], $row["trailTerrain"], $row["trailName"], $row["trailTraffic"],
						$row["trailUse"], $row["trailUuId"]);
				$trails[$trails->key()] = $trail;
				$trails->next();
			} catch (Exception $e) {
				//if the row couldn't be converted, rethrow it
				throw(new PDOException($e->getMessage(),0 , $e));
			}
		}
		return($trails);
	}

	/**
	 * gets the trail by trailAccessibility
	 *
	 * @param PDO $pdo pointer to PDO connection, by reference
	 * @param string $trailAccessibility trailAccessibility to search for
	 * @return mixed trail found or null if not found
	 * @throws PDOException when mySQL related errors occur
	 *
	 **/
	public static function getTrailByTrailAccessibility (PDO &$pdo, $trailAccessibility) {
		//sanitize the trailAccessibility before searching
		try {
			$trailAccessibility = Filter::filterString($trailAccessibility, "trailAccessibility", 256);
		} catch (InvalidArgumentException $invalidArgument ) {
			throw (new PDOException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range){
			throw(new PDOException($range->getMessage(), 0, $range));
		} catch (Exception $exception){
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}

		//create query template
		$query = "SELECT userId, submitTrailId, browser, createDate, ipAddress,trailAccessibility, trailAmenities, trailCondition, trailDescription, trailDifficulty, trailDistance, trailSubmissionType,
trailTerrain, trailName, trailTraffic, trailUse, trailUuId FROM trail WHERE trailAccessibility = :trailAccessibility";
		$statement = $pdo->prepare($query);

		//bind trailAccessibility to placeholder
		$parameters = array("trailAccessibility" => $trailAccessibility);
		$statement->execute($parameters);

		//build an array of trails
		$trails = new SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		while (($row = $statement->fetch()) !== false) {
			try {
				//new trail ($trailId, $trailAmenities, $submitTrailId, $browser, $createDate, $ipAddress, $trailAccessibility, $trailAmenities, $trailCondition,$trailDescription, $trailDifficulty, $trailDistance, $trailSubmissionType,$trailTerrain, $trailName, $trailTraffic, $trailUse, $trailUuId)
				$trail = new Trail($row["trailId"], $row["userId"], $row["submitTrailId"], $row["browser"], $row["createDate"], $row["ipAddress"], $row["trailAccessibility"], $row["trailAmenities"],
						$row["trailCondition"], $row["trailDescription"], $row["trailDifficulty"], $row["trailDistance"], $row ["trailSubmission"], $row["trailTerrain"], $row["trailName"], $row["trailTraffic"],
						$row["trailUse"], $row["trailUuId"]);
				$trails[$trails->key()] = $trail;
				$trails->next();
			} catch (Exception $e) {
				//if the row couldn't be converted, rethrow it
				throw(new PDOException($e->getMessage(),0 , $e));
			}
		}
		return($trails);
	}

	/**
	 * gets the trail by trailAmenities
	 *
	 * @param PDO $pdo pointer to PDO connection, by reference
	 * @param int $trailAmenities trailAmenities to search for
	 * @return mixed trail found or null if not found
	 * @throws PDOException when mySQL related errors occur
	 *
	 **/
	public static function getTrailByTrailAmenities (PDO &$pdo, $trailAmenities) {
		//sanitize the trailAmenities before searching
		try {
			$trailAmenities = Filter::filterString($trailAmenities, "trailAmenities", 256);
		} catch (InvalidArgumentException $invalidArgument ) {
			throw (new PDOException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range){
			throw(new PDOException($range->getMessage(), 0, $range));
		} catch (Exception $exception){
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}

		//create query template
		$query = "SELECT trailAmenities, submitTrailId, browser, createDate, ipAddress,trailAccessibility, trailAmenities, trailCondition, trailDescription, trailDifficulty, trailDistance, trailSubmissionType,
trailTerrain, trailName, trailTraffic, trailUse, trailUuId FROM trail WHERE trailAmenities = :trailAmenities";
		$statement = $pdo->prepare($query);

		//bind trailAmenities to placeholder
		$parameters = array("trailAmenities" => $trailAmenities);
		$statement->execute($parameters);

		//build an array of trails
		$trails = new SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		while (($row = $statement->fetch()) !== false) {
			try {
				//new trail ($trailId, $userId, $submitTrailId, $browser, $createDate, $ipAddress, $trailAccessibility, $trailAmenities, $trailCondition,$trailDescription, $trailDifficulty, $trailDistance, $trailSubmissionType,$trailTerrain, $trailName, $trailTraffic, $trailUse, $trailUuId)
				$trail = new Trail($row["trailId"], $row["userId"], $row["submitTrailId"], $row["browser"], $row["createDate"], $row["ipAddress"], $row["trailAccessibility"], $row["trailAmenities"],
						$row["trailCondition"], $row["trailDescription"], $row["trailDifficulty"], $row["trailDistance"], $row ["trailSubmission"], $row["trailTerrain"], $row["trailName"], $row["trailTraffic"],
						$row["trailUse"], $row["trailUuId"]);
				$trails[$trails->key()] = $trail;
				$trails->next();
			} catch (Exception $e) {
				//if the row couldn't be converted, rethrow it
				throw(new PDOException($e->getMessage(),0 , $e));
			}
		}
		return($trails);
	}

	/**
	 * gets the trail by trailCondition
	 *
	 * @param PDO $pdo pointer to PDO connection, by reference
	 * @param string $trailCondition trailCondition to search for
	 * @return mixed trail found or null if not found
	 * @throws PDOException when mySQL related errors occur
	 *
	 **/
	public static function getTrailByTrailCondition (PDO &$pdo, $trailCondition) {
		//sanitize the trailCondition before searching
		try {
			$trailCondition = Filter::filterString($trailCondition, "trailCondition", 256);
		} catch (InvalidArgumentException $invalidArgument ) {
			throw (new PDOException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range){
			throw(new PDOException($range->getMessage(), 0, $range));
		} catch (Exception $exception){
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}

		//create query template
		$query = "SELECT trailAmenities, submitTrailId, browser, createDate, ipAddress, trailAccessibility, trailAmenities, trailCondition, trailDescription, trailDifficulty, trailDistance, trailSubmissionType,
trailTerrain, trailName, trailTraffic, trailUse, trailUuId FROM trail WHERE trailCondition = :trailCondition";
		$statement = $pdo->prepare($query);

		//bind trailCondition to placeholder
		$parameters = array("trailCondition" => $trailCondition);
		$statement->execute($parameters);

		//build an array of trails
		$trails = new SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		while (($row = $statement->fetch()) !== false) {
			try {
				//new trail ($trailId, $userId, $submitTrailId, $browser, $createDate, $ipAddress, $trailAccessibility, $trailAmenities, $trailCondition,$trailDescription, $trailDifficulty, $trailDistance, $trailSubmissionType,$trailTerrain, $trailName, $trailTraffic, $trailUse, $trailUuId)
				$trail = new Trail($row["trailId"], $row["userId"], $row["submitTrailId"], $row["browser"], $row["createDate"], $row["ipAddress"], $row["trailAccessibility"], $row["trailAmenities"],
						$row["trailCondition"], $row["trailDescription"], $row["trailDifficulty"], $row["trailDistance"], $row ["trailSubmission"], $row["trailTerrain"], $row["trailName"], $row["trailTraffic"],
						$row["trailUse"], $row["trailUuId"]);
				$trails[$trails->key()] = $trail;
				$trails->next();
			} catch (Exception $e) {
				//if the row couldn't be converted, rethrow it
				throw(new PDOException($e->getMessage(),0 , $e));
			}
		}
		return($trails);
	}

	public static function getTrailByTrailDescription (PDO &$pdo, $trailDescription) {
		//sanitize the trailDescription before searching
		try {
			$trailDescription = Filter::filterString($trailDescription, "trailDescription", 256);
		} catch (InvalidArgumentException $invalidArgument ) {
			throw (new PDOException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range){
			throw(new PDOException($range->getMessage(), 0, $range));
		} catch (Exception $exception){
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}

		//create query template
		$query = "SELECT trailAmenities, submitTrailId, browser, createDate, ipAddress,trailAccessibility, trailAmenities, trailCondition,trailDescription, trailDifficulty, trailDistance, trailSubmissionType,
trailTerrain, trailName, trailTraffic, trailUse, trailUuId FROM trail WHERE trailDescription = :trailDescription";
		$statement = $pdo->prepare($query);

		//bind trailDescription to placeholder
		$parameters = array("trailDescription" => $trailDescription);
		$statement->execute($parameters);

		//build an array of trails
		$trails = new SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		while (($row = $statement->fetch()) !== false) {
			try {
				//new trail ($trailId, $userId, $submitTrailId, $browser, $createDate, $ipAddress, $trailAccessibility, $trailAmenities, $trailCondition,$trailDescription, $trailDifficulty, $trailDistance, $trailSubmissionType,$trailTerrain, $trailName, $trailTraffic, $trailUse, $trailUuId)
				$trail = new Trail($row["trailId"], $row["userId"], $row["submitTrailId"], $row["browser"], $row["createDate"], $row["ipAddress"], $row["trailAccessibility"], $row["trailAmenities"],
						$row["trailCondition"], $row["trailDescription"], $row["trailDifficulty"], $row["trailDistance"], $row ["trailSubmission"], $row["trailTerrain"], $row["trailName"], $row["trailTraffic"],
						$row["trailUse"], $row["trailUuId"]);
				$trails[$trails->key()] = $trail;
				$trails->next();
			} catch (Exception $e) {
				//if the row couldn't be converted, rethrow it
				throw(new PDOException($e->getMessage(),0 , $e));
			}
		}
		return($trails);
	}

	public static function getTrailByTrailDifficulty (PDO &$pdo, $trailDifficulty) {
		//sanitize the trailDifficulty before searching
		try {
			$trailDifficulty = Filter::filterString($trailDifficulty, "trailDifficulty", 256);
		} catch (InvalidArgumentException $invalidArgument ) {
			throw (new PDOException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range){
			throw(new PDOException($range->getMessage(), 0, $range));
		} catch (Exception $exception){
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}

		//create query template
		$query = "SELECT trailAmenities, submitTrailId, browser, createDate, ipAddress,trailAccessibility, trailAmenities, trailCondition,trailDescription, trailDifficulty, trailDistance, trailSubmissionType,
trailTerrain, trailName, trailTraffic, trailUse, trailUuId FROM trail WHERE trailDifficulty = :trailDifficulty";
		$statement = $pdo->prepare($query);

		//bind trailDifficulty to placeholder
		$parameters = array("trailDifficulty" => $trailDifficulty);
		$statement->execute($parameters);

		//build an array of trails
		$trails = new SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		while (($row = $statement->fetch()) !== false) {
			try {
				//new trail ($trailId, $userId, $submitTrailId, $browser, $createDate, $ipAddress, $trailAccessibility, $trailAmenities, $trailCondition,$trailDescription, $trailDifficulty, $trailDistance, $trailSubmissionType,$trailTerrain, $trailName, $trailTraffic, $trailUse, $trailUuId)
				$trail = new Trail($row["trailId"], $row["userId"], $row["submitTrailId"], $row["browser"], $row["createDate"], $row["ipAddress"], $row["trailAccessibility"], $row["trailAmenities"],
						$row["trailDifficulty"], $row["trailDescription"], $row["trailDifficulty"], $row["trailDistance"], $row ["trailSubmission"], $row["trailTerrain"], $row["trailName"], $row["trailTraffic"],
						$row["trailUse"], $row["trailUuId"]);
				$trails[$trails->key()] = $trail;
				$trails->next();
			} catch (Exception $e) {
				//if the row couldn't be converted, rethrow it
				throw(new PDOException($e->getMessage(),0 , $e));
			}
		}
		return($trails);
	}

	public static function getTrailByTrailDistance (PDO &$pdo, $trailDistance) {
		//sanitize the trailDistance before searching
		try {
			$trailDistance = Filter::filterInt($trailDistance, "trailDistance");
		} catch (InvalidArgumentException $invalidArgument ) {
			throw (new PDOException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range){
			throw(new PDOException($range->getMessage(), 0, $range));
		} catch (Exception $exception){
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}

		//create query template
		$query = "SELECT trailAmenities, submitTrailId, browser, createDate, ipAddress,trailAccessibility, trailAmenities, trailCondition,trailDescription, trailDifficulty, trailDistance, trailSubmissionType,
trailTerrain, trailName, trailTraffic, trailUse, trailUuId FROM trail WHERE trailDistance = :trailDistance";
		$statement = $pdo->prepare($query);

		//bind trailDistance to placeholder
		$parameters = array("trailDistance" => $trailDistance);
		$statement->execute($parameters);

		//build an array of trails
		$trails = new SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		while (($row = $statement->fetch()) !== false) {
			try {
				//new trail ($trailId, $userId, $submitTrailId, $browser, $createDate, $ipAddress, $trailAccessibility, $trailAmenities, $trailCondition,$trailDescription, $trailDifficulty, $trailDistance, $trailSubmissionType,$trailTerrain, $trailName, $trailTraffic, $trailUse, $trailUuId)
				$trail = new Trail($row["trailId"], $row["userId"], $row["submitTrailId"], $row["browser"], $row["createDate"], $row["ipAddress"], $row["trailAccessibility"], $row["trailAmenities"],
						$row["trailDifficulty"], $row["trailDescription"], $row["trailDifficulty"], $row["trailDistance"], $row ["trailSubmission"], $row["trailTerrain"], $row["trailName"], $row["trailTraffic"],
						$row["trailUse"], $row["trailUuId"]);
				$trails[$trails->key()] = $trail;
				$trails->next();
			} catch (Exception $e) {
				//if the row couldn't be converted, rethrow it
				throw(new PDOException($e->getMessage(),0 , $e));
			}
		}
		return($trails);
	}

	public static function getTrailByTrailSubmissionType (PDO &$pdo, $trailSubmissionType) {
		//sanitize the trailSubmissionType before searching
		try {
			$trailSubmissionType = Filter::filterInt($trailSubmissionType, "trailSubmissionType");
		} catch (InvalidArgumentException $invalidArgument ) {
			throw (new PDOException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range){
			throw(new PDOException($range->getMessage(), 0, $range));
		} catch (Exception $exception){
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}

		//create query template
		$query = "SELECT trailAmenities, submitTrailId, browser, createDate, ipAddress,trailAccessibility, trailAmenities, trailCondition,trailDescription, trailDifficulty, trailDistance, trailSubmissionType,
trailTerrain, trailName, trailTraffic, trailUse, trailUuId FROM trail WHERE trailSubmissionType = :trailSubmissionType";
		$statement = $pdo->prepare($query);

		//bind trailSubmissionType to placeholder
		$parameters = array("trailSubmissionType" => $trailSubmissionType);
		$statement->execute($parameters);

		//build an array of trails
		$trails = new SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		while (($row = $statement->fetch()) !== false) {
			try {
				//new trail ($trailId, $userId, $submitTrailId, $browser, $createDate, $ipAddress, $trailAccessibility, $trailAmenities, $trailCondition,$trailDescription, $trailDifficulty, $trailDistance, $trailSubmissionType, $trailTerrain, $trailName, $trailTraffic, $trailUse, $trailUuId)
				$trail = new Trail($row["trailId"], $row["userId"], $row["submitTrailId"], $row["browser"], $row["createDate"], $row["ipAddress"], $row["trailAccessibility"], $row["trailAmenities"],
						$row["trailTerrain"], $row["trailDescription"], $row["trailDifficulty"], $row["trailDistance"], $row ["trailSubmission"], $row["trailTerrain"], $row["trailName"], $row["trailTraffic"],
						$row["trailUse"], $row["trailUuId"]);
				$trails[$trails->key()] = $trail;
				$trails->next();
			} catch (Exception $e) {
				//if the row couldn't be converted, rethrow it
				throw(new PDOException($e->getMessage(),0 , $e));
			}
		}
		return($trails);
	}

	public static function getTrailByTrailTerrain (PDO &$pdo, $trailTerrain) {
		//sanitize the trailTerrain before searching
		try {
			$trailTerrain = Filter::filterString($trailTerrain, "trailTerrain", 256);
		} catch (InvalidArgumentException $invalidArgument ) {
			throw (new PDOException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range){
			throw(new PDOException($range->getMessage(), 0, $range));
		} catch (Exception $exception){
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}

		//create query template
		$query = "SELECT trailAmenities, submitTrailId, browser, createDate, ipAddress,trailAccessibility, trailAmenities, trailCondition,trailDescription, trailDifficulty, trailDistance, trailSubmissionType,
trailTerrain, trailName, trailTraffic, trailUse, trailUuId FROM trail WHERE trailTerrain = :trailTerrain";
		$statement = $pdo->prepare($query);

		//bind trailTerrain to placeholder
		$parameters = array("trailTerrain" => $trailTerrain);
		$statement->execute($parameters);

		//build an array of trails
		$trails = new SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		while (($row = $statement->fetch()) !== false) {
			try {
				//new trail ($trailId, $userId, $submitTrailId, $browser, $createDate, $ipAddress, $trailAccessibility, $trailAmenities, $trailCondition,$trailDescription, $trailDifficulty, $trailDistance, $trailSubmissionType,$trailTerrain, $trailName, $trailTraffic, $trailUse, $trailUuId)
				$trail = new Trail($row["trailId"], $row["userId"], $row["submitTrailId"], $row["browser"], $row["createDate"], $row["ipAddress"], $row["trailAccessibility"], $row["trailAmenities"],
						$row["trailDifficulty"], $row["trailDescription"], $row["trailDifficulty"], $row["trailDistance"], $row ["trailSubmission"], $row["trailTerrain"], $row["trailName"], $row["trailTraffic"],
						$row["trailUse"], $row["trailUuId"]);
				$trails[$trails->key()] = $trail;
				$trails->next();
			} catch (Exception $e) {
				//if the row couldn't be converted, rethrow it
				throw(new PDOException($e->getMessage(),0 , $e));
			}
		}
		return($trails);
	}

	public static function getTrailByTrailName (PDO &$pdo, $trailName) {
		//sanitize the trailName before searching
		try {
			$trailName = Filter::filterString($trailName, "trailName", 256);
		} catch (InvalidArgumentException $invalidArgument ) {
			throw (new PDOException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range){
			throw(new PDOException($range->getMessage(), 0, $range));
		} catch (Exception $exception){
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}

		//create query template
		$query = "SELECT trailAmenities, submitTrailId, browser, createDate, ipAddress,trailAccessibility, trailAmenities, trailCondition,trailDescription, trailDifficulty, trailDistance, trailSubmissionType,
trailTerrain, trailName, trailTraffic, trailUse, trailUuId FROM trail WHERE trailName LIKE :trailName";
		$statement = $pdo->prepare($query);

		//bind trailName to placeholder
		$trailName = "%$trailName%";
		$parameters = array("trailName" => $trailName);
		$statement->execute($parameters);

		//build an array of trails
		$trails = new SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		while (($row = $statement->fetch()) !== false) {
			try {
				//new trail ($trailId, $userId, $submitTrailId, $browser, $createDate, $ipAddress, $trailAccessibility, $trailAmenities, $trailCondition,$trailDescription, $trailDifficulty, $trailDistance, $trailSubmissionType,$trailTerrain, $trailName, $trailTraffic, $trailUse, $trailUuId)
				$trail = new Trail($row["trailId"], $row["userId"], $row["submitTrailId"], $row["browser"], $row["createDate"], $row["ipAddress"], $row["trailAccessibility"], $row["trailAmenities"],
						$row["trailDifficulty"], $row["trailDescription"], $row["trailDifficulty"], $row["trailDistance"], $row ["trailSubmission"], $row["trailTerrain"], $row["trailName"], $row["trailTraffic"],
						$row["trailUse"], $row["trailUuId"]);
				$trails[$trails->key()] = $trail;
				$trails->next();
			} catch (Exception $e) {
				//if the row couldn't be converted, rethrow it
				throw(new PDOException($e->getMessage(),0 , $e));
			}
		}
		return($trails);
	}

	public static function getTrailByTrailTraffic (PDO &$pdo, $trailTraffic) {
		//sanitize the trailTraffic before searching
		try {
			$trailTraffic = Filter::filterString($trailTraffic, "trailTraffic", 16);
		} catch (InvalidArgumentException $invalidArgument ) {
			throw (new PDOException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range){
			throw(new PDOException($range->getMessage(), 0, $range));
		} catch (Exception $exception){
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}

		//create query template
		$query = "SELECT trailAmenities, submitTrailId, browser, createDate, ipAddress, trailAccessibility, trailAmenities, trailCondition,trailDescription, trailDifficulty, trailDistance, trailSubmissionType,
trailTerrain, trailName, trailTraffic, trailUse, trailUuId FROM trail WHERE trailTraffic = :trailTraffic";
		$statement = $pdo->prepare($query);

		//bind trailTraffic to placeholder
		$parameters = array("trailTraffic" => $trailTraffic);
		$statement->execute($parameters);

		//build an array of trails
		$trails = new SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		while (($row = $statement->fetch()) !== false) {
			try {
				//new trail ($trailId, $userId, $submitTrailId, $browser, $createDate, $ipAddress, $trailAccessibility, $trailAmenities, $trailCondition,$trailDescription, $trailDifficulty, $trailDistance, $trailSubmissionType,$trailTerrain, $trailName, $trailTraffic, $trailUse, $trailUuId)
				$trail = new Trail($row["trailId"], $row["userId"], $row["submitTrailId"], $row["browser"], $row["createDate"], $row["ipAddress"], $row["trailAccessibility"], $row["trailAmenities"],
						$row["trailDifficulty"], $row["trailDescription"], $row["trailDifficulty"], $row["trailDistance"], $row ["trailSubmission"], $row["trailTerrain"], $row["trailName"], $row["trailTraffic"],
						$row["trailUse"], $row["trailUuId"]);
				$trails[$trails->key()] = $trail;
				$trails->next();
			} catch (Exception $e) {
				//if the row couldn't be converted, rethrow it
				throw(new PDOException($e->getMessage(),0 , $e));
			}
		}
		return($trails);
	}

	public static function getTrailByTrailUse (PDO &$pdo, $trailUse) {
		//sanitize the trailUse before searching
		try {
			$trailUse = Filter::filterString($trailUse, "trailUse", 16);
		} catch (InvalidArgumentException $invalidArgument ) {
			throw (new PDOException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range){
			throw(new PDOException($range->getMessage(), 0, $range));
		} catch (Exception $exception){
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}

		//create query template
		$query = "SELECT trailAmenities, submitTrailId, browser, createDate, ipAddress,trailAccessibility, trailAmenities, trailCondition,trailDescription, trailDifficulty, trailDistance, trailSubmissionType,
trailTerrain, trailName, trailTraffic, trailUse, trailUuId FROM trail WHERE trailUse = :trailUse";
		$statement = $pdo->prepare($query);

		//bind trailUse to placeholder
		$parameters = array("trailUse" => $trailUse);
		$statement->execute($parameters);

		//build an array of trails
		$trails = new SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		while (($row = $statement->fetch()) !== false) {
			try {
				//new trail ($trailId, $userId, $submitTrailId, $browser, $createDate, $ipAddress, $trailAccessibility, $trailAmenities, $trailCondition,$trailDescription, $trailDifficulty, $trailDistance, $trailSubmissionType,$trailTerrain, $trailName, $trailTraffic, $trailUse, $trailUuId)
				$trail = new Trail($row["trailId"], $row["userId"], $row["submitTrailId"], $row["browser"], $row["createDate"], $row["ipAddress"], $row["trailAccessibility"], $row["trailAmenities"],
						$row["trailDifficulty"], $row["trailDescription"], $row["trailDifficulty"], $row["trailDistance"], $row ["trailSubmission"], $row["trailTerrain"], $row["trailName"], $row["trailTraffic"],
						$row["trailUse"], $row["trailUuId"]);
				$trails[$trails->key()] = $trail;
				$trails->next();
			} catch (Exception $e) {
				//if the row couldn't be converted, rethrow it
				throw(new PDOException($e->getMessage(),0 , $e));
			}
		}
		return($trails);
	}

	public static function getTrailByTrailUuId (PDO &$pdo, $trailUuId) {
		//sanitize the trailUuId before searching
		try {
			$trailUuId = Filter::filterString($trailUuId, "trailUuId");
		} catch (InvalidArgumentException $invalidArgument ) {
			throw (new PDOException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range){
			throw(new PDOException($range->getMessage(), 0, $range));
		} catch (Exception $exception){
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}

		//create query template
		$query = "SELECT trailAmenities, submitTrailId, browser, createDate, ipAddress, trailAccessibility, trailAmenities, trailCondition,trailDescription, trailDifficulty, trailDistance, trailSubmissionType,
trailTerrain, trailName, trailTraffic, trailUse, trailUuId FROM trail WHERE trailUuId = :trailUuId";
		$statement = $pdo->prepare($query);

		//bind trailUuId to placeholder
		$parameters = array("trailUuId" => $trailUuId);
		$statement->execute($parameters);

		//build an array of trails
		$trails = new SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		while (($row = $statement->fetch()) !== false) {
			try {
				//new trail ($trailId, $userId, $submitTrailId, $browser, $createDate, $ipAddress, $trailAccessibility, $trailAmenities, $trailCondition,$trailDescription, $trailDifficulty, $trailDistance, $trailSubmissionType,$trailTerrain, $trailName, $trailTraffic, $trailUse, $trailUuId)
				$trail = new Trail($row["trailId"], $row["userId"], $row["submitTrailId"], $row["browser"], $row["createDate"], $row["ipAddress"], $row["trailAccessibility"], $row["trailAmenities"],
						$row["trailDifficulty"], $row["trailDescription"], $row["trailDifficulty"], $row["trailDistance"], $row ["trailSubmission"], $row["trailTerrain"], $row["trailName"], $row["trailTraffic"],
						$row["trailUse"], $row["trailUuId"]);
				$trails[$trails->key()] = $trail;
				$trails->next();
			} catch (Exception $e) {
				//if the row couldn't be converted, rethrow it
				throw(new PDOException($e->getMessage(),0 , $e));
			}
		}
		return($trails);
	}

	/**
	 * specifies which fields to include in a JSON serialization
	 *
	 * @return array array containing all fields in the Segment
	 **/

	public function jsonSerialize() {
		return(get_object_vars($this));
	}
}