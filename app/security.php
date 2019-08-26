<?php
/**
 * @OA\SecurityScheme(
 *   securityScheme="api_key",
 *   type="apiKey",
 *   in="header",
 *   name="api_key"
 * )
 */
/**
 * @OA\SecurityScheme(
 *   securityScheme="jwt_auth",
 *   type="oauth2",
 *   @OA\Flow(
 *      authorizationUrl="http://petstore.swagger.io/oauth/dialog",
 *      flow="implicit",
 *      scopes={
 *         "read:meteopark": "read your pets",
 *         "write:meteopark": "modify pets in your account"
 *      }
 *   )
 * )
 */
