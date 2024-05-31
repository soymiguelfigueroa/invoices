<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Invoices extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('invoices');
        $table->addColumn('number', 'integer', ['null' => false])
              ->addColumn('date', 'date', ['null' => false])
              ->addColumn('hour', 'time', ['null' => false])
              ->addColumn('tax_base', 'float', ['null' => false])
              ->addColumn('tax_free', 'float', ['null' => false])
              ->addColumn('subtotal', 'float', ['null' => false])
              ->addColumn('tax', 'float', ['null' => false])
              ->addColumn('total', 'float', ['null' => false])
              ->addColumn('shop_id', 'integer', ['null' => false, 'signed' => false])
              ->addForeignKey(
                'shop_id',
                'shops',
                'id',
                [
                    'delete' => 'RESTRICT',
                    'update' => 'NO_ACTION',
                    'constraint' => 'fk_shop_invoice_id'
                ]
              )
              ->create();
    }
}
