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
    public const INVENTORY_PRODUCTS_RESERVED = 'inventory.product_reserved';
    public const INVENTORY_PRODUCTS_RESERVATION_RELEASED = 'inventory.product_reservation_released';
    public const INVENTORY_PRODUCTS_RESERVATION_REJECTED = 'inventory.product_reservation_rejected';
    public const PAYMENTS_INVOICE_PAID = 'payments.invoice_paid';
    public const PAYMENTS_INVOICE_CANCELLED = 'payments.invoice_cancelled';
    public const ORDERS_ORDER_PAID = 'orders.order_paid';
    public const ORDERS_ORDER_COMPLETED = 'orders.order_completed';
    public const ORDERS_ORDER_CANCELLED = 'orders.order_cancelled';
    public const PAYMENTS_PAYMENT_PAID = 'payments.payment_paid';
}
