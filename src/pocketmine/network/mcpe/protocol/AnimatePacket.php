<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____  
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \ 
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/ 
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_| 
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 * 
 *
*/

namespace pocketmine\network\mcpe\protocol;

#include <rules/DataPacket.h>


class AnimatePacket extends DataPacket {

	const NETWORK_ID = ProtocolInfo::ANIMATE_PACKET;

	const ACTION_SWING_ARM = 1;

	const ACTION_STOP_SLEEP = 3;
	const ACTION_CRITICAL_HIT = 4;
	const ACTION_ROW_RIGHT = 128;
	const ACTION_ROW_LEFT = 129;

	public $action;
	public $eid;
	public $float = 0.0; //TODO (Boat rowing time?)

	/**
	 *
	 */
	public function decode(){
		$this->action = $this->getVarInt();
		$this->eid = $this->getEntityId();
		if($this->float & 0x80){
			$this->float = $this->getLFloat();
		}
	}

	/**
	 *
	 */
	public function encode(){
		$this->reset();
		$this->putVarInt($this->action);
		$this->putEntityId($this->eid);
		if($this->float & 0x80){
			$this->putLFloat($this->float);
		}
	}

}
