
<?php

function sessionHasTenant()
{
    return session()->has('tenant_id') && ! empty(session()->get('tenant_id')) && ! is_null(session()->get('tenant_id'));
}
