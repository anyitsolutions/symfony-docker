<?php

declare(strict_types=1);

namespace App\Shared\Domain\Event;

interface EventType
{
    public const TRAINING_MATERIAL_CREATED = 'training.material_created';
    public const USERS_USER_CREATED = 'users.user_created';
    public const TESTING_TESTING_SESSION_COMPLETED = 'testing.testing_session_completed';
    public const SKILLS_SKILL_CONFIRMATION_CREATED = 'skills.skill_confirmation_created';
    public const ORDERS_ORDER_CREATED = 'orders.order_created';
    public const PAYMENTS_INVOICE_PAID = 'payments.invoice_paid';
}
