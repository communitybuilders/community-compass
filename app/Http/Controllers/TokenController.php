<?php

namespace App\Http\Controllers;



use App\Organisation;
use App\Relationship;
use App\RelationshipType;
use App\Token;
use App\User;
use App\Website;
use Illuminate\Support\Facades\Redirect;

class TokenController extends Controller
{
    /**
     * @param Token $token_obj
     */
    public function process(Token $token_obj) {
        // Re-check to ensure that the user's email and domain of the organisation match.
        $user_obj = User::find($token_obj->user_id);
        /* @var $org_obj Organisation */
        $org_obj = Organisation::find($token_obj->organisation_id);
        /* @var $website_obj Website */
        $website_obj = $org_obj->getWebsite();

        // Let's get the domain name of the user's email.
        $email_parts = explode("@", $user_obj->email);

        // Let's remove "www." from our website and prefix it with "http://".
        // This will ensure that parse_url properly returns the domain.
        $website_url = "http://" . preg_replace("#(https?://)?(www.)?#", "", $website_obj->url);

        if( parse_url($website_url, PHP_URL_HOST) !== $email_parts[1] ) {
            echo "Sorry, you cannot claim this organisation as your email address does not match the domain name of the organiastion.";
            //exit();
        }else {
            // Create a relationship
            // Get the relationship type for owner_of.
            $owner_of_relationship_type = RelationshipType::whereName('owner_of')->first();
            Relationship::create(["organisation_id" => $org_obj->id,
                "user_id" => $user_obj->id,
                "relationship_type_id" => $owner_of_relationship_type->id,
                "start_date" => date("Y-m-d H:i:s")
            ]);

            return Redirect::action('OrganisationController@index', array('message' => "Successfully claimed organisation!"));
        }
    }

}
