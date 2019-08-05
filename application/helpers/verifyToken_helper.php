<?php

function verifyToken($headerParam, $dbParam)
    {
        // Get all the headers
        $headers = $headerParam;

        if(!isset($headers['Authorization'])){
            $data = [
                "validToken" => false,
                "payload" => [],
                "res" => [
                    "status" => "401",
                    "message" => 'Unauthorized Access!'
                ]
            ];
            return $data;
        }
        // Extract the token 
        $token = $headers['Authorization'];
        // Use try-catch
        // JWT library throws exception if the token is not valid
        try {
            // Validate the token
            // Successfull validation will return the decoded user data else returns false
            $payloadJwt = AUTHORIZATION::validateTimestamp($token);
            // if token expired or not valid
            if ($payloadJwt == false) {
                $data = [
                    "validToken" => false,
                    "res" => [
                        "status" => "401",
                        "message" => 'Unauthorized Access!'
                    ]
                ];
                return $data;
            }

            // check payload token in db
            $user = $dbParam->query("SELECT * FROM m_user where username=\"{$payloadJwt->username}\" and id_user=\"{$payloadJwt->id_user}\"");
            // if payload not valid
            if(count($user->result()) == 0){
                $data = [
                    "validToken" => false,
                    "res" => [
                        "status" => "401",
                        "message" => 'Unauthorized Access!'
                    ]
                ];
                return $data;
            }

            // if token valid
            $data = [
                "validToken" => true,
                "payload" => $payloadJwt
            ];
            
            return $data;
            
        } catch (Exception $e) {
            // Token is invalid
            // Send the unathorized access message
            $data = [
                "validToken" => false,
                "res" => [
                    "status" => "401",
                    "message" => 'Unauthorized Access!'
                ]
            ];
            return $data;
        }
    }
    