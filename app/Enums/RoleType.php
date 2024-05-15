<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class RoleType extends Enum
{
    const SuperAdministrator = 'super administrator';
    const FacilityStaffAdministrator = 'facility staff administrator';
    const FacilityStaffUser = 'facility staff user';
    const FacilityStaffReader = 'facility staff reader';
    const ClientFamilyAdministrator = 'client family administrator';
    const ClientFamilyUser = 'client family user';
    const ClientFamilyReader = 'client family reader';
}
