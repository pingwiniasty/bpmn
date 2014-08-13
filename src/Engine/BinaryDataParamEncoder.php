<?php

/*
 * This file is part of KoolKode BPMN.
 *
 * (c) Martin Schröder <m.schroeder2007@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KoolKode\BPMN\Engine;

use KoolKode\Database\Connection;
use KoolKode\Database\ParamEncoderInterface;

/**
 * Encodes binary values with optional comporession.
 * 
 * @author Martin Schröder
 */
class BinaryDataParamEncoder implements ParamEncoderInterface
{
	public function encodeParam(Connection $conn, $param, & $isEncoded)
	{
		if($param instanceof BinaryData)
		{
			$isEncoded = true;
			
			if($conn->isPostgreSQL())
			{
				return BinaryData::TYPE_HEX . bin2hex($param->encode());
			}
			
			return BinaryData::TYPE_RAW . $param->encode();
		}
	}
}