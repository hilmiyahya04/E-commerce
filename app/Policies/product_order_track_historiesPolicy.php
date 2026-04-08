<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\product_order_track_histories;
use Illuminate\Auth\Access\HandlesAuthorization;

class product_order_track_historiesPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ProductOrderTrackHistories');
    }

    public function view(AuthUser $authUser, product_order_track_histories $productOrderTrackHistories): bool
    {
        return $authUser->can('View:ProductOrderTrackHistories');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ProductOrderTrackHistories');
    }

    public function update(AuthUser $authUser, product_order_track_histories $productOrderTrackHistories): bool
    {
        return $authUser->can('Update:ProductOrderTrackHistories');
    }

    public function delete(AuthUser $authUser, product_order_track_histories $productOrderTrackHistories): bool
    {
        return $authUser->can('Delete:ProductOrderTrackHistories');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:ProductOrderTrackHistories');
    }

    public function restore(AuthUser $authUser, product_order_track_histories $productOrderTrackHistories): bool
    {
        return $authUser->can('Restore:ProductOrderTrackHistories');
    }

    public function forceDelete(AuthUser $authUser, product_order_track_histories $productOrderTrackHistories): bool
    {
        return $authUser->can('ForceDelete:ProductOrderTrackHistories');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ProductOrderTrackHistories');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ProductOrderTrackHistories');
    }

    public function replicate(AuthUser $authUser, product_order_track_histories $productOrderTrackHistories): bool
    {
        return $authUser->can('Replicate:ProductOrderTrackHistories');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ProductOrderTrackHistories');
    }

}