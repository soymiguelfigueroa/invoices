<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class InvoiceItems extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('invoice_items');
        $table->addColumn('description','string', ['null' => false])
              ->addColumn('taxable', 'boolean', ['null' => false])
              ->addColumn('quantity', 'integer', ['null' => false])
              ->addColumn('unit_price', 'float', ['null' => false])
              ->addColumn('total', 'float', ['null' => false])
              ->addColumn('invoice_id','integer', ['null' => false, 'signed' => false])
              ->addForeignKey(
                'invoice_id',
                'invoices',
                'id',
                [
                    'delete' => 'RESTRICT', 
                    'update' => 'NO_ACTION', 
                    'constraint' => 'fk_invoice_item_invoice_id'
                ]
              )
              ->create();
    }
}
