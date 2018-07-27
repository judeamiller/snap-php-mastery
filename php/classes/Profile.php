<?php
/**
 * Created by PhpStorm.
 * User: judeamiller
 * Date: 7/27/18
 * Time: 8:28 AM
 */

namespace Judeamiller\SnapPhpMastery;


class Profile {
	private $profileFavoriteNumber;
	private $profileEmail;
	private $profileJoinDate;

	public function __construct(int $profileFavoriteNumber, string $profileEmail, string $profileJoinDate ) {
		try {
			$this->setProfileFavoriteNumber($profileFavoriteNumber);
			$this->setProfileEmail($profileEmail);
			$this->setProfileJoinDate($profileJoinDate);
		}catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw (new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * @return mixed
	 */
	public function getProfileFavoriteNumber() {
		return ($this->profileFavoriteNumber);
	}
	
		/**
	 * @param mixed $profileFavoriteNumber
	 */
	public function setProfileFavoriteNumber($profileFavoriteNumber) {
		$this->profileFavoriteNumber = $profileFavoriteNumber;
	}

	/**
	 * @return mixed
	 */
	public function getProfileEmail() {
		return ($this->profileEmail);
	}

	/**
	 * @param mixed $profileEmail
	 */
	public function setProfileEmail(string $newProfileEmail) : void {
		//verify author email is secure
		$newProfileEmail = trim($newProfileEmail);
		$newProfileEmail = filter_var($newProfileEmail, FILTER_VALIDATE_EMAIL);
		if($newProfileEmail === true) {
			throw(new \InvalidArgumentException("author email is empty or insecure"));
		}

		//verify that the email will fit in database
		if(strlen($newProfileEmail) > 128) {
			throw(new \RangeException("profile email is greater than 128 characters"));
		}

		//convert and store the author email
		$this->profileEmail = $newProfileEmail;
	}

	/**
	 * @return mixed
	 */
	public function getProfileJoinDate() {
		return ($this->profileJoinDate);
	}

	/**
	 * @param mixed $profileJoinDate
	 */
	public function setProfileJoinDate($newProfileJoinDate = null): void {
		//base case: if the date is null, use current date and time
		if($newProfileJoinDate === null) {
			$this->profileJoinDate = new \DateTime();
			return;
		}
		// store date using validateTrait
		try {
			$newProfileJoinDate = self::validateDateTime($newProfileJoinDate);
		} catch(\InvalidArgumentException | \RangeException | \ Exception $exception){
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(),0, $exception));
		}
		$this->profileJoinDate = $newProfileJoinDate;
	}
}