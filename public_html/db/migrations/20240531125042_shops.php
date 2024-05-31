<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Shops extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('shops');
        $table->addColumn('name','string', ['null' => false])
              ->addColumn('document_type', 'string', ['null' => false])
              ->addColumn('document_number', 'integer', ['null' => false])
              ->addColumn('address', 'text', ['null' => false])
              ->addColumn('branch_office', 'text')
              ->addColumn('phone', 'string')
              ->create();
    }
}
