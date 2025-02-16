<?php

namespace App\Api\Import\Constant;

class ConfigConstant
{
    // first %s for version, second %s for endpoint
    public const string WAKFU_API_URL = 'https://wakfu.cdn.ankama.com/gamedata/%s/%s.json';
    public const string WAKFU_API_VERSION = '1.86.4.31';
}
