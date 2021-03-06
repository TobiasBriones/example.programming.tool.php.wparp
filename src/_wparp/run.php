<?php
/*
 * Copyright (c) 2019 Tobias Briones. All rights reserved.
 *
 * SPDX-License-Identifier: MIT
 *
 * This file is part of Example Project: WPARP.
 *
 * This source code is licensed under the MIT License found in the
 * LICENSE file in the root directory of this source tree or at
 * https://opensource.org/licenses/MIT.
 */

session_start();
header("Content-Type: application/json");

$params = json_decode(file_get_contents("php://input"));
$response = ["status" => "OK"];
$register = [];

set_error_handler(function () {}, E_WARNING);

foreach ($params as $file) {
    $fileSize = filesize($file);
    $register[$file] = $fileSize;

    if ($fileSize === false) {
        $response["status"] = "Fail to register file: $file";
    }
}
$_SESSION["wparp"] = json_encode($register);
echo json_encode($response);
