<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

class PermissionType extends Enum
{
    // Permissions for Facility
    public const CreateFacility = 'create facility';
    public const EditFacility = 'edit facility';
    public const DeleteFacility = 'delete facility';
    public const ReadFacility = 'read facility';

    // Permissions for Facility Staff
    public const CreateFacilityStaff = 'create facility staff';
    public const EditFacilityStaff = 'edit facility staff';
    public const DeleteFacilityStaff = 'delete facility staff';
    public const ReadFacilityStaff = 'read facility staff';

    // Permissions for Facility Client
    public const CreateFacilityClient = 'create facility client';
    public const EditFacilityClient = 'edit facility client';
    public const DeleteFacilityClient = 'delete facility client';
    public const ReadFacilityClient = 'read facility client';

    // Permissions for ClientFamily
    public const CreateClientFamily = 'create client family';
    public const EditClientFamily = 'edit client family';
    public const DeleteClientFamily = 'delete client family';
    public const ReadClientFamily = 'read client family';
}
