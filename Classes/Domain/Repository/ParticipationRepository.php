<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Noel Bossart <n.company@me.com>
 *  
 *  All rights pcerved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package nbowishlist
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_Nbowishlist_Domain_Repository_ParticipationRepository extends Tx_Extbase_Persistence_Repository {

	public function findLabel($uid = '0') {

		$query = $this->createQuery();
		$query->getQuerySettings()->setReturnRawQueryResult(true);
		$now = time();
		$queryText = 'SELECT ps.firstname, ps.lastname, wh.title, pc.share
					FROM `tx_nbowishlist_domain_model_participation` AS pc
					LEFT JOIN tx_nbowishlist_domain_model_wish AS wh ON pc.wish = wh.uid
					LEFT JOIN tx_nboevents_domain_model_person AS ps ON pc.person = ps.uid
					WHERE pc.uid = \'' . $uid . '\'
					AND pc.deleted=0
					AND pc.t3ver_state<=0
					AND pc.pid<>-1
					AND pc.hidden=0
					AND pc.starttime<=' . $now . '
					AND (pc.endtime=0 OR pc.endtime>' . $now . ')
					AND pc.sys_language_uid IN (0,-1)
					AND pc.pid IN (10) LIMIT 1';

		$query->statement($queryText);
		$rows = $query->execute();
		$label = '';

		foreach ($rows as $row) {
			foreach ($row as $key => $value) {
				switch ($key) {
					case 'lastname':
						$label .= $row[$key] . ' – ';
						break;
					case 'share':
						$label .= '(' . $row[$key] . ')';
						break;
					default:
						$label .= $row[$key] . ' ';
						break;
				}
			}
		}
		return $label;
	}
	
	public function personByUid($uid = '0') {
		$person = 0;
		if($uid){
			$query = $this->createQuery();
			$query->getQuerySettings()->setReturnRawQueryResult(true);
			$now = time();
			$queryText = 'SELECT pc.person
						FROM `tx_nbowishlist_domain_model_participation` AS pc WHERE pc.uid = \'' . $uid . '\'
						AND pc.share > 0
						AND pc.deleted=0
						AND pc.t3ver_state<=0
						AND pc.pid<>-1
						AND pc.hidden=0
						AND pc.starttime<=' . $now . '
						AND (pc.endtime=0 OR pc.endtime>' . $now . ')
						AND pc.sys_language_uid IN (0,-1)
						AND pc.pid IN (10) LIMIT 1';
			$query->statement($queryText);
			$rows = $query->execute();
			$person = $rows[0]['person']*1;
		}
		return $person;
	}
	
	public function sharesByParticipationAndWish($uid = '0', $wish = '0') {
		$shares = 0;
		if($uid){
			$query = $this->createQuery();
			$query->getQuerySettings()->setReturnRawQueryResult(true);
			$now = time();
			$queryText = 'SELECT pc.share
						FROM `tx_nbowishlist_domain_model_participation` AS pc
						WHERE pc.wish = \'' . $wish . '\'
						AND pc.uid = \'' . $uid . '\'
						AND pc.deleted=0
						AND pc.t3ver_state<=0
						AND pc.pid<>-1
						AND pc.hidden=0
						AND pc.starttime<=' . $now . '
						AND (pc.endtime=0 OR pc.endtime>' . $now . ')
						AND pc.sys_language_uid IN (0,-1)
						AND pc.pid IN (10) LIMIT 1';

			$query->statement($queryText);
			$rows = $query->execute();
			foreach ($rows as $row) {
				$shares += $row['share'];
			}
		}
		return $shares;
	}
	
	public function sharesByWish($uid = '0') {
		$shares = 0;
		if($uid){
			$query = $this->createQuery();
			$query->getQuerySettings()->setReturnRawQueryResult(true);
			$now = time();
			$queryText = 'SELECT pc.share
						FROM `tx_nbowishlist_domain_model_participation` AS pc
						LEFT JOIN tx_nbowishlist_domain_model_wish AS wh ON pc.wish = wh.uid
						WHERE wh.uid = \'' . $uid . '\'
						AND pc.deleted=0
						AND pc.t3ver_state<=0
						AND pc.pid<>-1
						AND pc.hidden=0
						AND pc.starttime<=' . $now . '
						AND (pc.endtime=0 OR pc.endtime>' . $now . ')
						AND pc.sys_language_uid IN (0,-1)
						AND pc.pid IN (10) LIMIT 999';

			$query->statement($queryText);
			$rows = $query->execute();
			foreach ($rows as $row) {
				$shares += $row['share'];
			}
		}
		return $shares;
	}
	
}
?>