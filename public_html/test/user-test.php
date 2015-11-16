<?php
require_once("trail-quail.php");
require_once(dirname(__DIR__). "/php/classes/autoload.php");

/**
 *
 * Full PHPUnit test for the User class
 *
 * This is a complete PHPUnit test of the User class. It is complete because *ALL* mySQL/PDO enabled methods are tested for both invalid and valid inputs.
 *
 * @see user.php in the classes directory
 * @author Jeff Saul <scaleup13@gmail.com> and Trail Quail <trailquailabq@gmail.com>
 **/
class UserTest extends TrailQuailTest {
	/**
	 * valid user Id to use
	 * @var int $VALID_USERID
	 */
	protected $VALID_USERID = "27";

		/**
		 * valid user Browser type to use
		 * @var string $VALID_BROWSER
		 */
	protected $VALID_BROWSER = "Chrome";

	/**
	 * valid user account creation date to use
	 * @var datetime $VALID_CREATEDATE
	 */
	protected $VALID_CREATEDATE = "2015-11-15 09:45:30";

	/**
	 * valid user IP address to use
	 * @var string $VALID_IPADDRESS
	 */
	protected $VALID_IPADDRESS = "192.168.1.168";

	/**
	 * valid user account type to use
	 * @var string $VALID_USERACCOUNTTYPE
	 */
	protected $VALID_USERACCOUNTTYPE = "S";

	/**
	 * valid user email to use
	 * @var string $VALID_EMAIL
	 */
	protected $VALID_USEREMAIL = "saul.jeff@gmail.com";

	/**
	 * valid user hash to use
	 * @var string $VALID_USERHASH
	 */
	protected $VALID_USERHASH = null;

	/**
	 * valid username to use
	 * @var string $VALID_USERNAME
	 */
	protected $VALID_USERNAME = Hyourname.tomorrow;

	/**
	 * valid user salt
	 * @var string $VALID_USERSALT
	 */
	protected $VALID_USERSALT= null;

	/**
	 * This setUp function creates user salt and user hash values for unit testing
	 * @var string $VALID_USERSALT
	 * @var string $VALID_USERHASH
	 */
	public function setUp() {
		parent::setUp();

		$this->VALID_USERSALT = bin2hex(openssl_random_pseudo_bytes(32));
		$this->VALID_USERHASH = hash_pbkdf2("sha512", "iLoveIllinois", $this->VALID_USERSALT, 262144, 128);
	}

	/**
	 * Test inserting a valid user ID information entry and verify that the actual mySQL data matches
	 */
	public function testInsertValidUser() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");

		// create a new user information profile and insert it in the database
		$user = new user(null, $this->VALID_BROWSER, $this->VALID_CREATEDATE, $this->VALID_IPADDRESS, $this->VALID_USERACCOUNTTYPE,$this->VALID_USEREMAIL, $this->VALID_USERHASH, $this->VALID_USERNAME, $this->VALID_USERSALT);
		$user->insert($$this->getPDO());

		// grab the data from mySQL and verify the fields match our expectation
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertSame($pdoUser->$getBrowser(), $this->VALID_BROWSER);
		$this->assertSame($pdoUser->$getCreateDate(), $this->VALID_CREATEDATE);
		$this->assertSame($pdoUser->$getIpAddress(), $this->VALID_IPADDRESS);
		$this->assertSame($pdoUser->$getUserAccountType(), $this->VALID_USERACCOUNTTYPE);
		$this->assertSame($pdoUser->$getUserEmail(), $this->VALID_USEREMAIL);
		$this->assertSame($pdoUser->$getUserHash(), $this->VALID_USERHASH);
		$this->assertSame($pdoUser->$getUserName(), $this->VALID_USERNAME);
		$this->assertSame($pdoUser->$getUserSalt(), $this->VALID_USERSALT);
	}

	/**
	 * Test inserting a user ID profile that already exists
	 *
	 * @expectedException PDOException
	 */
	public function testInsertValidUser() {
		// create a user Id profile with a non null userId adn watch it fail
		$user = new User(UserTest::INVALID_KEY, $this->VALID_BROWSER, $this->VALID_CREATEDATE, $this->VALID_IPADDRESS, $this->VALID_USERACCOUNTTYPE,$this->VALID_USEREMAIL, $this->VALID_USERHASH, $this->VALID_USERNAME, $this->VALID_USERSALT);
		$user->insert($this->getPDO());
}

	/**
	 * test inserting a user Id profile, editing it, and then updating it
	 */
	public function testUpdateValidProfile() {
	}
}