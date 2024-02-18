<?php

declare(strict_types=1);

namespace App\Tests\Tools;

use App\Inventory\Domain\Aggregate\Product\Product;
use App\Inventory\Domain\Aggregate\Product\ProductReservation;
use App\Payments\Domain\Aggregate\Invoice\Invoice;
use App\Payments\Domain\Aggregate\Payment\Payment;
use App\Skills\Domain\Aggregate\Skill\SkillGroup;
use App\Tests\Resource\Fixture\Inventory\ProductFixture;
use App\Tests\Resource\Fixture\Inventory\ProductReservationFixture;
use App\Tests\Resource\Fixture\Payments\InvoiceFixture;
use App\Tests\Resource\Fixture\Payments\PaymentFixture;
use App\Tests\Resource\Fixture\Skills\SkillGroupFixture;
use App\Tests\Resource\Fixture\Users\UserFixture;
use App\Users\Domain\Aggregate\User\User;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;

trait FixtureTools
{
    public function getDatabaseTools(): AbstractDatabaseTool
    {
        return static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function loadUserFixture(): User
    {
        $executor = $this->getDatabaseTools()->loadFixtures([UserFixture::class], true);
        /** @var User $user */
        $user = $executor->getReferenceRepository()->getReference(UserFixture::REFERENCE);

        return $user;
    }

    public function loadSkillGroupFixture(): SkillGroup
    {
        $executor = $this->getDatabaseTools()->loadFixtures([SkillGroupFixture::class], true);

        return $executor->getReferenceRepository()->getReference(SkillGroupFixture::REFERENCE);
    }

    public function loadInvoiceFixture(): Invoice
    {
        $executor = $this->getDatabaseTools()->loadFixtures([InvoiceFixture::class], true);

        return $executor->getReferenceRepository()->getReference(InvoiceFixture::REFERENCE);
    }

    public function loadPaymentFixture(): Payment
    {
        $executor = $this->getDatabaseTools()->loadFixtures([PaymentFixture::class], true);

        return $executor->getReferenceRepository()->getReference(PaymentFixture::REFERENCE);
    }

    private function loadProductFixture(): Product
    {
        $executor = $this->getDatabaseTools()->loadFixtures([ProductFixture::class], true);

        return $executor->getReferenceRepository()->getReference(ProductFixture::REFERENCE);
    }

    public function loadProductReservationFixture(): ProductReservation
    {
        $executor = $this->getDatabaseTools()->loadFixtures([ProductReservationFixture::class], true);

        return $executor->getReferenceRepository()->getReference(ProductReservationFixture::REFERENCE);
    }
}
