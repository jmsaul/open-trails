<?php
require_once("trail-quail.php");
require_once(dirname(__DIR__) . "/php/classes/autoload.php");

/**
 * Full PHPUnit test for the TrailRelationship class
 *
 * This is a complete PHPUnit test of the TrailRelationship class. It is complete because *ALL* mySQL/PDO enabled methods are tested for both invalid and valid inputs.
 *
 * @see TrailRelationship
 * @author Louis Gill <lgill7@cnm.edu>
 **/
class TrailRelationshipTest extends TrailQuailTest {
	/**
	 * trailId referenced in the Trail Relationship; this is for foreign key relations
	 * @var int $VALID_TRAILID
	 **/
	protected $VALID_TRAILID = null;

	/**
	 * segmentId referenced in the Trail Relationship; this is for foreign key relations
	 * @var int $VALID_SEGMENTID
	 **/
	protected $VALID_SEGMENTID = null;

	/**
	 * valid segmentType to use
	 * @var string $VALID_SEGMENTTYPE
	 **/
	protected $VALID_SEGMENTTYPE = "H";

	/**
	 * valid segmentType to use
	 * @var string $VALID_SEGMENTTYPE2
	 **/
	protected $VALID_SEGMENTTYPE2 = "S";

	/**
	 * @var Trail $trail
	 **/
	protected $trail = null;

	/**
	 * @var Segment $segment
	 **/
	protected $segment = null;

	/**
	 * @var string $VALID_DATE
	 */
	protected $VALID_DATE = "2015-10-24 10:24:42";

	/**
	 * @var string $VALID_TRAILNAME
	 */
	protected $VALID_TRAILNAME = "La Luz";

	/**
	 * @var string $VALID_BROWSER
	 */
	protected $VALID_BROWSER = "";

	/**
	 * @var string $VALID_USERHASH
	 */
	protected $VALID_USERHASH = "";

	/**
	 * @var string $VALID_USERSALT
	 */
	protected $VALID_USERSALT = "";

	/**
	 * @var User $user
	 */
	protected $user = null;

	/**
	 * @var Point $point
	 */
	protected $point = null;

	/**
	 * @var SegmentStart $segmentStart
	 */
	protected $segmentStart = null;

	/**
	 * @var SegmentStop $segmentStop
	 */
	protected $segmentStop = null;

	/**
	 * create dependent objects before running each test
	 **/
	public function setUp() {
		//run the default setUp() method first
		parent::setUp();

		$this->VALID_DATE = DateTime::createFromFormat("Y-m-d H:i:s", $this->VALID_DATE);

		//create browser
		$this->VALID_BROWSER = "Chrome";

		$this->VALID_USERSALT = bin2hex(openssl_random_pseudo_bytes(32));
		$this->VALID_USERHASH = $this->VALID_USERHASH = hash_pbkdf2("sha512", "password4321", $this->VALID_USERSALT, 262144, 128);

		//create and insert a userId to own the trail
		$this->user = new User(null, $this->VALID_BROWSER, $this->VALID_DATE, "192.168.1.168", "S", "louisgill5@gmail.com", $this->VALID_USERHASH, "Hyourname.tomorrow", $this->VALID_USERSALT);
		$this->user->insert($this->getPDO());

		$this->VALID_TRAILNAME = "La Luz";

		//create and insert a trailId to own the test Trail Relationship
		//$newTrailId, $newUserId, $newBrowser, $newCreateDate, $newIpAddress, $newSubmitTrailId, $newTrailAccessibility, $newTrailAmenities, $newTrailCondition, $newTrailDescription, $newTrailDifficulty, $newTrailDistance, $newTrailName, $newTrailSubmissionType, $newTrailTerrain, $newTrailTraffic, $newTrailUse, $newTrailUuid
		$this->trail = new Trail(null, $this->user->getUserId(), "Safari", $this->VALID_DATE, "192.168.1.4", null, "y", "Picnic area", "Good", "This trail is a beautiful winding trail located in the Sandia Mountains", 3, 1054.53, $this->VALID_TRAILNAME, 1, "Mostly switchbacks with a few sections of rock fall", "Heavy", "Hiking", "SSEERFFV4444554");
		$this->trail->insert($this->getPDO());

		$this->segmentStart = new Point(35.554, 44.546);
		$this->segmentStop = new Point (6, 36);

		//create and insert a segmentId to own the test Trail Relationship
		$this->segment = new Segment(null, $this->segmentStart, $this->segmentStop, 1000, 2000);
		$this->segment->insert($this->getPDO());
	}

	/**
	 * test inserting a Trail Relationship that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidTrailRelationship() {
		// create a Trail Relationship with a non-null trailId and watch it fail
		$trailRelationship = new TrailRelationship($this->trail->getTrailId(), TrailQuailTest::INVALID_KEY, $this->segment->getSegmentId(), $this->VALID_SEGMENTTYPE);
		$trailRelationship->insert($this->getPDO());
	}

	/**
	 * test inserting a Trail Relationship, editing it, and then updating it
	 *
	 * grabs the data from mySQL via getTrailRelationshipByTrailId
	 **/
	public function testUpdateValidTrailRelationshipByTrailId() {

		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("trailRelationship");

		//create a new Trail Relationship and insert it into mySQL
		$trailRelationship = new TrailRelationship($this->segment->getSegmentId(), $this->trail->getTrailId(), $this->VALID_SEGMENTTYPE);
		$trailRelationship->insert($this->getPDO());

		// edit the Trail Relationship and update it in mySQL
		$trailRelationship->setSegmentType($this->VALID_SEGMENTTYPE2);
		$trailRelationship->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoTrailRelationship = TrailRelationship::getTrailRelationshipByTrailId($this->getPDO(), $trailRelationship->getTrailId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("trailRelationship"));
		$this->assertSame($pdoTrailRelationship->getTrailId(), $this->trail->getTrailId());
		$this->assertSame($pdoTrailRelationship->getSegmentId(), $this->segment->getSegmentId());
		$this->assertSame($pdoTrailRelationship->getSegmentType(), $this->VALID_SEGMENTTYPE2);
	}

	/**
	 * test inserting a Trail Relationship, editing it, and then updating it
	 *
	 * grabs the data from mySQL via getTrailRelationshipBySegmentId
	 **/
	public function testUpdateValidTrailRelationshipBySegmentId() {

		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("trailRelationship");

		//create a new Trail Relationship and insert it into mySQL
		$trailRelationship = new TrailRelationship($this->segment->getSegmentId(), $this->trail->getTrailId(), $this->VALID_SEGMENTTYPE);
		$trailRelationship->insert($this->getPDO());

		// edit the Trail Relationship and update it in mySQL
		$trailRelationship->setSegmentType($this->VALID_SEGMENTTYPE2);
		$trailRelationship->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoTrailRelationship = TrailRelationship::getTrailRelationshipBySegmentId($this->getPDO(), $trailRelationship->getSegmentId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("trailRelationship"));
		$this->assertSame($pdoTrailRelationship->getTrailId(), $this->trail->getTrailId());
		$this->assertSame($pdoTrailRelationship->getSegmentId(), $this->segment->getSegmentId());
		$this->assertSame($pdoTrailRelationship->getSegmentType(), $this->VALID_SEGMENTTYPE2);
	}

	/**
	 * test inserting a Trail Relationship, editing it, and then updating it
	 *
	 * grabs the data from mySQL via getTrailRelationshipBySegmentIdAndTrailId
	 **/
	public function testUpdateValidTrailRelationshipBySegmentIdAndTrailId() {

		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("trailRelationship");

		//create a new Trail Relationship and insert it into mySQL
		$trailRelationship = new TrailRelationship($this->segment->getSegmentId(), $this->trail->getTrailId(), $this->VALID_SEGMENTTYPE);
		$trailRelationship->insert($this->getPDO());

		// edit the Trail Relationship and update it in mySQL
		$trailRelationship->setSegmentType($this->VALID_SEGMENTTYPE2);
		$trailRelationship->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoTrailRelationship = TrailRelationship::getTrailRelationshipBySegmentIdAndTrailId($this->getPDO(), $trailRelationship->getSegmentId(), $trailRelationship->getTrailId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("trailRelationship"));
		$this->assertSame($pdoTrailRelationship->getSegmentId(), $this->segment->getSegmentId());
		$this->assertSame($pdoTrailRelationship->getTrailId(), $this->trail->getTrailId());
		$this->assertSame($pdoTrailRelationship->getSegmentType(), $this->VALID_SEGMENTTYPE2);
	}

	/**
	 *test updating a Trail Relationship that does not exist
	 *
	 * @expectedException UnexpectedValueException
	 **/
	public function testUpdateInvalidTrailRelationship() {
		// create a Trail Relationship and try to update it without actually inserting it
		$trailRelationship = new TrailRelationship($this->VALID_SEGMENTID, $this->VALID_TRAILID, $this->VALID_SEGMENTTYPE);
		$trailRelationship->update($this->getPDO());
	}

	/**
	 * test creating a Trail Relationship and then deleting it
	 *
	 * grabs the data from mySQL via getTrailRelationshipBySegmentId
	 **/
	public function testDeleteValidTrailRelationshipBySegmentId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("trailRelationship");

		// create a new Trail Relationship and insert it into mySQL
		$trailRelationship = new TrailRelationship($this->segment->getSegmentId(), $this->trail->getTrailId(), $this->VALID_SEGMENTTYPE);
		$trailRelationship->insert($this->getPDO());

		// delete the Trail Relationship from mySQL
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("trailRelationship"));
		$trailRelationship->delete($this->getPDO());

		//grab the data from my mySQL and enforce the Trail Relationship does not exist
		$pdoTrailRelationship = TrailRelationship::getTrailRelationshipBySegmentId($this->getPDO(), $trailRelationship->getSegmentId());
		$this->assertNull($pdoTrailRelationship);
		$this->assertSame($numRows, $this->getConnection()->getRowCount("trailRelationship"));
	}

	/**
	 * test creating a Trail Relationship and then deleting it
	 *
	 * grabs the data from mySQL via getTrailRelationshipByTrailId
	 **/
	public function testDeleteValidTrailRelationshipByTrailId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("trailRelationship");

		// create a new Trail Relationship and insert it into mySQL
		$trailRelationship = new TrailRelationship($this->segment->getSegmentId(), $this->trail->getTrailId(), $this->VALID_SEGMENTTYPE);
		$trailRelationship->insert($this->getPDO());

		// delete the Trail Relationship from mySQL
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("trailRelationship"));
		$trailRelationship->delete($this->getPDO());

		//grab the data from my mySQL and enforce the Trail Relationship does not exist
		$pdoTrailRelationship = TrailRelationship::getTrailRelationshipByTrailId($this->getPDO(), $trailRelationship->getTrailId());
		$this->assertNull($pdoTrailRelationship);
		$this->assertSame($numRows, $this->getConnection()->getRowCount("trailRelationship"));
	}

	/**
	 * test creating a Trail Relationship and then deleting it
	 *
	 * grabs the data from mySQL via getTrailRelationshipBySegmentIdAndTrailId
	 **/
	public function testDeleteValidTrailRelationshipBySegmentIdAndTrailId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("trailRelationship");

		// create a new Trail Relationship and insert it into mySQL
		$trailRelationship = new TrailRelationship($this->segment->getSegmentId(), $this->trail->getTrailId(), $this->VALID_SEGMENTTYPE);
		$trailRelationship->insert($this->getPDO());

		// delete the Trail Relationship from mySQL
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("trailRelationship"));
		$trailRelationship->delete($this->getPDO());

		//grab the data from my mySQL and enforce the Trail Relationship does not exist
		$pdoTrailRelationship = TrailRelationship::getTrailRelationshipBySegmentIdAndTrailId($this->getPDO(), $trailRelationship->getSegmentId(), $trailRelationship->getTrailId());
		$this->assertNull($pdoTrailRelationship);
		$this->assertSame($numRows, $this->getConnection()->getRowCount("trailRelationship"));
	}

	/**
	 * test deleting a Trail Relationship that does not exist
	 **/
	public function testDeleteInvalidTrailRelationship() {
		// create a Trail Relationship and try to delete it without actually inserting it
		$trailRelationship = new TrailRelationship($this->segment->getSegmentId(), $this->trail->getTrailId(), $this->VALID_SEGMENTTYPE);
		$trailRelationship->delete($this->getPDO());
	}

	/**
	 * test grabbing a Trail Relationship that does not exist
	 *
	 * grabs the data from mySQL via getTrailRelationshipBySegmentId
	 **/
	public function testGetInvalidTrailRelationshipBySegmentId() {
		//grab a segmentId that exceeds the maximum allowable segmentId
		$trailRelationship = TrailRelationship::getTrailRelationshipBySegmentId($this->getPDO(), TrailQuailTest::INVALID_KEY);
		$this->assertNull($trailRelationship);
	}

	/**
	 * test grabbing a Trail Relationship that does not exist
	 *
	 * grabs the data from mySQL via getTrailRelationshipByTrailId
	 **/
	public function testGetInvalidTrailRelationshipByTrailId() {
		//grab a trailId that exceeds the maximum allowable trailId
		$trailRelationship = TrailRelationship::getTrailRelationshipByTrailId($this->getPDO(), TrailQuailTest::INVALID_KEY);
		$this->assertNull($trailRelationship);
	}

	/**
	 * test grabbing a Trail Relationship that does not exist
	 *
	 * grabs the data from mySQL via getTrailRelationshipBySegmentIdAndTrailId
	 **/
	public function testGetInvalidTrailRelationshipBySegmentIdAndTrailId() {
		//grab a segmentId that exceeds the maximum allowable segmentId
		$trailRelationship = TrailRelationship::getTrailRelationshipBySegmentIdAndTrailId($this->getPDO(), TrailQuailTest::INVALID_KEY, TrailQuailTest::INVALID_KEY);
		$this->assertNull($trailRelationship);
	}

	/**
	 * test grabbing a Trail Relationship that does not exist
	 *
	 * grabs the data from mySQL via getTrailRelationshipBySegmentType
	 **/
	public function testGetInvalidTrailRelationshipBySegmentType() {
		//grab a segmentType that exceeds the maximum allowable segmentType
		$trailRelationship = TrailRelationship::getTrailRelationshipBySegmentType($this->getPDO(), "Q");
		$this->assertNull($trailRelationship);
	}

	/**
	 * test grabbing a Trail Relationship by segmentId
	 **/
	public function testGetValidTrailRelationshipBySegmentId() {

		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("trailRelationship");

		//create a new Trail Relationship and insert it into mySQL
		$trailRelationship = new TrailRelationship($this->segment->getSegmentId(), $this->trail->getTrailId(), $this->VALID_SEGMENTTYPE);
		$trailRelationship->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoTrailRelationship = TrailRelationship::getTrailRelationshipBySegmentId($this->getPDO(), $this->segment->getSegmentId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("trailRelationship"));
		$this->assertSame($pdoTrailRelationship->getSegmentId(), $this->segment->getSegmentId());
		$this->assertSame($pdoTrailRelationship->getTrailId(), $this->trail->getTrailId());
		$this->assertSame($pdoTrailRelationship->getSegmentType(), $this->VALID_SEGMENTTYPE);
	}

	/**
	 * test grabbing a Trail Relationship by trailId
	 **/
	public function testGetValidTrailRelationshipByTrailId() {

		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("trailRelationship");

		//create a new Trail Relationship and insert it into mySQL
		$trailRelationship = new TrailRelationship($this->segment->getSegmentId(), $this->trail->getTrailId(), $this->VALID_SEGMENTTYPE);
		$trailRelationship->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoTrailRelationship = TrailRelationship::getTrailRelationshipByTrailId($this->getPDO(), $this->trail->getTrailId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("trailRelationship"));
		$this->assertSame($pdoTrailRelationship->getSegmentId(), $this->segment->getSegmentId());
		$this->assertSame($pdoTrailRelationship->getTrailId(), $this->trail->getTrailId());
		$this->assertSame($pdoTrailRelationship->getSegmentType(), $this->VALID_SEGMENTTYPE);
	}

	/**
	 * test grabbing a Trail Relationship by segmentIdAndTrailId
	 **/
	public function testGetValidTrailRelationshipBySegmentIdAndTrailId() {

		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("trailRelationship");

		//create a new Trail Relationship and insert it into mySQL
		$trailRelationship = new TrailRelationship($this->segment->getSegmentId(), $this->trail->getTrailId(), $this->VALID_SEGMENTTYPE);
		$trailRelationship->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoTrailRelationship = TrailRelationship::getTrailRelationshipBySegmentIdAndTrailId($this->getPDO(), $this->segment->getSegmentId(), $this->trail->getTrailId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("trailRelationship"));
		$this->assertSame($pdoTrailRelationship->getSegmentId(), $this->segment->getSegmentId());
		$this->assertSame($pdoTrailRelationship->getTrailId(), $this->trail->getTrailId());
		$this->assertSame($pdoTrailRelationship->getSegmentType(), $this->VALID_SEGMENTTYPE);
	}

	/**
	 * test grabbing a Trail Relationship by segmentType
	 **/
	public function testGetValidTrailRelationshipBySegmentType() {

		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("trailRelationship");

		//create a new Trail Relationship and insert it into mySQL
		$trailRelationship = new TrailRelationship($this->segment->getSegmentId(), $this->trail->getTrailId(), $this->VALID_SEGMENTTYPE);
		$trailRelationship->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoTrailRelationship = TrailRelationship::getTrailRelationshipBySegmentType($this->getPDO(), $this->VALID_SEGMENTTYPE);
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("trailRelationship"));
		$this->assertSame($pdoTrailRelationship->getSegmentId(), $this->segment->getSegmentId());
		$this->assertSame($pdoTrailRelationship->getTrailId(), $this->trail->getTrailId());
		$this->assertSame($pdoTrailRelationship->getSegmentType(), $this->VALID_SEGMENTTYPE);
	}

}