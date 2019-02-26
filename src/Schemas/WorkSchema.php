<?php

namespace Railken\Amethyst\Schemas;

use Railken\Amethyst\Managers\DataBuilderManager;
use Railken\Lem\Attributes;
use Railken\Lem\Contracts\EntityContract;
use Railken\Lem\Schema;

class WorkSchema extends Schema
{
    /**
     * Get all the attributes.
     *
     * @var array
     */
    public function getAttributes()
    {
        return [
            Attributes\IdAttribute::make(),
            Attributes\TextAttribute::make('name')
                ->setRequired(true)
                ->setUnique(true),
            Attributes\LongTextAttribute::make('description'),
            Attributes\BelongsToAttribute::make('data_builder_id')
                ->setRelationName('data_builder')
                ->setRelationManager(DataBuilderManager::class),
            Attributes\YamlAttribute::make('payload')->setDefault(function (EntityContract $entity) {
                return file_get_contents(__DIR__.'/../../resources/schema/default/payload.yaml');
            }),
            Attributes\YamlAttribute::make('data')->setDefault(function (EntityContract $entity) {
                return file_get_contents(__DIR__.'/../../resources/schema/default/data.yaml');
            }),
            Attributes\CreatedAtAttribute::make(),
            Attributes\UpdatedAtAttribute::make(),
            Attributes\DeletedAtAttribute::make(),
        ];
    }
}
