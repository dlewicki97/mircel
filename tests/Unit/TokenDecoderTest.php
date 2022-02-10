<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Services\TokenDecoder;

class TokenDecoderTest extends TestCase
{
    
    public function testLackOfTokenReturnsInvalidTokenMessage(): void {
        $this->expectException(\Exception::class);
        TokenDecoder::decode('');
    }

    public function testCheckIfInsertedTokenIsInvalid(): void {
    	$this->expectException(\Exception::class);

    	TokenDecoder::decode('token');
    	TokenDecoder::decode('token.token.token');
    }
}
