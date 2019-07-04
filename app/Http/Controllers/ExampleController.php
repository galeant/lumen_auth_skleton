<?php

namespace App\Http\Controllers;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;

use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(){
        // $time = time();
        // $token = (new Builder())->issuedBy('http://example.com') // Configures the issuer (iss claim)
        //                         ->permittedFor('http://example.org') // Configures the audience (aud claim)
        //                         ->identifiedBy('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
        //                         ->issuedAt($time) // Configures the time that the token was issue (iat claim)
        //                         ->canOnlyBeUsedAfter($time + 60) // Configures the time that the token can be used (nbf claim)
        //                         ->expiresAt($time + 3600) // Configures the expiration time of the token (exp claim)
        //                         ->withClaim('uid', 1) // Configures a new claim, called "uid"
        //                         ->getToken(); // Retrieves the generated token
        // dd($token);

        // $token->getHeaders(); // Retrieves the token headers
        // $token->getClaims(); // Retrieves the token claims

        // // $token = '{ayam.bebek.cicak}';
        // // $token = (new Parser())->parse((string) $token); // Parses from a string
        // // $token->getHeaders(); // Retrieves the token header
        // // $token->getClaims(); // Retrieves the token claims

        // return [$token->getHeader('jti'),$token->getClaim('iss'),$token->getClaim('uid'),$token]; // will print "4f1g23a12aa"
        $signer = new Sha256();
        $time = time();

        $token = (new Builder())->issuedBy('http://example.com') // Configures the issuer (iss claim)
                                ->permittedFor('http://example.org') // Configures the audience (aud claim)
                                ->identifiedBy('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
                                ->issuedAt($time) // Configures the time that the token was issue (iat claim)
                                ->canOnlyBeUsedAfter($time + 60) // Configures the time that the token can be used (nbf claim)
                                ->expiresAt($time + 3600) // Configures the expiration time of the token (exp claim)
                                ->withClaim('uid', 1) // Configures a new claim, called "uid"
                                ->getToken($signer, new Key('testing')); // Retrieves the generated token


        var_dump($token->verify($signer, 'testing 1')); // false, because the key is different
        var_dump($token->verify($signer, 'testing')); // true, because the key is the same
        
    }
    //
}
