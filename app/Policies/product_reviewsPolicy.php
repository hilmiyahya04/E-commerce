<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\product_reviews;
use Illuminate\Auth\Access\HandlesAuthorization;

class product_reviewsPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ProductReviews');
    }

    public function view(AuthUser $authUser, product_reviews $productReviews): bool
    {
        return $authUser->can('View:ProductReviews');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ProductReviews');
    }

    public function update(AuthUser $authUser, product_reviews $productReviews): bool
    {
        return $authUser->can('Update:ProductReviews');
    }

    public function delete(AuthUser $authUser, product_reviews $productReviews): bool
    {
        return $authUser->can('Delete:ProductReviews');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:ProductReviews');
    }

    public function restore(AuthUser $authUser, product_reviews $productReviews): bool
    {
        return $authUser->can('Restore:ProductReviews');
    }

    public function forceDelete(AuthUser $authUser, product_reviews $productReviews): bool
    {
        return $authUser->can('ForceDelete:ProductReviews');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ProductReviews');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ProductReviews');
    }

    public function replicate(AuthUser $authUser, product_reviews $productReviews): bool
    {
        return $authUser->can('Replicate:ProductReviews');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ProductReviews');
    }

}