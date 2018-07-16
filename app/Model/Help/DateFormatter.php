<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 7. 7. 2018
 * Time: 17:25
 */

namespace App\Model\Help;

use App\Model\Service\ITranslationService;
use \DateTime;

class DateFormatter
{
	/** @var ITranslationService */
	protected $translationService;
	
	public static $months = [
		[ 'id' => '01', 'code' => 'Month.January', 'value' => 'January' ],
		[ 'id' => '02', 'code' => 'Month.February', 'value' => 'February' ],
		[ 'id' => '03', 'code' => 'Month.March', 'value' => 'March' ],
		[ 'id' => '04', 'code' => 'Month.April', 'value' => 'April' ],
		[ 'id' => '05', 'code' => 'Month.May', 'value' => 'May' ],
		[ 'id' => '06', 'code' => 'Month.June', 'value' => 'June' ],
		[ 'id' => '07', 'code' => 'Month.July', 'value' => 'July' ],
		[ 'id' => '08', 'code' => 'Month.August', 'value' => 'August' ],
		[ 'id' => '09', 'code' => 'Month.September', 'value' => 'September' ],
		[ 'id' => '10', 'code' => 'Month.October', 'value' => 'October' ],
		[ 'id' => '11', 'code' => 'Month.November', 'value' => 'November' ],
		[ 'id' => '12', 'code' => 'Month.December', 'value' => 'December' ],
	];

	/**
	 * DateFormatter constructor.
	 * @param ITranslationService $translationService
	 */
	public function __construct(ITranslationService $translationService) {
		$this->translationService = $translationService;
	}

	/**
	 * @param string $date in format
	 * @return string
	 */
	public function dateToReadableFormat($date) {
		$_date = new DateTime($date);
		$delimiter = ':-:';
		$date = $_date->format('d. ' . $delimiter . ' Y | H:i:s');
		$_month = $_date->format('m');
		$month = $this->translationService->get(self::$months[$_month-1]['code'], self::$months[$_month-1]['value']);
		$date = str_replace($delimiter, $month, $date);
		return $date;
	}

	/**
	 * @param string $date
	 * @return string
	 */
	public function dateToInputFormat($date) {
		$date = new DateTime($date);
		return $date->format('Y-m-d') . 'T' . $date->format('H:i:s');
	}
}