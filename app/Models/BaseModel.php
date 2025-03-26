<?php

namespace App\Models;

use App\HasTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class BaseModel extends Model implements Auditable
{
    use HasTenant;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
}
