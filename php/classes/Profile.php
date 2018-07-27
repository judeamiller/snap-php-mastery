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
	 * @return mixed
	 */
	public function getProfileEmail() {
		return ($this->profileEmail);
	}

	/**
	 * @return mixed
	 */
	public function getProfileJoinDate() {
		return ($this->profileJoinDate);
	}
}