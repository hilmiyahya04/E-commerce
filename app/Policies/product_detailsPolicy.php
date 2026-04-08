<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\product_details;
use Illuminate\Auth\Access\HandlesAuthorization;

class product_detailsPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ProductDetails');
    }

    public function view(AuthUser $authUser, product_details $productDetails): bool
    {
        return $authUser->can('View:ProductDetails');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ProductDetails');
    }

    public function update(AuthUser $authUser, product_details $productDetails): bool
    {
        return $authUser->can('Update:ProductDetails');
    }

    public function delete(AuthUser $authUser, product_details $productDetails): bool
    {
        return $authUser->can('Delete:ProductDetails');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:ProductDetails');
    }

    public function restore(AuthUser $authUser, product_details $productDetails): bool
    {
        return $authUser->can('Restore:ProductDetails');
    }

    public function forceDelete(AuthUser $authUser, product_details $productDetails): bool
    {
        return $authUser->can('ForceDelete:ProductDetails');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ProductDetails');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ProductDetails');
    }

    public function replicate(AuthUser $authUser, product_details $productDetails): bool
    {
        return $authUser->can('Replicate:ProductDetails');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ProductDetails');
    }

}